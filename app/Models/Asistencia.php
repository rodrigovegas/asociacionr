<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = ['reunion_id', 'socio_id', 'asistio', 'observacion'];

    public function reunion()
    {
        return $this->belongsTo(Reunion::class);
    }

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }
}
