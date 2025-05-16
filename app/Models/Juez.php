<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juez extends Model
{
    use HasFactory;

    protected $table = 'jueces';

    protected $fillable = [
        'socio_id',
        'canal_id',
        'gestion',
        'descripcion',
        'estado',
        'created_by',
        'updated_by',
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function canal()
    {
        return $this->belongsTo(Canal::class);
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

