<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\OrderClient;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderClients = OrderClient::with(['client','seller','state'])
        ->orderBy('id','desc')
        ->paginate(6);

        return view('dashboard.orderClients.list', compact('orderClients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.orderClients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->step_1)) {
            return $this->step1($request);
        }
    }

    public function step1(Request $request) {

        $request->validate([
            'identification_number' =>  'required'
        ],[
            'identification_number.required'    =>  'El número de identificación es requerido'
        ]);

        $client = Client::where('identification_number', $request->identification_number)->first();

        if(is_null($client)){
            return redirect()->route('orderclients.create')
            ->with('error', 'El cliente no esta creado, por favor registre el cliente');
        }

        $order = OrderClient::create([
            'client_id'     =>  $client->id,
            'seller_id'     =>  Auth::user()->id,
            'order_state_id' => 1
        ]);

        return redirect()->route('orderclients.edit',[$order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderClient  $orderClient
     * @return \Illuminate\Http\Response
     */
    public function show(OrderClient $orderclient)
    {
        return view('dashboard.orderclients.show')
        ->with('order', $orderclient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderClient  $orderClient
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, OrderClient $orderclient)
    {
        $orderclient->client;
        
        $total = $orderclient->products()->sum('total_price');

        return view('dashboard.orderclients.edit', compact('total'))
        ->with('order', $orderclient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderClient  $orderClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderClient $orderclient)
    {
        
        $product = Product::where('code', $request->product_code)->first();

        
        if($request->action != "sell" && is_null($product)){
            return back()
            ->with('error', 'El producto no existe');
        }else if($request->action != "sell" && $product->stock <= 0){
            return back()
            ->with('error', 'El producto no tiene stock');
        }
        
        switch($request->action){
            case "add_item":
                $orderclient->addProduct($request, $product);
                
                return back()->with('success', 'Producto agregado');
                break;
            case "remove_item":
                $orderclient->removeProduct($product);

                return back()->with('success', 'Producto eliminado');
                break;
            case "sell":
                
                $orderclient->update([
                    'order_state_id' => 2
                ]);

                return redirect()->route('orderclients.index')->with('success', 'Venta realizada');
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderClient  $orderClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderClient $orderClient)
    {
        //
    }
}
