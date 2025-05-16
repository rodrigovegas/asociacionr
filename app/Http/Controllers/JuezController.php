<?php

namespace App\Http\Controllers;

use App\Models\Juez;
use App\Models\Socio;
use App\Models\Canal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuezController extends Controller
{
    public function index()
    {
        // Si quieres mostrar solo activos: ->where('estado', 'activo')
        $jueces = Juez::with(['socio', 'canal', 'creador', 'editor'])->get();

        return view('jueces.index', compact('jueces'));
    }

    public function create()
    {
        $socios = Socio::all();
        $canales = Canal::with('comunidad')->get();
        return view('jueces.create', compact('socios', 'canales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'canales' => 'array',
            'canales.*' => 'exists:canals,id',
            'gestion' => 'required|string|max:20',
            'descripcion' => 'nullable|string',
        ]);

        Juez::create([
            'socio_id' => $request->socio_id,
            'canal_id' => $request->canal_id,
            'gestion' => $request->gestion,
            'descripcion' => $request->descripcion,
            'estado' => 'activo',
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('jueces.index')->with('success', 'Juez registrado correctamente.');
    }

    public function edit(Juez $juez)
    {
        $socios = Socio::all();
        $canales = Canal::with('comunidad')->get();
        return view('jueces.edit', compact('juez', 'socios', 'canales'));
    }

    public function update(Request $request, Juez $juez)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'canales' => 'array',
            'canales.*' => 'exists:canals,id',
            'gestion' => 'required|string|max:20',
            'descripcion' => 'nullable|string',
        ]);

        $juez->update([
            'socio_id' => $request->socio_id,
            'canal_id' => $request->canal_id,
            'gestion' => $request->gestion,
            'descripcion' => $request->descripcion,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('jueces.index')->with('success', 'Juez actualizado.');
    }

    public function destroy(Juez $juez)
    {
        $juez->update([
            'estado' => 'inactivo',
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('jueces.index')->with('success', 'Juez inhabilitado correctamente.');
    }

    public function show(Juez $juez)
    {
        $juez->load(['socio', 'canal', 'creador', 'editor']);
        return view('jueces.show', compact('juez'));
    }
}
