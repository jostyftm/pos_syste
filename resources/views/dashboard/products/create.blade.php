@extends('layouts.dashboard')

@section('title', 'Crear producto')
@section('main')
    <div class="bg-white p-4 w-75 mx-auto">
        @include('messages')
        <form action="{{route('products.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col form-group">
                    <label class="">Codigo</label>
                    <input type="text" name="code" class="form-control" value="{{old('code')}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Precio de compra</label>
                    <input type="text" name="buy_price" class="form-control" value="{{old('buy_price')}}"/>
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label class="">Descripción</label>
                    <textarea class="form-control" name="description"></textarea>     
                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-block">Crear producto</button>
            </div>
        </form>
    </div>
@endsection