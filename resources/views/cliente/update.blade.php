@extends('layout')

@section('title', 'Editar Cuenta')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Cliente</h1>
    <a href="{{ route('cliente_list') }}">&laquo; Volver</a>



        @if ($errors->any())

            <div class="alert alert-danger">

                <ul style="color:red ; list-style:none">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



	<div style="margin-top: 20px">
        <form enctype="multipart/form-data" method="POST" action="{{ route('cliente_update' , ['id' => $cliente->id] ) }}">
            @csrf
            <div>
                <label for="DNI">DNI</label>
                <input type="text" name="DNI" value="{{ $cliente->DNI }}" />
            </div>
            <div>            
                <label for="nombre">Nombre</label>
                <input type="texto" name="nombre" value="{{ $cliente->nombre }}"/>
            </div>
            <div>            
                <label for="apellidos">Apellidos</label>
                <input type="texto" name="apellidos" value="{{ $cliente->apellidos }}"/>
            </div>
            <div>            
                <label for="fechaN">fechaN</label>
                <input type="date" name="fechaN" value="{{ $cliente->fechaN->format('Y-m-d') }}"/>
            </div>

            <div>
                
                @isset($cliente->imagen)
                <div>
                    <label for="">Borrar Imagen</label>
                    <input type="checkbox" name="borrarI" id="borrarI">
                </div>
                @endisset
            </div>

            <div>
                @isset($cliente->imagen)
                <div>
                    <p>
                        Imagen actual : {{$cliente->imagen}}
                    </p>
                </div>
                @endisset
            </div>

            <div>
                <label for="">Imagen</label>
                <input type="file" name="imagen" id="imagen">            
            </div>

            <button type="submit">Editar Cliente</button>
        </form>
	</div>
@endsection