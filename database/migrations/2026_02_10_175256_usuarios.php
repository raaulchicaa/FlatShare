<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('numero', 9); 
            $table->boolean('vendedor');
            $table->string('email');
            $table->date('fecha_nac');
        });
    }

   
    public function down(): void
    {
      Schema::dropIfExists('usuarios');
    }
};
