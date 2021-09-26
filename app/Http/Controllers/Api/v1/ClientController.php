<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('id','desc')->paginate(6);

        return view('dashboard.clients.list', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  =>  'required',
            'last_name'             =>  'required',
            'identification_number'  =>  'required|unique:clients'
        ],[
            'name.required' =>  'El nombre es requerido',
            'last_name.required' =>  'El apellido es requerido',
            'identification_number.unique' =>  'El documento de identidad ya esta registrado',
            'identification_number.required' =>  'El documento de identidad es requerido',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
        ->with('success', 'Cliente creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name'                  =>  'required',
            'last_name'             =>  'required',
            'identification_number'  =>  'required|unique:clients,identification_number,'.$client->id
        ],[
            'name.required' =>  'El nombre es requerido',
            'last_name.required' =>  'El apellido es requerido',
            'identification_number.unique' =>  'El documento de identidad ya esta registrado',
            'identification_number.required' =>  'El documento de identidad es requerido', 
        ]);

        $client->fill($request->all());
        $client->update();

        return redirect()->route('clients.index')
        ->with('success', 'Cliente actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
