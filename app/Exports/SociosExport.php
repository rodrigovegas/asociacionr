<?php

namespace App\Exports;

use App\Models\Socio;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class SociosExport implements FromView
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Socio::with('canales');

        if ($this->request->filled('estado')) {
            $query->where('estado', $this->request->estado);
        }

        if ($this->request->filled('fecha_desde')) {
            $query->whereDate('fecha_nacimiento', '>=', $this->request->fecha_desde);
        }

        if ($this->request->filled('fecha_hasta')) {
            $query->whereDate('fecha_nacimiento', '<=', $this->request->fecha_hasta);
        }

        if ($this->request->filled('canal_id')) {
            $query->whereHas('canales', function ($q) {
                $q->where('canal_id', $this->request->canal_id);
            });
        }

        if ($this->request->filled('turnos_min')) {
            $query->where('numero_turnos', '>=', $this->request->turnos_min);
        }

        if ($this->request->filled('turnos_max')) {
            $query->where('numero_turnos', '<=', $this->request->turnos_max);
        }

        $socios = $query->get();

        return view('socios.reportes.export_excel', [
            'socios' => $socios
        ]);
    }
}
