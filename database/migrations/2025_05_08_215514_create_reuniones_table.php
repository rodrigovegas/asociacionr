<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reuniones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo', ['general', 'canal', 'jueces', 'directorio']);
            $table->foreignId('canal_id')->nullable()->constrained('canales')->onDelete('set null');
            $table->date('fecha');
            $table->decimal('multa_monto', 10, 2)->nullable();
            $table->boolean('multa_tercera_edad')->default(false);
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reuniones');
    }
};
