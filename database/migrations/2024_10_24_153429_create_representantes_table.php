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
            $table->enum('estado_civil',['Soltero(a)','Casado(a)','Divorciado(a)','Viudo(a)','Concubinato']);
            $table->enum('condicion_laboral',['Empleado(a)','Desempleado(a)']);
            $table->string('oficio');
            $table->string('direccion_habitacion');
            $table->string('direccion_trabajo')->nullable();
            $table->string('lugar_nacimiento');
            $table->date('fecha');
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
