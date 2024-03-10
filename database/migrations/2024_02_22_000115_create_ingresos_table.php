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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recibo_pago_id')->constrained()->onDelete('cascade');
            $table->string('ejercicio_fiscal');
            $table->date('fecha_elaboracion');
            $table->decimal('saldo_mes', 10, 2);
            $table->string('folio_inicial');
            $table->string('folio_final');
            $table->integer('cantidad_folios_utilizados');
            $table->integer('ingresos_subgrupo');
            $table->date('fecha_inicio_periodo_informe');
            $table->date('fecha_corte_periodo_informe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
