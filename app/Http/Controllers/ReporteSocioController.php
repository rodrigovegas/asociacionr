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
        $query = Socio::with('canales');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
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

        // ✅ Vista principal actualizada
        return view('socios.reportes.index', compact('socios', 'canales', 'request'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new SociosExport($request), 'reporte_socios.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $query = Socio::with('canales');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
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

        $pdf = PDF::loadView('socios.reportes.export_pdf', compact('socios'));
        return $pdf->download('reporte_socios.pdf');
    }
}
