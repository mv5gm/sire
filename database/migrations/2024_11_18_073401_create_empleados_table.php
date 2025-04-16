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
        Schema::create('empleados', function (Blueprint $table) {
            
            $table->id();
            $table->integer('cedula')->unique();
            $table->string('nombre');
            $table->string('segundo');
            $table->string('paterno');
            $table->string('materno');
            $table->string('direccion');
            $table->integer('horas')->nullable();
            $table->integer('matricula')->nullable();
            $table->decimal('sueldo',10,2)->nullable();
            $table->enum('tipo',['Obrero','Docente','Maestro','Administrativo']);
            $table->enum('banco',
                [
                    'BANCO DE VENEZUELA',
                    'BANCO CENTRAL DE VENEZUELA',
                    'BANCO DEL TESORO',
                    'BANCO DEL COMERCIO EXTERIOR (BANCOEX)',
                    'BANCO DE EXPORTACION Y COMERCIO',
                    'BANESCO',
                    'BANCO INDUSTRIAL DE VENEZUELA',
                    'BANCO BICENTENARIO',
                    'BANCO PROVINCIAL',
                    'CITIBANK SUCURSAL VENEZUELA',
                    'BANCO OCCIDENTAL DEL DESCUENTO',
                    'CORP BANCA',
                    'BANCO EXTERIOR',
                    'BANPLUS',
                    'BANCO NACIONAL DEL CREDITO',
                    'BANCO ACTIVO',
                    'BANCO DEL CARIBE',
                    'BANCO FONDO COMUN',
                    'BANCO MERCANTIL',
                    '100% BANCO',
                    'BANCO SOFITASA',
                    'BANCO ESPIRITU SANTO',
                    'BANCO PLAZA',
                    'BANFANB'
                ]
            );
            $table->string('cuenta');
            $table->enum('tipo_cuenta',['Corriente','Ahorro','Digital']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
