<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo_aporte',
        'canal_id',
        'monto_por_hectarea',
        'usar_superficie_riego',
        'descripcion',
    ];

    public function canal()
    {
        return $this->belongsTo(Canal::class);
    }

    public function pagos()
    {
        return $this->hasMany(PagoAporte::class);
    }
}
