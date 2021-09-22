<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\OrderClient;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
