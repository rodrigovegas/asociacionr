<?php

namespace App\Http\Controllers;

use App\Models\AporteMaquinaria;
use App\Models\Socio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AporteMaquinariaController extends Controller
{
    public function index()
    {
        $aportes = AporteMaquinaria::with('socio')->orderByDesc('fecha_aporte')->get();
        return view('aportes-maquinaria.index', compact('aportes'));
    }

    public function create()
    {
        $socios = Socio::orderBy('apellidos')->get();
        return view('aportes-maquinaria.create', compact('socios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'tipo_maquinaria' => 'required|in:maquinaria agrícola,maquinaria pesada',
            'monto_por_hora' => 'required|numeric|min:0',
            'horas_requeridas' => 'required|numeric|min:0',
            'fecha_aporte' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        AporteMaquinaria::create([
            'socio_id' => $request->socio_id,
            'tipo_maquinaria' => $request->tipo_maquinaria,
            'monto_por_hora' => $request->monto_por_hora,
            'horas_requeridas' => $request->horas_requeridas,
            'total' => $request->monto_por_hora * $request->horas_requeridas,
            'fecha_aporte' => $request->fecha_aporte,
            'descripcion' => $request->descripcion,
            'estado' => 'activo',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('aportes-maquinaria.index')->with('success', 'Aporte registrado correctamente.');
    }

    public function show(AporteMaquinaria $aporte)
    {
        return view('aportes-maquinaria.show', compact('aporte'));
    }

    public function edit(AporteMaquinaria $aporte)
    {
        $socios = Socio::orderBy('apellidos')->get();
        return view('aportes-maquinaria.edit', compact('aporte', 'socios'));
    }

    public function update(Request $request, AporteMaquinaria $aporte)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'tipo_maquinaria' => 'required|in:maquinaria agrícola,maquinaria pesada',
            'monto_por_hora' => 'required|numeric|min:0',
            'horas_requeridas' => 'required|numeric|min:0',
            'fecha_aporte' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        $aporte->update([
            'socio_id' => $request->socio_id,
            'tipo_maquinaria' => $request->tipo_maquinaria,
            'monto_por_hora' => $request->monto_por_hora,
            'horas_requeridas' => $request->horas_requeridas,
            'total' => $request->monto_por_hora * $request->horas_requeridas,
            'fecha_aporte' => $request->fecha_aporte,
            'descripcion' => $request->descripcion,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('aportes-maquinaria.index')->with('success', 'Aporte actualizado correctamente.');
    }

    public function destroy(AporteMaquinaria $aporte)
    {
        $aporte->update(['estado' => 'inactivo']);
        return redirect()->route('aportes-maquinaria.index')->with('success', 'Aporte inhabilitado correctamente.');
    }
    public function comprobante(AporteMaquinaria $aporte)
    {
        return view('aportes-maquinaria.comprobante', compact('aporte'));
    }

    public function comprobantePdf(AporteMaquinaria $aporte)
    {
        $pdf = Pdf::loadView('aportes-maquinaria.comprobante_pdf', compact('aporte'));
        return $pdf->download('comprobante_aporte_maquinaria.pdf');
    }
}
