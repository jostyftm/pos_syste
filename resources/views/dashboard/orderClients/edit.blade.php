@extends('layouts.dashboard')

@section('title', 'Crear venta')
@section('main')
    <div class="bg-white p-4 container-fluid mx-auto">
        @include('messages')
        <div class="row">
            <div class="col-md-8">
                <form class="w-100" action="{{route('orderclients.update', $order->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="action" value="add_item" />
                    <div class="form-row d-flex align-items-end">
                        <div class="form-group col-md-3 mb-0">
                            <label>Código producto</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="product_code" 
                                placeholder="2145"
                            />
                        </div>
                        <div class="form-group col-md-2 mb-0">
                            <label>Cantidad</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="amount" 
                                placeholder="2"
                            />
                        </div>
                        <div>
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>
                <div class="my-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Código</td>
                                <td>Producto</td>
                                <td>Cantidad</td>
                                <td>Total</td>
                                <td>Acción</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{ $product->code}}</td>
                                    <td>{{ $product->name}}</td>
                                    <td>{{ $product->pivot->amount}}</td>
                                    <td>{{ $product->pivot->total_price}}</td>
                                    <td>
                                        <form action="{{route('orderclients.update', $order->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            <input 
                                                type="hidden"  
                                                name="product_code"
                                                value="{{$product->code}}"
                                            />
                                            <input type="hidden" name="action" value="remove_item" />
                                            <button class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
               <div>
                <h2>Resumen de compra</h2>
                <span>Cliente: <b>{{ $order->client->fullName}}</b></span>
               </div> 
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Total: </th>
                            <td>{{ $total }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <form action="{{route('orderclients.update', $order->id)}}" method="POST">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="action" value="sell" />
                                    <button 
                                        class="btn btn-primary btn-block"
                                    >
                                        Cobrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection