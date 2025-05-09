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
        Schema::create('impartes', function (Blueprint $table) {
            $table->id();
            $table->enum('momento',['I','II','III']);
            $table->enum('saber',['Castellano','Ingles','Matematicas','Educacion Fisica','Arte y Patrimonio','Ciencias Naturales','Fisica','Quimica','Biologia','Ciencias de la Tierra','Geografia, Historia y Ciudadania','Formacion Para La Soberania Nacional','Orientacion Y Convivencia','Participación en Grupos de Creación, Recreación y Producción ','Educacion Basica']);

            $table->foreignId('empleado_id')->constrained()->onDelete('cascade');
            $table->foreignId('cursa_id')->constrained()->onDelete('cascade');
            
            $table->unique(['momento','saber','empleado_id','cursa_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impartes');
    }
};
