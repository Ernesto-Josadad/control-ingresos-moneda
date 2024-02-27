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
        Schema::create('clave_subgrupos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clave_grupo_id')->constrained()->onDelete('cascade');
            $table->string('codigo');
            $table->string('descripcion');
            $table->decimal('costo', 10, 2);
            // Índice para mejorar el rendimiento en búsquedas
            $table->index('codigo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clave_subgrupos');
    }
};
