<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use App\Models\Canal;
use Illuminate\Http\Request;
use App\Exports\SociosExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteSocioController extends Controller
{
    public function index(Request $request)
    {
        $canales = Canal::all();

        $tiposIngreso = Socio::select('tipo_ingreso')
            ->distinct()
            ->whereNotNull('tipo_ingreso')
            ->pluck('tipo_ingreso');

        $query = Socio::with(['canales', 'creador', 'editor']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('tipo_ingreso')) {
            $query->where('tipo_ingreso', $request->tipo_ingreso);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_nacimiento', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_nacimiento', '<=', $request->fecha_hasta);
        }

        if ($request->filled('canal_id')) {
            $query->whereHas('canales', function ($q) use ($request) {
                $q->where('canal_id', $request->canal_id);
            });
        }

        if ($request->filled('turnos_min')) {
            $query->where('numero_turnos', '>=', $request->turnos_min);
        }

        if ($request->filled('turnos_max')) {
            $query->where('numero_turnos', '<=', $request->turnos_max);
        }

        $socios = $query->get();

        return view('socios.reportes.index', compact('socios', 'canales', 'tiposIngreso', 'request'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new SociosExport($request), 'reporte_socios.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $query = Socio::with(['canales', 'creador', 'editor']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('tipo_ingreso')) {
            $query->where('tipo_ingreso', $request->tipo_ingreso);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_nacimiento', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_nacimiento', '<=', $request->fecha_hasta);
        }

        if ($request->filled('canal_id')) {
            $query->whereHas('canales', function ($q) use ($request) {
                $q->where('canal_id', $request->canal_id);
            });
        }

        if ($request->filled('turnos_min')) {
            $query->where('numero_turnos', '>=', $request->turnos_min);
        }

        if ($request->filled('turnos_max')) {
            $query->where('numero_turnos', '<=', $request->turnos_max);
        }

        $socios = $query->get();

        $pdf = Pdf::loadView('socios.reportes.export_pdf', compact('socios'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('reporte_socios.pdf');
    }
}
