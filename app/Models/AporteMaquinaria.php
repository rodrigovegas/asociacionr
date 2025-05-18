<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AporteMaquinaria extends Model
{
    use SoftDeletes;

    protected $table = 'aportes_maquinaria';

    protected $fillable = [
        'socio_id',
        'tipo_maquinaria',
        'monto_por_hora',
        'horas_requeridas',
        'total',
        'fecha_aporte',
        'descripcion',
        'estado',
        'created_by',
        'updated_by',
    ];

    // Relaciones
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
