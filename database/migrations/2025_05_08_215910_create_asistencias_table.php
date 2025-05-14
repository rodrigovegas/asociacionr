<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reunion_id')->constrained('reuniones')->onDelete('cascade');
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->boolean('asistio')->default(false);
            $table->string('observacion')->nullable();
            $table->timestamps();

            $table->unique(['reunion_id', 'socio_id']); // evitar duplicados
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
