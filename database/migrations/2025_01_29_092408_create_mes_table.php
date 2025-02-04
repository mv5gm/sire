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
        Schema::create('mes', function (Blueprint $table) {
            $table->id();
            $table->enum('mes',['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Septiembre','Octubre','Noviembre','Diciembre']);
            $table->integer('ahno');
            $table->foreignId('pago_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mes');
    }
};
