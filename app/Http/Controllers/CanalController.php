<?php

namespace App\Http\Controllers;

use App\Models\Canal;
use App\Models\Comunidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanalController extends Controller
{
    public function index()
    {
        $canales = Canal::with(['comunidad', 'creador', 'editor'])
            //->where('estado', 'activo')
            ->get();

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
            'comunidad_id' => 'nullable|exists:comunidades,id',
            'descripcion' => 'nullable|string',
        ]);

        $canal = new Canal($request->all());
        $canal->created_by = Auth::id();
        $canal->estado = 'activo'; // por si acaso
        $canal->save();

        return redirect()->route('canales.index')->with('success', 'Canal creado correctamente.');
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
            'comunidad_id' => 'nullable|exists:comunidades,id',
            'descripcion' => 'nullable|string',
        ]);

        $canal->fill($request->all());
        $canal->updated_by = Auth::id();
        $canal->save();

        return redirect()->route('canales.index')->with('success', 'Canal actualizado correctamente.');
    }

    public function destroy(Canal $canal)
    {
        $canal->estado = 'inactivo';
        $canal->updated_by = Auth::id();
        $canal->save();

        return redirect()->route('canales.index')->with('success', 'Canal deshabilitado correctamente.');
    }
    
}
