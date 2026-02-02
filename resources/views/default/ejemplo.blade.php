@extends('layout')

@section('title' , 'Pagina ejemplo')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Grupos de FP  de informatica donde Marti da clase </h1>

    <table>

        <thead>
                <tr>
                    <th>
                        codigo
                    </th>
                    <th>
                        Denominacion
                    </th>
                </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
            <tr>
                <td>{{$grupo->codigo}}</td>
                <td>{{$grupo->denominacion}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
