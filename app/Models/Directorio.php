<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorio extends Model
{
    use HasFactory;

    protected $table = 'directorio';

    protected $fillable = [
        'socio_id',
        'comunidad_id',
        'cargo',
        'gestion',
        'periodo_inicio',
        'periodo_fin',
        'descripcion',
        'estado',
        'created_by',
        'updated_by',
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
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
