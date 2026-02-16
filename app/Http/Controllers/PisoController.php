<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Piso;
use App\Models\Usuario;

class PisoController extends Controller
{
function list() 
{
    $pisos = Piso::all();

    return view('piso.list', ['pisos' => $pisos]);
}

function new(Request $request) 
{

    if ($request->isMethod('post')) {    
    $validated = $request->validate([
    'nombre' => 'required|unique:pisos',
    'ubicacion' => 'required',
    'precio' => 'required|numeric',
    'habitaciones' => 'required|integer',
    'baños' => 'required|integer',
    'metroscuadrados' => 'required|integer',
    'casa' => 'required|boolean',
    'planta' => 'required|integer',
    ]);

    $piso = new Piso;
    $piso->nombre = $request->nombre;
    $piso->ubicacion = $request->ubicacion;
    $piso->precio = $request->precio;
    $piso->habitaciones = $request->habitaciones;
    $piso->baños = $request->baños;
    $piso->metroscuadrados = $request->metroscuadrados;
    $piso->casa = $request->casa;
    $piso->planta = $request->planta;
    $piso->usuario_id = $request->usuario_id;
    $piso->save();




    return redirect()->route('piso_list')->with('status', 'Nuevo piso '.$piso->nombre.' creado!');
    }
    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    $usuarios = Usuario::all();

    return view('piso.new', ['usuarios' => $usuarios]);
}

function delete($id) 
{ 
    $piso = Piso::find($id);
    $piso->delete();
    return redirect()->route('piso_list')->with('status', 'Piso '.$piso->nombre.' eliminado!');
}


function update(Request $request , $id) 
{

    if ($request->isMethod('post')) {    
    $validated = $request->validate([

        'nombre' => [
            'required',
            Rule::unique('pisos')->ignore($id),
        ],
        'ubicacion' => 'required',
        'precio' => 'required|numeric',
        'habitaciones' => 'required|integer',
        'baños' => 'required|integer',
        'metroscuadrados' => 'required|integer',
        'casa' => 'required|boolean',
        'planta' => 'required|integer',
    ]);
    }

    $piso = Piso::find($id);

    if ($request->isMethod('post')) {    

    $piso->nombre = $request->nombre;
    $piso->ubicacion = $request->ubicacion;
    $piso->precio = $request->precio;
    $piso->habitaciones = $request->habitaciones;
    $piso->baños = $request->baños;
    $piso->metroscuadrados = $request->metroscuadrados;
    $piso->casa = $request->casa;
    $piso->planta = $request->planta;
    $piso->usuario_id = $request->usuario_id;
    $piso->save();

    return redirect()->route('piso_list')->with('status', 'Editar piso '.$piso->nombre.' editado!');
    }

    $usuarios = Usuario::all();

    return view('piso.update' , ['piso' => $piso , 'usuarios' => $usuarios]);

}

function filtro(Request $request){
    if($request->has('check')){
        $pisosFiltrados = Piso::filtroAND($request->buscador, $request->saldo);
    }else{
        $pisosFiltrados = Piso::filtroOR($request->buscador, $request->saldo);
    }
        return view('piso.list', ['pisos' => $pisosFiltrados]);
    }
}