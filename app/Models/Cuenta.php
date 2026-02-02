<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Flight;

class Cuenta extends Model
{
    
    public function cliente(): BelongsTo{

        return $this->belongsTo(Cliente::class);

    } 
    
    static function filtroAND($cadena,$saldo) {
        return Cuenta::where('codigo','like',  "%".$cadena."%" )->where('saldo','>', $saldo)->get();
    }
    static function filtroOR($cadena,$saldo) {
        return Cuenta::where('codigo','like',  "%".$cadena."%" )->orWhere('saldo','>', $saldo)->get();
    }
}
