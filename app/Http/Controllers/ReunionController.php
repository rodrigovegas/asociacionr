<?php

namespace App\Http\Controllers;

use App\Models\Reunion;
use App\Models\Asistencia;
use App\Models\Multa;
use App\Models\Socio;
use App\Models\Canal;
use App\Models\Juez;
use App\Models\Directorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReunionController extends Controller
{
    public function index()
    {
        $reuniones = Reunion::with('canal')->withTrashed()->orderByDesc('fecha')->get();

        return view('reuniones.index', compact('reuniones'));
    }

    public function create()
    {
        $canales = Canal::with('comunidad')->get();
        return view('reuniones.create', compact('canales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'nullable|string|max:255',
            'tipo' => 'required|in:general,canal,jueces,directorio',
            'canal_id' => 'nullable|exists:canales,id',
            'fecha' => 'required|date',
            'hora' => 'nullable|date_format:H:i',
            'descripcion' => 'nullable|string',
            'multa_monto' => 'nullable|numeric|min:0',
            'multa_tercera_edad' => 'nullable|boolean',
        ]);

        $reunion = Reunion::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'canal_id' => $request->canal_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'descripcion' => $request->descripcion,
            'multa_monto' => $request->multa_monto,
            'multa_tercera_edad' => $request->boolean('multa_tercera_edad'),
            'estado' => 'activo',
            'created_by' => Auth::id(),
        ]);

        // Asociar socios según tipo
        $socios = match ($reunion->tipo) {
            'general'    => Socio::all(),
            'canal'      => optional($reunion->canal)->socios ?? collect(),
            'jueces'     => Socio::whereIn('id', Juez::pluck('socio_id'))->get(),
            'directorio' => Socio::whereIn('id', Directorio::pluck('socio_id'))->get(),
        };

        foreach ($socios as $socio) {
            Asistencia::create([
                'reunion_id' => $reunion->id,
                'socio_id'   => $socio->id,
                'asistio'    => false,
            ]);
        }

        return redirect()->route('reuniones.edit', $reunion)->with('success', 'Reunión creada. Puedes marcar asistencia.');
    }

    public function edit(Reunion $reunion)
    {
        $reunion->load('asistencias.socio');
        return view('reuniones.edit', compact('reunion'));
    }

    public function update(Request $request, Reunion $reunion)
    {
        foreach ($request->asistencias ?? [] as $id => $valor) {
            Asistencia::where('id', $id)->update(['asistio' => $valor === '1']);
        }

        // Generar multas
        $reunion->load(['asistencias.socio']);

        foreach ($reunion->asistencias as $asistencia) {
            $socio = $asistencia->socio;

            if (!$asistencia->asistio) {
                $esTerceraEdad = $socio->es_tercera_edad ?? false;

                if (!$esTerceraEdad || ($esTerceraEdad && $reunion->multa_tercera_edad)) {
                    Multa::updateOrCreate([
                        'socio_id' => $socio->id,
                        'reunion_id' => $reunion->id
                    ], [
                        'monto' => $reunion->multa_monto ?? 0,
                        'pagado' => false,
                        'fecha_pago' => null,
                        'observacion' => 'Inasistencia'
                    ]);
                }
            } else {
                Multa::where('reunion_id', $reunion->id)
                    ->where('socio_id', $socio->id)
                    ->delete();
            }
        }
        $reunion->updated_by = Auth::id();
        $reunion->touch();

        return back()->with('success', 'Asistencia y multas actualizadas correctamente.');
    }

    public function destroy(Reunion $reunion)
    {
        $reunion->delete();
        return redirect()->route('reuniones.index')->with('success', 'Reunión eliminada.');
    }

    public function show(Reunion $reunion)
    {
        $reunion->load('asistencias.socio');
        return view('reuniones.show', compact('reunion'));
    }
}
