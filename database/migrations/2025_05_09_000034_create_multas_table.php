<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('multas', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->foreignId('reunion_id')->constrained('reuniones')->onDelete('cascade');

            // Datos de la multa
            $table->decimal('monto', 10, 2)->default(0);
            $table->boolean('pagado')->default(false);
            $table->date('fecha_pago')->nullable();
            $table->string('observacion')->nullable();

            $table->timestamps();

            // Evitar duplicados
            $table->unique(['socio_id', 'reunion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('multas');
    }
};
