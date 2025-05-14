<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    use HasFactory;

    protected $fillable = [
        'socio_id',
        'reunion_id',
        'monto',
        'pagado',
        'fecha_pago',
        'observacion',
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function reunion()
    {
        return $this->belongsTo(Reunion::class);
    }
}
