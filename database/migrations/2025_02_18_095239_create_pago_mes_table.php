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
        Schema::create('pago_mes', function (Blueprint $table) {
            $table->id();
            $table->enum('mes',['1','2','3','4','5','6','7','8','9','10','11','12']);
            $table->integer('anio');
            $table->foreignId('pago_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_mes');
    }
};
