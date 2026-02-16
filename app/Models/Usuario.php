<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function nombreApellido (){

        return $this->nombre." ".$this->apellidos;

    }

    protected function casts():array{

        return ['fechaN' => 'datetime:Y-m-d' , ];

    }

    protected function pisos(): HasMany{
        return $this->hasMany(Piso::class);
    }
}
