<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos')->nullable();
            $table->string('ci', 20)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->date('fecha_nacimiento');
            $table->enum('tipo_ingreso', ['original', 'transferencia', 'herencia'])->default('original');
            $table->foreignId('socio_origen_id')->nullable()->constrained('socios')->onDelete('set null');
            $table->string('sistema', 50)->nullable();
            $table->decimal('superficie_total', 10, 2)->nullable();
            $table->decimal('superficie_riego', 10, 2)->nullable();
            $table->boolean('es_tercera_edad')->default(false);
            $table->string('codigo_socio')->unique();
            $table->date('fecha_ingreso')->nullable();
            $table->integer('numero_turnos')->default(0);
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('socios');
    }
};
