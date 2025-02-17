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
            $table->enum('residencia',['padres','familiar','padre','madre'])->default('padres');
            $table->enum('situacion',['separados','juntos'])->default('juntos');
            $table->enum('graduado',[0,1])->default(0);

            $table->foreignId('parroquia_id')->constrained()->onDelete('cascade')->default(1);

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
