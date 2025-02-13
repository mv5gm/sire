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
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->integer('cedula')->unique()->nullable();
            $table->string('nombre');
            $table->string('segundo')->nullable();
            $table->string('paterno');
            $table->string('materno')->nullable();
            $table->string('direccion');
            $table->string('telefono')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representantes');
    }
};
