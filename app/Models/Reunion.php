<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;
    protected $table = 'reuniones';

    protected $fillable = [
        'nombre',
        'tipo',
        'canal_id',
        'fecha',
        'descripcion',
        'multa_monto',
        'multa_tercera_edad',
    ];


    public function canal()
    {
        return $this->belongsTo(Canal::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function multas()
    {
        return $this->hasMany(Multa::class);
    }
}