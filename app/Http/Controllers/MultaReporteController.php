<?php

namespace App\Http\Controllers;

use App\Models\Multa;
use App\Models\Canal;
use Illuminate\Http\Request;
use App\Exports\MultasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;



class MultaReporteController extends Controller
{
    public function index(Request $request)
    {
        $query = Multa::with(['socio.canales', 'reunion']);

        // Filtros
        if ($request->filled('canal_id')) {
            $query->whereHas('socio.canales', fn($q) => $q->where('canales.id', $request->canal_id));
        }

        if ($request->filled('pagado')) {
            $query->where('pagado', $request->pagado);
        }

        if ($request->filled('tipo')) {
            $query->whereHas('reunion', fn($q) => $q->where('tipo', $request->tipo));
        }

        if ($request->filled('desde')) {
            $query->whereHas('reunion', fn($q) => $q->where('fecha', '>=', $request->desde));
        }

        if ($request->filled('hasta')) {
            $query->whereHas('reunion', fn($q) => $q->where('fecha', '<=', $request->hasta));
        }

        $multas = $query->get();
        $canales = Canal::all();

        // Totales
        $total = $multas->sum('monto');
        $total_pagado = $multas->where('pagado', true)->sum('monto');
        $total_pendiente = $total - $total_pagado;

        return view('multas.reportes.index', compact('multas', 'canales', 'total', 'total_pagado', 'total_pendiente'));
    }
    public function exportExcel(Request $request)
    {
        $query = Multa::with(['socio', 'reunion', 'socio.canales']);

        if ($request->filled('canal_id')) {
            $query->whereHas('socio.canales', fn($q) => $q->where('canales.id', $request->canal_id));
        }

        if ($request->filled('pagado')) {
            $query->where('pagado', $request->pagado);
        }

        if ($request->filled('tipo')) {
            $query->whereHas('reunion', fn($q) => $q->where('tipo', $request->tipo));
        }

        if ($request->filled('desde')) {
            $query->whereHas('reunion', fn($q) => $q->where('fecha', '>=', $request->desde));
        }

        if ($request->filled('hasta')) {
            $query->whereHas('reunion', fn($q) => $q->where('fecha', '<=', $request->hasta));
        }

        $multas = $query->get();

        return Excel::download(new MultasExport($multas), 'reporte_multas.xlsx');
    }
    public function exportPdf(Request $request)
    {
        $query = Multa::with(['socio', 'reunion', 'socio.canales']);

        if ($request->filled('canal_id')) {
            $query->whereHas('socio.canales', fn($q) => $q->where('canales.id', $request->canal_id));
        }

        if ($request->filled('pagado')) {
            $query->where('pagado', $request->pagado);
        }

        if ($request->filled('tipo')) {
            $query->whereHas('reunion', fn($q) => $q->where('tipo', $request->tipo));
        }

        if ($request->filled('desde')) {
            $query->whereHas('reunion', fn($q) => $q->where('fecha', '>=', $request->desde));
        }

        if ($request->filled('hasta')) {
            $query->whereHas('reunion', fn($q) => $q->where('fecha', '<=', $request->hasta));
        }

        $multas = $query->get();

        $pdf = Pdf::loadView('multas.reportes.export_pdf', compact('multas'));
        return $pdf->download('reporte_multas.pdf');
    }
}
