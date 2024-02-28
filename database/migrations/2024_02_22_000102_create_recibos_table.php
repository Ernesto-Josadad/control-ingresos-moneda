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
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_recibo')->unsigned();
            $table->integer('codigo_subgrupos');
            $table->unsignedInteger('cantidad_subgrupos');
            $table->string('entidad_federativa');
            $table->unsignedInteger('importe');
            $table->unsignedBigInteger('monto_total');
            $table->string('monto_total_letras');
            // Llaves foraneas
            $table->foreignId('alumno_id')->constrained()->onDelete('cascade');
            $table->foreignId('clave_grupo_id')->constrained()->onDelete('cascade');
            $table->foreingId('clave_subgrupo_id')->constrained()->onDelete('cascade');
            $table->foreignId('administradore_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibos');
    }
};