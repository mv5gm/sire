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
                    '100% BANCO',
                    'BANCO ACTIVO',
                    'BANCO AGRICOLA DE VENEZUELA',
                    'BANCO BICENTENARIO',
                    'BANCO CARONI',
                    'BANCO CENTRAL DE VENEZUELA',
                    'BANCO DEL CARIBE',
                    'BANCO DEL COMERCIO EXTERIOR (BANCOEX)',
                    'BANCO DEL TESORO',
                    'BANCO DIGITAL DE LOS TRABAJADORES, BANCO UNIVERSAL',
                    'BANCO ESPIRITU SANTO',
                    'BANCO EXTERIOR',
                    'BANCO FONDO COMUN',
                    'BANCO INDUSTRIAL DE VENEZUELA',
                    'BANCO INTERNACIONAL DE DESARROLLO',
                    'BANCO MERCANTIL',
                    'BANCO NACIONAL DE CREDITO',
                    'BANCO OCCIDENTAL DEL DESCUENTO',
                    'BANCO PLAZA',
                    'BANCO PROVINCIAL',
                    'BANCO SOFITASA',
                    'BANCO VENEZOLANO DE CREDITO',
                    'BANCRECER',
                    'BANESCO',
                    'BANFANB',
                    'BANGENTE',
                    'BANPLUS',
                    'BANCO DE EXPORTACION Y COMERCIO',
                    'BANCAMIGA BANCO UNIVERSAL',
                    'BANCARIBE',
                    'BBVA PROVINCIAL',
                    'CITIBANK SUCURSAL VENEZUELA',
                    'CORP BANCA',
                    'DELSUR BANCO UNIVERSAL',
                    'N58 BANCO DIGITAL BANCO FINANCIERO SA',
                    'R4 BANCO MICROFINANCIERO CA',
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
