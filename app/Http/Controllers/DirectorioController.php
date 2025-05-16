<?php

namespace App\Http\Controllers;

use App\Models\Directorio;
use App\Models\Socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectorioController extends Controller
{
    public function index()
    {
        // Muestra todos, si solo querés activos usa: ->where('estado', 'activo')
        $registros = Directorio::with(['socio', 'comunidad', 'creador', 'editor'])->get();
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
            'comunidad_id' => $comunidad?->id,
            'cargo' => $request->cargo,
            'gestion' => $request->gestion,
            'periodo_inicio' => $request->periodo_inicio,
            'periodo_fin' => $request->periodo_fin,
            'descripcion' => $request->descripcion,
            'estado' => 'activo',
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
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
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('directorio.index')->with('success', 'Registro actualizado.');
    }

    public function destroy(Directorio $directorio)
    {
        $directorio->update([
            'estado' => 'inactivo',
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('directorio.index')->with('success', 'Registro inhabilitado correctamente.');
    }

    public function show(Directorio $directorio)
    {
        $directorio->load(['socio', 'comunidad', 'creador', 'editor']);
        return view('directorio.show', compact('directorio'));
    }
}
