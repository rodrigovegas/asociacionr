<?php

namespace App\Http\Controllers;

use App\Models\Juez;
use App\Models\Socio;
use App\Models\Canal;
use Illuminate\Http\Request;

class JuezController extends Controller
{
    public function index()
    {
        $jueces = Juez::with(['socio', 'canal'])->get();
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
            'canal_id' => 'required|exists:canales,id',
            'gestion' => 'required|string|max:20',
            'descripcion' => 'nullable|string'
        ]);

        Juez::create($request->all());
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
            'canal_id' => 'required|exists:canales,id',
            'gestion' => 'required|string|max:20',
            'descripcion' => 'nullable|string'
        ]);

        $juez->update($request->all());
        return redirect()->route('jueces.index')->with('success', 'Juez actualizado.');
    }

    public function destroy(Juez $juez)
    {
        $juez->delete();
        return redirect()->route('jueces.index')->with('success', 'Juez eliminado.');
    }

    public function show(Juez $juez)
    {
        return view('jueces.show', compact('juez'));
    }
}
