<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAportesMaquinariaTable extends Migration
{
    public function up()
    {
        Schema::create('aportes_maquinaria', function (Blueprint $table) {
            $table->id();

            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');

            $table->enum('tipo_maquinaria', ['maquinaria agrícola', 'maquinaria pesada']);
            $table->decimal('monto_por_hora', 10, 2);
            $table->decimal('horas_requeridas', 10, 2);
            $table->decimal('total', 10, 2);

            $table->date('fecha_aporte');
            $table->text('descripcion')->nullable();

            $table->enum('estado', ['activo', 'inactivo'])->default('activo');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aportes_maquinaria');
    }
}
