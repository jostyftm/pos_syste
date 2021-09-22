@extends('layouts.dashboard')

@section('title', 'Productos')
@section('main')

<div>
    <div class="d-flex my-3 align-item-between">
        <div></div>
        <a class="btn btn-primary btn-sm">Nuevo producto</a>
    </div>
    <div>
        <table class="table">
            <thead>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio de compra</th>
                        <th>Precio de venta</th>
                        <th>Cantidad</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->buy_price }}</td>
                    <td>{{ $product->sell_price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm">Editar</a>
                        <a class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
@endsection