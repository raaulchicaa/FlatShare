@extends('layout')

@section('title', 'Listado de clientes')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de clientes</h1>
    <a href="{{ route('cliente_new') }}">+ Nuevo cliente</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>DNI</th><th>Nombre</th><th>Apellidos</th><th>FechaN</th><th>Imagenes</th><th>Cantidad Cuentas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->DNI }}</td><td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->fechaN->format('d-m-Y') }}</td>
                    
                    <td>
                        <img style="width:40px" src="{{ asset("uploads/imagenes/$cliente->imagen") }}" alt="">
                    </td>

                    <td>
                        {{count($cliente->cuentas)}}
                    </td>

                    
                    @if(Auth::check())
                        <td>
                            <a href="{{ route('cliente_delete', ['id' => $cliente->id]) }}">Eliminar</a>
                            <a href="{{ route('cliente_update', ['id' => $cliente->id]) }}">Editar</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection