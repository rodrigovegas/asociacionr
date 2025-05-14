<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    use HasFactory;

    protected $table = 'canales';

    protected $fillable = ['nombre', 'comunidad_id'];

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }

    public function socios()
{
    return $this->belongsToMany(Socio::class);
}

}
