@extends('layouts.dashboard')

@section('title', 'Crear proveedor')
@section('main')
    <div class="bg-white p-4 w-75 mx-auto">
        @include('messages')
        <form action="{{route('providers.update',[$provider->id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col form-group">
                    <label class="">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{$provider->name}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Nit</label>
                    <input type="text" name="nit" class="form-control" disabled value="{{$provider->nit}}"/>
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label class="">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{$provider->phone}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Email</label>
                    <input type="text" name="email" class="form-control" value="{{$provider->email}}"/>
                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-block">Actualizar proveedor</button>
            </div>
        </form>
    </div>
@endsection