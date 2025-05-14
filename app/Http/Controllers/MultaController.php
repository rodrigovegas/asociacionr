<?php

namespace App\Http\Controllers;

use App\Models\Multa;
use App\Models\Canal;
use App\Models\Reunion;
use Illuminate\Http\Request;

class MultaController extends Controller
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

        $multas = $query->get();
        $canales = Canal::all();

        return view('multas.index', compact('multas', 'canales'));
    }

    public function edit(Multa $multa)
    {
        return view('multas.edit', compact('multa'));
    }

    public function update(Request $request, Multa $multa)
    {
        $request->validate([
            'pagado' => 'required|boolean',
            'fecha_pago' => 'nullable|date',
            'observacion' => 'nullable|string'
        ]);

        $multa->update([
            'pagado' => $request->pagado,
            'fecha_pago' => $request->fecha_pago,
            'observacion' => $request->observacion,
        ]);

        return redirect()->route('multas.index')->with('success', 'Multa actualizada.');
    }
}
