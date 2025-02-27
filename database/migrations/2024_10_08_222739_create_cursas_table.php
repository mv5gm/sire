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
        Schema::create('cursas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aescolar_id')->constrained()->onDelete('cascade');
            $table->foreignId('seccion_id')->constrained()->onDelete('cascade');
            $table->foreignId('nivel_id')->constrained()->onDelete('cascade');
            $table->foreignId('salon_id')->constrained()->onDelete('cascade')->default(1);
            $table->unique(['aescolar_id','seccion_id','nivel_id','salon_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursas');
    }
};
