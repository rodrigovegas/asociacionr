<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('directorio', function (Blueprint $table) {
            $table->id();

            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->foreignId('comunidad_id')->constrained('comunidades')->onDelete('cascade');

            $table->string('cargo');
            $table->string('gestion');
            $table->date('periodo_inicio')->nullable();
            $table->date('periodo_fin')->nullable();
            $table->text('descripcion')->nullable();

            $table->enum('estado', ['activo', 'inactivo'])->default('activo');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('directorio');
    }
};
