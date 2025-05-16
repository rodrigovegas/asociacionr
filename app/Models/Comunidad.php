<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comunidad extends Model
{

    use HasFactory;
    protected $table = 'comunidades';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'latitud',
        'longitud',
        'created_by',
        'updated_by',
    ];

    // Usuario que creó la comunidad
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
