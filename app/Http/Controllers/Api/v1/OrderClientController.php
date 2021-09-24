<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\OrderClient;
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
    public function show(OrderClient $orderClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderClient  $orderClient
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderClient $orderClient)
    {
        return view('dashboard.orderclients.edit')
        ->with('order', $orderClient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderClient  $orderClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderClient $orderClient)
    {
        //
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
