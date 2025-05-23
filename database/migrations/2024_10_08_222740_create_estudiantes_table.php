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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->integer('cedula')->nullable();
            $table->string('nombre');
            $table->string('segundo')->nullable();
            $table->string('paterno');
            $table->string('materno')->nullable();
            $table->date('fecha');
            $table->string('lugar')->nullable();
            $table->enum('sexo',['m','f']);
            $table->string('institucion_procedencia')->nullable();
            $table->enum('lentes',['si','no']);
            $table->string('tratamiento')->nullable();
            $table->string('vive_con')->default('Madre');
            $table->enum('parto',['natural','cesarea']);
            $table->enum('alergias',['asma','respiratorias','rinitis','ninguna'])->nullable();
            $table->enum('tipo',['Normal','Especial','Exonerado'])->default('Normal');

            $table->enum('graduado',[0,1])->default(0);
            

            $table->foreignId('parroquia_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
