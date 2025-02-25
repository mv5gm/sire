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
        Schema::create('representados', function (Blueprint $table) {
                
            $table->id();
            $table->timestamps();
            $table->enum('relacion',['Legal','Autorizado']);
            $table->enum('parentesco',['Madre','Padre','Abuelo(a)','Primo(a)','Tio(a)','Otro(a)']);

            $table->foreignId('estudiante_id')->constrained()->onDelete('cascade');
            $table->foreignId('representante_id')->constrained()->onDelete('cascade');
            $table->foreignId('hogar_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representados');
    }
};
