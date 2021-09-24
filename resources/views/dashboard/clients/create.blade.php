@extends('layouts.dashboard')

@section('title', 'Crear cliente')
@section('main')
    <div class="bg-white p-4 w-75 mx-auto">
        @include('messages')
        <form action="{{route('clients.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col form-group">
                    <label class="">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Apellido</label>
                    <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Número de identificación</label>
                    <input type="text" name="identification_number" class="form-control" value="{{old('identification_number')}}"/>
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label class="">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{old('phone')}}"/>
                </div>
                <div class="col form-group">
                    <label class="">Email</label>
                    <input type="text" name="email" class="form-control" value="{{old('email')}}"/>
                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-block">Crear cliente</button>
            </div>
        </form>
    </div>
@endsection