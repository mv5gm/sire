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
            $table->integer('cedula')->unique()->nullable();
            $table->string('nombre');
            $table->string('segundo');
            $table->string('paterno');
            $table->string('materno');
            $table->date('fecha');
            $table->string('lugar');
            $table->enum('sexo',['m','f']);
            $table->enum('graduado',[0,1])->default(0);

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
