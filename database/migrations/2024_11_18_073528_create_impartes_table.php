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
            $table->enum('saber',['Castellano','Física','Matematica','Química','Educacion Fisica']);

            $table->foreignId('empleado_id')->constrained()->onDelete('cascade');
            $table->foreignId('cursa_id')->constrained()->onDelete('cascade');
            
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
