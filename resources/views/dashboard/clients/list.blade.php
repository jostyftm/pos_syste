@extends('layouts.dashboard')

@section('title', 'Clientes')
@section('main')

<div>
    <div class="d-flex my-3 justify-content-between">
        <div></div>
        <a href="{{route('clients.create')}}" class="btn btn-primary btn-sm">Nuevo cliente</a>
    </div>
    @include('messages')
    <div>
        <table class="table">
            <thead>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Identificación</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->last_name }}</td>
                    <td>{{ $client->identification_number }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        <a 
                            class="btn btn-primary btn-sm"
                            href="{{route('clients.edit', $client->id)}}"
                        >
                            Editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $clients->links() }}
    </div>
</div>
@endsection