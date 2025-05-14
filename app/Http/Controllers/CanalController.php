<?php

namespace App\Http\Controllers;

use App\Models\Canal;
use App\Models\Comunidad;
use Illuminate\Http\Request;

class CanalController extends Controller
{
    public function index()
    {
        $canales = Canal::with('comunidad')->get();
        return view('canales.index', compact('canales'));
    }

    public function create()
    {
        $comunidades = Comunidad::all();
        return view('canales.create', compact('comunidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'comunidad_id' => 'required|exists:comunidades,id',
        ]);

        Canal::create($request->all());
        return redirect()->route('canales.index')->with('success', 'Canal creado correctamente.');
    }

    public function show(Canal $canal)
    {
        return view('canales.show', compact('canal'));
    }

    public function edit(Canal $canal)
    {
        $comunidades = Comunidad::all();
        return view('canales.edit', compact('canal', 'comunidades'));
    }

    public function update(Request $request, Canal $canal)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'comunidad_id' => 'required|exists:comunidades,id',
        ]);

        $canal->update($request->all());
        return redirect()->route('canales.index')->with('success', 'Canal actualizado.');
    }

    public function destroy(Canal $canal)
    {
        $canal->delete();
        return redirect()->route('canales.index')->with('success', 'Canal eliminado.');
    }
}
