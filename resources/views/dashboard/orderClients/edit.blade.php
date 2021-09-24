@extends('layouts.dashboard')

@section('title', 'Crear venta')
@section('main')
    <div class="bg-white p-4 w-75 mx-auto">
        @include('messages')
        <form action="{{route('orderclients.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <input 
                    type="text" 
                    class="form-control" 
                    name="product_code" 
                    placeholder="Codigo de producto"
                />
            </div>
        </form>
    </div>
@endsection