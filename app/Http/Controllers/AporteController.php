<?php

namespace App\Http\Controllers;

use App\Models\Aporte;
use App\Models\PagoAporte;
use App\Models\Socio;
use App\Models\Canal;
use App\Models\Juez;
use App\Models\Directorio;
use Illuminate\Http\Request;

class AporteController extends Controller
{
    public function index()
    {
        $aportes = Aporte::with('canal')->latest()->get();
        return view('aportes.index', compact('aportes'));
    }

    public function create()
    {
        $canales = Canal::with('comunidad')->get();
        return view('aportes.create', compact('canales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_aporte' => 'required|in:general,canal,jueces,directorio',
            'canal_id' => 'nullable|exists:canales,id',
            'monto_por_hectarea' => 'required|numeric|min:0',
            'usar_superficie_riego' => 'nullable|boolean',
            'descripcion' => 'nullable|string'
        ]);

        $aporte = Aporte::create([
            'nombre' => $request->nombre,
            'tipo_aporte' => $request->tipo_aporte,
            'canal_id' => $request->canal_id,
            'monto_por_hectarea' => $request->monto_por_hectarea,
            'usar_superficie_riego' => $request->boolean('usar_superficie_riego'),
            'descripcion' => $request->descripcion,
        ]);

        // Obtener socios según el tipo de aporte
        $socios = collect();
        switch ($aporte->tipo_aporte) {
            case 'general':
                $socios = Socio::all();
                break;
            case 'canal':
                $socios = Socio::whereHas(
                    'canales',
                    fn($q) =>
                    $q->where('canales.id', $aporte->canal_id)
                )->get();
                break;
            case 'jueces':
                $socios = Socio::whereIn('id', Juez::pluck('socio_id'))->get();
                break;
            case 'directorio':
                $socios = Socio::whereIn('id', Directorio::pluck('socio_id'))->get();
                break;
        }

        foreach ($socios as $socio) {
            $monto = $aporte->usar_superficie_riego
                ? ($socio->superficie_riego * $aporte->monto_por_hectarea)
                : $aporte->monto_por_hectarea;

            PagoAporte::create([
                'aporte_id' => $aporte->id,
                'socio_id' => $socio->id,
                'monto' => $monto,
                'pagado' => false,
                'fecha_pago' => null,
                'observacion' => null,
            ]);
        }

        return redirect()->route('aportes.index')->with('success', 'Aporte creado correctamente.');
    }

    public function edit(Aporte $aporte)
    {
        $aporte->load('pagos.socio');
        return view('aportes.edit', compact('aporte'));
    }

    public function update(Request $request, Aporte $aporte)
    {
        if ($request->has('pagos')) {
            foreach ($request->pagos as $pagoId => $datos) {
                $pago = $aporte->pagos()->where('id', $pagoId)->first();
                if ($pago) {
                    $pago->update([
                        'pagado' => isset($datos['pagado']),
                        'fecha_pago' => $datos['fecha_pago'] ?? null,
                        'observacion' => $datos['observacion'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('aportes.edit', $aporte)->with('success', 'Pagos actualizados correctamente.');
    }
}
