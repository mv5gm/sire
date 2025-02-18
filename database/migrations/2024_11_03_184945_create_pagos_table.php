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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo',['Aranceles','Uniformes','Mensualidad']);
            
            $table->foreignId('representante_id')->constrained()->onDelete('cascade');
            $table->foreignId('estudiante_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingreso_id')->constrained()->onDelete('cascade');
                
            $table->timestamps();
        });     
    }           

    /**     
     * Reverse the migrations.
     */     
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
