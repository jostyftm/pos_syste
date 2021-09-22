@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{route('home')}}">Inicio</a>
                    <a class="nav-link" href="{{route('providers.index')}}">Proveedores</a>
                    <a class="nav-link" href="{{route('products.index')}}">Productos</a>
                    <a class="nav-link" href="{{route('clients.index')}}">Clientes</a>
                    <a class="nav-link" href="{{route('orderclients.index')}}">Ventas</a>
                </nav>
            </div>
            <div class="col-md-10">
                <h1>@yield('title')</h1>
                @yield('main')
            </div>
        </div>
    </div>
@endsection