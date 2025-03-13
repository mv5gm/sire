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
        Schema::create('hogars', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_mayores');
            $table->integer('numero_menores');
            $table->integer('numero_familias');
            $table->integer('numero_ambitos');
            $table->enum('representante_economico',['Padre','Madre','Ambos','Otro']);
            $table->enum('gastos_separados',['si','no']);
            $table->integer('numero_dormitorios');
            $table->integer('telefono_emergencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hogars');
    }
};
