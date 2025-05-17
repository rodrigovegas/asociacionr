<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reunion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reuniones';

    protected $fillable = [
        'nombre',
        'tipo',
        'canal_id',
        'fecha',
        'hora',
        'descripcion',
        'multa_monto',
        'multa_tercera_edad',
        'estado',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'fecha',
        'hora',
        'deleted_at',
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
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
