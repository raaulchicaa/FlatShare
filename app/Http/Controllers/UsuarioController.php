<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Cliente;
use Illuminate\Support\Facades\File;

class ClienteController extends Controller
{
function list() 
{
    $clientes = Cliente::all();

    return view('cliente.list', ['clientes' => $clientes]);
}

function new(Request $request) 
{
    if ($request->isMethod('post')) {    
    // recogemos los campos del formulario en un objeto cuenta

    $hoy = new \DateTime();

    $validated = $request->validate([
    'DNI' => 'required|unique:clientes|size:9',
    'nombre' => 'required',
    'apellidos' => 'required',
    'fechaN' => 'before_or_equal:'.$hoy -> format('d-m-Y') ,
    ]);

   

    $cliente = new Cliente;

    $cliente->DNI = $request->DNI;

    $cliente->nombre = $request->nombre;

    $cliente->apellidos = $request->apellidos;

    $cliente->fechaN = $request->fechaN;

    if($request->file('imagen')){
    $file = $request->file('imagen');
    $filename = $cliente->nombre.'_'.$cliente->apellidos.'_'.uniqid().'.'.$file->extension();
    // guardamos en una variable $filename el nombre que pondremos
    //al fichero
    $file->move(public_path('uploads/imagenes'), $filename);
    $cliente->imagen = $filename;
    }

    $cliente->save();

    return redirect()->route('cliente_list')->with('status', 'Nuevo cliente '.$cliente->DNI.' creada!');
 }
    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    return view('cliente.new');
}

function delete($id) 
{ 
    $cliente = Cliente::find($id);
    $cliente->delete();
    return redirect()->route('cliente_list')->with('status', 'Cliente '.$cliente->DNI.' eliminada!');
}


function update(Request $request , $id) 
{

    $cliente = Cliente::find($id);

    if ($request->isMethod('post')) {   
        
        
    $hoy = new \DateTime();

    $validated = $request->validate([
    'DNI' => 'required',
    Rule::unique('clientes')->ignore($cliente->id),
    'size:9',
    'nombre' => 'required',
    'apellidos' => 'required',
    'fechaN' => 'before_or_equal:'.$hoy -> format('d-m-Y') ,
    ]);


    $cliente->DNI = $request->DNI;

    $cliente->nombre = $request->nombre;

    $cliente->apellidos = $request->apellidos;

    $cliente->fechaN = $request->fechaN;



    if($request->file('imagen')){
    $file = $request->file('imagen');
    $filename = $cliente->nombre.'_'.$cliente->apellidos.'_'.uniqid().'.'.$file->extension();
    // guardamos en una variable $filename el nombre que pondremos
    //al fichero
    $file->move(public_path('uploads/imagenes'), $filename);
    $cliente->imagen = $filename;
    }

    if(isset($request->borrarI)){

        File::delete(public_path('uploads/imagenes/'.$cliente->imagen));

        $cliente->imagen=null;

    }
    


    $cliente->save();

    return redirect()->route('cliente_list')->with('status', 'Editar cliente '.$cliente->DNI.' editada!');
    }

    

    return view('cliente.update' , ['cliente' => $cliente]);

}
}
