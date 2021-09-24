@extends('layouts.dashboard')

@section('title', 'Prooveedores')
@section('main')

<div>
    <div class="d-flex my-3 justify-content-between">
        <div></div>
        <a href="{{route('providers.create')}}" class="btn btn-primary btn-sm">Nuevo proovedor</a>
    </div>
    @include('messages')
    <div>
        <table class="table">
            <thead>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Nit</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </thead>
            <tbody>
                @foreach($providers as $provider)
                <tr>
                    <td>{{ $provider->name }}</td>
                    <td>{{ $provider->nit }}</td>
                    <td>{{ $provider->phone }}</td>
                    <td>{{ $provider->email }}</td>
                    <td>
                        <a 
                            class="btn btn-sm btn-primary"
                            href="{{route('providers.edit', $provider->id)}}"
                        >
                            Editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $providers->links() }}
    </div>
</div>
@endsection