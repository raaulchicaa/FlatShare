@extends('layout')

@section('title', 'Listado de cuentas')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de cuentas</h1>
    <a href="{{ route('cuenta_new') }}">+ Nueva cuenta</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Código</th><th>Saldo</th><th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->codigo }}</td><td>{{ $cuenta->saldo }}</td>
                    
                    <td>
                        @isset($cuenta->cliente)
                            {{ $cuenta->cliente->nombreApellido() }}
                        
                        @endisset
                    </td>
                    @if(Auth::check())
                        <td>
                            <a href="{{ route('cuenta_delete', ['id' => $cuenta->id]) }}">Eliminar</a>
                            <a href="{{ route('cuenta_update', ['id' => $cuenta->id]) }}">Editar</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            <form action="{{ route('cuenta_filtro') }}">
                <p for= "buscador">Busca por <b>código</b></p>
                Código<input type="text" name="buscador" placeholder="código" required></br>
                Saldo<input type="number" name="saldo" placeholder="saldo"></br>
                <input type="checkbox" name="check"> Buscar con AND</br>
                <input type="submit" name="button" value="Filtrar"></br>
                <a href='list' >Limpiar Filtro</a>
            </form>
        </tbody>
    </table>

    <br>
@endsection