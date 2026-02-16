<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
     public function usuario(): BelongsTo{

        return $this->belongsTo(Usuario::class);

    } 
    
    static function filtroAND($cadena,$saldo) {
        return Cuenta::where('codigo','like',  "%".$cadena."%" )->where('saldo','>', $saldo)->get();
    }
    static function filtroOR($cadena,$saldo) {
        return Cuenta::where('codigo','like',  "%".$cadena."%" )->orWhere('saldo','>', $saldo)->get();
    }
}
