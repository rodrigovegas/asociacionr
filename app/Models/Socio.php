<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use App\Models\User;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'ci',
        'telefono',
        'fecha_nacimiento',
        'tipo_ingreso',
        'socio_origen_id',
        'sistema',
        'superficie_total',
        'superficie_riego',
        'es_tercera_edad',
        'codigo_socio',
        'fecha_ingreso',
        'numero_turnos',
        'estado',
        'created_by',
        'updated_by'
    ];


    public function socioOrigen()
    {
        return $this->belongsTo(Socio::class, 'socio_origen_id');
    }


    public function canales()
    {
        return $this->belongsToMany(Canal::class);
    }

    // Mutador para calcular automáticamente tercera edad
    protected static function booted()
    {
        static::saving(function ($socio) {
            $edad = Carbon::parse($socio->fecha_nacimiento)->age;
            $socio->es_tercera_edad = $edad >= 60;
        });
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
