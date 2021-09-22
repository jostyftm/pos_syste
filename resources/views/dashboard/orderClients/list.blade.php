@extends('layouts.dashboard')

@section('title', 'Ventas')
@section('main')

<div>
    <div class="d-flex my-3 justify-content-between">
        <div></div>
        <a class="btn btn-primary btn-sm">Nueva venta</a>
    </div>
    <div>
        <table class="table">
            <thead>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </thead>
            <tbody>
                @foreach($orderClients as $order)
                <tr>
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->seller->name }}</td>
                    <td>{{ $order->state->name }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->discount }}</td>
                    <td>{{ $order->total_price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orderClients->links() }}
    </div>
</div>
@endsection