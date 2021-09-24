<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::paginate(6);

        return view('dashboard.provider.list', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.provider.create');
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
            'name'  =>  'required',
            'nit'   =>  'required',
            'phone'  =>  'required',
            'email'  =>  'required'
        ],[
            'name.required' =>  'El nombre es requerido',
            'nit.required'  =>  'El nit es requerido',
            'phone.required' =>  'El teléfono es requerido',
            'email.required' =>  'El correo es requerido'
        ]);

        Provider::create($request->all());

        return redirect()->route('providers.index')
        ->with('success', 'El proveedor fue creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        return view('dashboard.provider.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'name'  =>  'required',
            'phone'  =>  'required',
            'email'  =>  'required|unique:providers,email,'.$provider->id,
        ],[
            'name.required' =>  'El nombre es requerido',
            'phone.required' =>  'El teléfono es requerido',
            'email.required' =>  'El nombre es requerido',
            'email.unique' =>  'El email ya esta registrado',
        ]);

        $provider->fill($request->all());
        $provider->update();

        return redirect()->route('providers.index')
        ->with('success', 'El proveedor se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
