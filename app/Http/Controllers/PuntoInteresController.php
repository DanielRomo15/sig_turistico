<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntoInteres;
use Illuminate\Support\Facades\Storage;

class PuntoInteresController extends Controller
{
    public function index(Request $request)
    {
        $query = PuntoInteres::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $puntos = $query->get();
        return view('puntos.index', compact('puntos'));
    }

    public function create()
    {
        return view('puntos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'imagen' => 'nullable|image'
        ]);

       
    public function edit($id)
    {
        $punto = PuntoInteres::findOrFail($id);
        return view('puntos.edit', compact('punto'));
    }

    public function update(Request $request, $id)
    {
        $punto = PuntoInteres::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'imagen' => 'nullable|image'
        ]);

        $punto->fill($request->only(['nombre', 'descripcion', 'categoria', 'latitud', 'longitud']));

        if ($request->hasFile('imagen')) {
            if ($punto->imagen) {
                Storage::disk('public')->delete($punto->imagen);
            }
            $punto->imagen = $request->file('imagen')->store('imagenes', 'public');
        }

        $punto->save();
        return redirect()->route('puntos.index')->with('success', 'Punto actualizado correctamente');
    }

    public function destroy($id)
    {
        $punto = PuntoInteres::findOrFail($id);

        if ($punto->imagen) {
            Storage::disk('public')->delete($punto->imagen);
        }

        $punto->delete();
        return redirect()->route('puntos.index')->with('success', 'Punto eliminado correctamente');
    }
}
