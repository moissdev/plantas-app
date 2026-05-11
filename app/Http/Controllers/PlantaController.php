<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use Illuminate\Http\Request;

class PlantaController extends Controller
{
    // Mostrar lista de plantas
    public function index()
    {
        $plantas = Planta::latest()->get();
        return view('plantas.index', compact('plantas'));
    }

    // Guardar nueva planta
    public function store(Request $request)
    {
        $request->validate([
            'nombre'          => 'required|string|max:255',
            'especie'         => 'required|string|max:255',
            'descripcion'     => 'nullable|string',
            'fecha_registro'  => 'required|date',
        ]);

        Planta::create($request->only([
            'nombre',
            'especie',
            'descripcion',
            'fecha_registro',
        ]));

        return redirect()->route('plantas.index')
                         ->with('success', 'Planta registrada correctamente.');
    }

    // Eliminar una planta
    public function destroy(Planta $planta)
    {
        $planta->delete();

        return redirect()->route('plantas.index')
                         ->with('success', 'Planta eliminada.');
    }
}
