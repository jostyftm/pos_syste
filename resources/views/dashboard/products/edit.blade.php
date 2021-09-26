@extends('layouts.dashboard')

@section('title', 'Crear producto')
@section('main')
    <div class="bg-white p-4 w-75 mx-auto">
        @include('messages')
        <form action="{{route('products.update', $product->id)}}" method="POST">
            @csrf
            @method('put')
            <div class="row">
                <div class="col form-group">
                    <label class="">Codigo</label>
                    <input type="text" name="code" class="form-control" value="{{$product->code}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{$product->name}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Cantidad</label>
                    <input type="text" name="stock" class="form-control" value="{{$product->stock}}"/>
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label class="">Descripción</label>
                    <textarea class="form-control" name="description">{{$product->description}}</textarea>     
                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-block">Actualizar producto</button>
            </div>
        </form>
    </div>
@endsection