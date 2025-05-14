<?php

namespace App\Http\Controllers;

use App\Models\Directorio;
use App\Models\Socio;
use App\Models\Comunidad;
use Illuminate\Http\Request;

class DirectorioController extends Controller
{
    public function index()
    {
        $registros = Directorio::with(['socio', 'comunidad'])->get();
        return view('directorio.index', compact('registros'));
    }

    public function create()
    {
        $socios = Socio::with('canales.comunidad')->get();
        return view('directorio.create', compact('socios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'cargo' => 'required|string|max:100',
            'gestion' => 'required|string|max:20',
            'periodo_inicio' => 'nullable|date',
            'periodo_fin' => 'nullable|date',
            'descripcion' => 'nullable|string'
        ]);

        $socio = Socio::with('canales.comunidad')->findOrFail($request->socio_id);
        $comunidad = optional($socio->canales->first())->comunidad;

        Directorio::create([
            'socio_id' => $socio->id,
            'comunidad_id' => $comunidad?->id, // usa operador seguro
            'cargo' => $request->cargo,
            'gestion' => $request->gestion,
            'periodo_inicio' => $request->periodo_inicio,
            'periodo_fin' => $request->periodo_fin,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('directorio.index')->with('success', 'Registro guardado.');
    }

    public function edit(Directorio $directorio)
    {
        $socios = Socio::with('canales.comunidad')->get();
        return view('directorio.edit', compact('directorio', 'socios'));
    }

    public function update(Request $request, Directorio $directorio)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'cargo' => 'required|string|max:100',
            'gestion' => 'required|string|max:20',
            'periodo_inicio' => 'nullable|date',
            'periodo_fin' => 'nullable|date',
            'descripcion' => 'nullable|string'
        ]);

        $socio = Socio::with('canales.comunidad')->findOrFail($request->socio_id);
        $comunidad = optional($socio->canales->first())->comunidad;

        $directorio->update([
            'socio_id' => $socio->id,
            'comunidad_id' => $comunidad?->id,
            'cargo' => $request->cargo,
            'gestion' => $request->gestion,
            'periodo_inicio' => $request->periodo_inicio,
            'periodo_fin' => $request->periodo_fin,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('directorio.index')->with('success', 'Registro actualizado.');
    }

    public function destroy(Directorio $directorio)
    {
        $directorio->delete();
        return redirect()->route('directorio.index')->with('success', 'Registro eliminado.');
    }

    public function show(Directorio $directorio)
    {
        return view('directorio.show', compact('directorio'));
    }
}
