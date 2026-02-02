@extends('layout')

@section('title', 'Nueva Cliente')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Nueva Cliente</h1>
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
        <form enctype="multipart/form-data" method="POST" action="{{ route('cliente_new') }}">
            @csrf
            <div>
                <label for="DNI">DNI</label>
                <input type="text" name="DNI" />
            </div>
            <div>            
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
            </div>
            <div>
                <label for="apellidos">Apellido</label>
                <input type="text" name="apellidos" />
            </div>
            <div>            
                <label for="fechaN">fechaN</label>
                <input type="date" name="fechaN" value="{{date_create()->format('Y-m-d')}}" />
            </div>
            <div>
                <label for="">Imagen</label>
                <input type="file" name="imagen" id="imagen">            
            </div>
            
            <button type="submit">Crear Cliente</button>
        </form>
	</div>
@endsection