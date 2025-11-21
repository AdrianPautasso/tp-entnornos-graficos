<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $locales = Local::with('promociones','usuario')->get();

        return view('admin.locales', compact('locales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'nombre' => 'required|string|max:100|unique:locales,nombre',
                'ubicacion' => 'required|unique:locales,ubicacion|max:50',
                'rubro' => 'required|string|max:50',
            ]);

            $local = new Local();
            $local->nombre = $validated['nombre'];
            $local->ubicacion = $validated['ubicacion'];
            $local->rubro = $validated['rubro'];

            $local->save();

            return redirect()->route('admin.locales')->with('success', 'Registro exitoso.');
        } catch (ValidationException $e) {
            // Errores de validación
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (QueryException $e) {
            // Errores en base de datos (ej: campos únicos duplicados)
            return redirect()->back()
                ->withErrors(['db' => 'Error en la base de datos: ' . $e->getMessage()])
                ->withInput();

        } catch (\Exception $e) {
            // Cualquier otro error
            return redirect()->back()
                ->withErrors(['general' => 'Ocurrió un error inesperado: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idLocal) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'ubicacion' => 'required|string|max:50',
            'rubro' => 'required|string|max:50',
        ]);
        $local = Local::findOrFail($idLocal);
        $local->update($validated);
        return redirect()->route('admin.locales')->with('success', 'Local actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $local = Local::findOrFail($id);
        $local->delete();

        return redirect()->back()->with('success', 'Local eliminado correctamente.');
    }

    public function agregarLocal() {
        return view('admin.locales_add');
    }

    public function editarLocal($idLocal) {
        $local = Local::findOrFail($idLocal);
        return view('admin.locales_edit', compact('local'));
    }
}
