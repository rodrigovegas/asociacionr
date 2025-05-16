<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aportes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo_aporte', ['general', 'canal', 'jueces', 'directorio']);
            $table->foreignId('canal_id')->nullable()->constrained('canals')->onDelete('set null');
            $table->decimal('monto_por_hectarea', 10, 2);
            $table->boolean('usar_superficie_riego')->default(true);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        Schema::create('pagos_aportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aporte_id')->constrained('aportes')->onDelete('cascade');
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->boolean('pagado')->default(false);
            $table->date('fecha_pago')->nullable();
            $table->string('observacion')->nullable();
            $table->timestamps();

            $table->unique(['aporte_id', 'socio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos_aportes');
        Schema::dropIfExists('aportes');
    }
};
