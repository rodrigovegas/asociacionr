<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use App\Models\Canal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SocioController extends Controller
{
    public function index()
    {
        $socios = Socio::with(['canales', 'socioOrigen'])->get();
        return view('socios.index', compact('socios'));
    }

    public function create()
    {
        $canales = Canal::with('comunidad')->get();
        $todosLosSocios = Socio::all();
        return view('socios.create', compact('canales', 'todosLosSocios'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'ci' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'tipo_ingreso' => 'required|in:original,transferencia,herencia',
            'socio_origen_id' => 'nullable|exists:socios,id',
            'sistema' => 'nullable|string|max:50',
            'superficie_total' => 'nullable|numeric',
            'superficie_riego' => 'nullable|numeric',
            'canales' => 'array|exists:canales,id',
            'codigo_socio' => 'required|string|unique:socios,codigo_socio',
            'fecha_ingreso' => 'required|date',
            'numero_turnos' => 'required|integer|min:0',
        ]);

        $socio = Socio::create([
            ...$request->except('canales'),
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);

        $socio->canales()->sync($request->input('canales', []));

        return redirect()->route('socios.index')->with('success', 'Socio creado correctamente.');
    }




    public function show(Socio $socio)
    {
        $socio->load(['canales', 'socioOrigen', 'creador', 'editor']);
        return view('socios.show', compact('socio'));
    }


    public function edit(Socio $socio)
    {
        $canales = Canal::with('comunidad')->get();
        $todosLosSocios = Socio::where('id', '!=', $socio->id)->get();
        return view('socios.edit', compact('socio', 'canales', 'todosLosSocios'));
    }


    public function update(Request $request, Socio $socio)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'ci' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'tipo_ingreso' => 'required|in:original,transferencia,herencia',
            'socio_origen_id' => 'nullable|exists:socios,id',
            'sistema' => 'nullable|string|max:50',
            'superficie_total' => 'nullable|numeric',
            'superficie_riego' => 'nullable|numeric',
            'canales' => 'array|exists:canales,id'
        ]);

        $edad = Carbon::parse($request->fecha_nacimiento)->age;

        $socio->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'ci' => $request->ci,
            'telefono' => $request->telefono,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'tipo_ingreso' => $request->tipo_ingreso,
            'socio_origen_id' => $request->socio_origen_id,
            'sistema' => $request->sistema,
            'superficie_total' => $request->superficie_total,
            'superficie_riego' => $request->superficie_riego,
            'es_tercera_edad' => $edad >= 60,
            'updated_by' => Auth::id(),
        ]);

        $socio->canales()->sync($request->canales ?? []);

        return redirect()->route('socios.index')->with('success', 'Socio actualizado.');
    }

    public function destroy(Socio $socio)
    {
        $socio->update([
            'estado' => 'inactivo',
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('socios.index')->with('success', 'Socio inhabilitado correctamente.');
    }


    public function detalle(Socio $socio)
    {
        $socio->load(['canales', 'socioOrigen', 'creador', 'editor']);

        $pdf = Pdf::loadView('socios.pdf', compact('socio'));

        return $pdf->stream('socio_' . $socio->codigo_socio . '.pdf');
    }
}
