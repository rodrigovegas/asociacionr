<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jueces', function (Blueprint $table) {
            $table->id();

            // Relaciones principales
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->foreignId('canal_id')->constrained('canals')->onDelete('cascade');

            $table->string('gestion');
            $table->text('descripcion')->nullable();

            // Auditoría
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
        Schema::dropIfExists('jueces');
    }
};
