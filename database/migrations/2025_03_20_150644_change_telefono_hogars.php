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
        Schema::table('hogars', function (Blueprint $table) {
            $table->string('telefono_emergencia',50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hogars', function (Blueprint $table) {
            $table->integer('telefono_emergencia')->change();
        });
    }
};
