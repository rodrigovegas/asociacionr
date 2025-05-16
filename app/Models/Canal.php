<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    use HasFactory;

    protected $table = 'canals';

    protected $fillable = [
        'nombre',
        'comunidad_id',
        'descripcion',
        'estado',
        'created_by',
        'updated_by',
    ];

    // Relación con la comunidad
    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }

    // Usuario que creó el canal
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Usuario que actualizó por última vez
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
