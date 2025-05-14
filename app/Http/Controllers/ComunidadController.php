<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    public function index()
    {
        $comunidades = Comunidad::all();
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
        ]);

        Comunidad::create($request->all());
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
        ]);

        $comunidad->update($request->all());
        return redirect()->route('comunidades.index')->with('success', 'Comunidad actualizada con éxito.');
    }

    public function destroy(Comunidad $comunidad)
    {
        $comunidad->delete();
        return redirect()->route('comunidades.index')->with('success', 'Comunidad eliminada.');
    }
}
