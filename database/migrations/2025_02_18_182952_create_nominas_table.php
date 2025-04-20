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
        Schema::create('nominas', function (Blueprint $table) {
            $table->id();
            $table->decimal('cantidad',10,2);
            $table->enum('mes', range(1, 12));
            $table->integer('anio');
            $table->integer('horas')->nullable();
            $table->integer('matricula')->nullable();
            $table->enum('forma',['Divisa','Transferencia','Efectivo']);
            $table->enum('tipo',['Quincenal','Mensual']);
            $table->enum('quincena',['Primera','Segunda'])->nullable();
            
            $table->foreignId('empleado_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominas');
    }
};
