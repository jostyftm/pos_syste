@extends('layouts.dashboard')

@section('title', 'Crear venta')
@section('main')
    <div class="bg-white p-4 w-75 mx-auto">
        @include('messages')
        <form action="{{route('orderclients.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Número de identificación</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="identification_number" 
                />
                <input name="seacrh_client" type="hidden" />
                <input name="step_1" type="hidden" value="1" />
            </div>
            <button class="btn btn-primary btn-block">
                Buscar cliente
            </button>
        </form>
    </div>
@endsection