<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReunionesTable extends Migration
{
    public function up()
    {
        Schema::create('reuniones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->enum('tipo', ['general', 'canal', 'jueces', 'directorio']);
            $table->foreignId('canal_id')->nullable()->constrained()->onDelete('set null');
            $table->date('fecha');
            $table->time('hora')->nullable(); // ✅ NUEVO: hora de la reunión
            $table->text('descripcion')->nullable();
            $table->decimal('multa_monto', 8, 2)->nullable();
            $table->boolean('multa_tercera_edad')->default(false);
            $table->string('estado')->default('activo');

            $table->unsignedBigInteger('created_by')->nullable(); // ✅ quién creó
            $table->unsignedBigInteger('updated_by')->nullable(); // ✅ quién actualizó

            $table->timestamps(); // incluye created_at y updated_at
            $table->softDeletes(); // ✅ eliminación lógica (deleted_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('reuniones');
    }
}
