<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juez extends Model
{
    use HasFactory;

    protected $table = 'jueces'; 

    protected $fillable = ['socio_id', 'canal_id', 'gestion', 'descripcion'];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function canal()
    {
        return $this->belongsTo(Canal::class);
    }
}
