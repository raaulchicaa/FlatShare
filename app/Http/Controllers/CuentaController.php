<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Cuenta;
use App\Models\Cliente;

class CuentaController extends Controller
{
function list() 
{
    $cuentas = Cuenta::all();

    return view('cuenta.list', ['cuentas' => $cuentas]);
}

function new(Request $request) 
{


    if ($request->isMethod('post')) {    
    $validated = $request->validate([
    'codigo' => 'required|unique:cuentas|max:10',
    'saldo' => 'required',
    ]);

    $cuenta = new Cuenta;
    $cuenta->codigo = $request->codigo;
    $cuenta->saldo = $request->saldo;
    $cuenta->cliente_id = $request->cliente_id;
    $cuenta->save();

    

    return redirect()->route('cuenta_list')->with('status', 'Nueva cuenta '.$cuenta->codigo.' creada!');
    }
    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    $clientes = Cliente::all();

    return view('cuenta.new', ['clientes' => $clientes]);
}

function delete($id) 
{ 
    $cuenta = Cuenta::find($id);
    $cuenta->delete();
    return redirect()->route('cuenta_list')->with('status', 'Cuenta '.$cuenta->codigo.' eliminada!');
}


function update(Request $request , $id) 
{

    if ($request->isMethod('post')) {    
    $validated = $request->validate([
    'codigo' => 'required',
    Rule::unique('cuentas')->ignore($cuenta->id),
    'max:10',
    'saldo' => 'required',
    ]);

    }

    $cuenta = Cuenta::find($id);

    if ($request->isMethod('post')) {    

    $cuenta->codigo = $request->codigo;
    $cuenta->saldo = $request->saldo;
    $cuenta->cliente_id = $request->cliente_id;
    $cuenta->save();

    return redirect()->route('cuenta_list')->with('status', 'Editar cuenta '.$cuenta->codigo.' editada!');
    }

    $clientes = Cliente::all();

    return view('cuenta.update' , ['cuenta' => $cuenta , 'clientes' => $clientes]);

}

function filtro(Request $request){
    if($request->has('check')){
        $cuentasFiltradas = Cuenta::filtroAND($request->buscador, $request->saldo);
    }else{
        $cuentasFiltradas = Cuenta::filtroOR($request->buscador, $request->saldo);
    }
        return view('cuenta.list', ['cuentas' => $cuentasFiltradas]);
    }
}