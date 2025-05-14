<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorio extends Model
{
    use HasFactory;

    protected $table = 'directorio'; // 👈 importante, porque no es plural en inglés

    protected $fillable = [
        'socio_id',
        'comunidad_id',
        'cargo',
        'gestion',
        'periodo_inicio',
        'periodo_fin',
        'descripcion',
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }
}
