<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComunidadController extends Controller
{
    public function index()
    {
        // Mostramos todas, incluyendo inactivas si querés
        $comunidades = Comunidad::with(['creador', 'editor'])->get();

        return view('comunidades.index', compact('comunidades'));
    }

    public function create()
    {
        return view('comunidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        Comunidad::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'estado' => 'activo',
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad creada con éxito.');
    }

    public function show(Comunidad $comunidad)
    {
        return view('comunidades.show', compact('comunidad'));
    }

    public function edit(Comunidad $comunidad)
    {
        return view('comunidades.edit', compact('comunidad'));
    }

    public function update(Request $request, Comunidad $comunidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        $comunidad->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad actualizada con éxito.');
    }

    public function destroy(Comunidad $comunidad)
    {
        // Eliminación lógica
        $comunidad->update([
            'estado' => 'inactivo',
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad inhabilitada correctamente.');
    }
}
