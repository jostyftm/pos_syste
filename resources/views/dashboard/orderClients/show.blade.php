@extends('layouts.dashboard')

@section('title', 'Consultar venta')
@section('main')
    <div class="bg-white p-4 container-fluid mx-auto">
        <div class="my-3">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Cliente: {{ $order->client->fullName}}</td>
                        <td>Fecha de compra: {{ $order->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Vendedor: {{ $order->seller->fullName}}</td>
                        <td class="font-weight-bold">Total: {{ $order->getTotalSell()}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Precio unt</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td>{{ $product->code}}</td>
                            <td>{{ $product->name}}</td>
                            <td>$ {{ number_format($product->sell_price)}}</td>
                            <td>{{ $product->pivot->amount}}</td>
                            <td>$ {{ number_format($product->pivot->total_price)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection