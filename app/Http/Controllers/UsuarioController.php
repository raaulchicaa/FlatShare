<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Piso;
use App\Models\Usuario;
use Illuminate\Support\Facades\File;

class UsuarioController extends Controller
{
function list() 
{
    $usuarios = Usuario::all();

    return view('usuario.list', ['usuarios' => $usuarios]);
}

function new(Request $request) 
{
    if ($request->isMethod('post')) {    
    // recogemos los campos del formulario en un objeto cuenta

    $hoy = new \DateTime();

    $validated = $request->validate([
    'DNI' => 'required|unique:usuarios|size:9',
    'nombre' => 'required',
    'apellidos' => 'required',
    'fechaN' => 'before_or_equal:'.$hoy -> format('d-m-Y') ,
    ]);

   

    $usuario = new Usuario;

    $usuario->DNI = $request->DNI;

    $usuario->nombre = $request->nombre;

    $usuario->apellidos = $request->apellidos;

    $usuario->numero = $request->numero;

    $usuario->vendedor = $request->vendedor;

    $usuario->email = $request->email;

    $usuario->fecha_nac = $request->fecha_nac;

    if($request->file('imagen')){
    $file = $request->file('imagen');
    $filename = $usuario->nombre.'_'.$usuario->apellidos.'_'.uniqid().'.'.$file->extension();
    // guardamos en una variable $filename el nombre que pondremos
    //al fichero
    $file->move(public_path('uploads/imagenes'), $filename);
    $usuario->imagen = $filename;
    }

    $usuario->save();

    return redirect()->route('usuario_list')->with('status', 'Nuevo usuario '.$usuario->DNI.' creado!');
 }
    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    return view('usuario.new');
}

function delete($id) 
{ 
    $usuario = Usuario::find($id);
    $usuario->delete();
    return redirect()->route('usuario_list')->with('status', 'Usuario '.$usuario->DNI.' eliminado!');
}


function update(Request $request , $id) 
{

    $usuario = Usuario::find($id);

    if ($request->isMethod('post')) {   
        
        
    $hoy = new \DateTime();

    $validated = $request->validate([
    'DNI' => 'required',
    Rule::unique('usuarios')->ignore($usuario->id),
    'size:9',
    'nombre' => 'required',
    'apellidos' => 'required',
    'numero' => 'required|numeric',
    'vendedor' => 'required|boolean',
    'email' => 'required|email',
    'fecha_nac' => 'before_or_equal:'.$hoy -> format('d-m-Y') ,
    ]);


    $usuario->DNI = $request->DNI;

    $usuario->nombre = $request->nombre;

    $usuario->apellidos = $request->apellidos;

    $usuario->numero = $request->numero;

    $usuario->vendedor = $request->vendedor;

    $usuario->email = $request->email;

    $usuario->fecha_nac = $request->fecha_nac;  

    if($request->file('imagen')){
    $file = $request->file('imagen');
    $filename = $usuario->nombre.'_'.$usuario->apellidos.'_'.uniqid().'.'.$file->extension();
    // guardamos en una variable $filename el nombre que pondremos
    //al fichero
    $file->move(public_path('uploads/imagenes'), $filename);
    $usuario->imagen = $filename;
    }

    if(isset($request->borrarI)){

        File::delete(public_path('uploads/imagenes/'.$usuario->imagen));

        $usuario->imagen=null;

    }
    

    $usuario->save();

    return redirect()->route('usuario_list')->with('status', 'Editar usuario '.$usuario->DNI.' editada!');
    }

    

    return view('usuario.update' , ['usuario' => $usuario]);

}
}
