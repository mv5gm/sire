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
        Schema::create('medicions', function (Blueprint $table) {
            $table->id();
            $table->string('talla');
            $table->string('talla_pantalon')->nullable();
            $table->string('talla_camisa')->nullable();
            $table->integer('talla_zapatos')->nullable();
            $table->integer('peso');
            $table->integer('altura')->nullable();
            $table->timestamps();

            $table->foreignId('estudiante_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicions');
    }
};
