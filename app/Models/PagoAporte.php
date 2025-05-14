<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PagoAporte extends Model
{
    use HasFactory;
    protected $table = 'pagos_aportes';

    protected $fillable = [
        'aporte_id',
        'socio_id',
        'monto',
        'pagado',
        'fecha_pago',
        'observacion',
    ];

    public function aporte()
    {
        return $this->belongsTo(Aporte::class);
    }

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }
}
