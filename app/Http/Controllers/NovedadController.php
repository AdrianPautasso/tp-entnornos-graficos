<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoriaCliente;
use App\Models\Novedad;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class NovedadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $novedades = Novedad::with('categoria')->get();
        return view('admin.novedades', compact('novedades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'texto' => 'required|string|max:255',
                'fechaDesde' => 'required|date',
                'fechaHasta' => 'required|date|after:fecha_desde',
                'idCategoriaMinima' => 'integer|exists:categorias_clientes,id'
            ]);

            $novedad = new Novedad();
            $novedad -> texto = $validated['texto'];
            $novedad -> fechaDesde = $validated['fechaDesde'];
            $novedad -> fechaHasta = $validated['fechaHasta'];
            $novedad -> idCategoriaMinima = $validated['idCategoriaMinima'];

            $novedad->save();

            return redirect()->route('admin.novedades')->with('success', 'Registro exitoso.');
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
    public function show(Novedad $novedad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idNovedad)
    {
        $validated = $request->validate([
            'texto' => 'required|string|max:255',
            'fechaDesde' => 'required|date',
            'fechaHasta' => 'required|date|after:fecha_desde',
            'idCategoriaMinima' => 'integer|exists:categorias_clientes,id'
        ]);
        $novedad = Novedad::findOrFail($idNovedad);
        $novedad->update($validated);
        return redirect()->route('admin.novedades')->with('success', 'Novedad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $novedad = Novedad::findOrFail($id);
        $novedad->delete();

        return redirect()->back()->with('success', 'Novedad eliminada correctamente.');
    }

    public function agregarNovedad() {
        $categorias = CategoriaCliente::get();
        return view('admin.novedades_add', compact('categorias'));
    }

    public function editarNovedad($id) {
        $novedad = Novedad::findOrFail($id);
        $categorias = CategoriaCliente::get();
        $categoriaSelected = CategoriaCliente::find($novedad->idCategoriaMinima);
        return view('admin.novedades_edit', compact('novedad', 'categorias', 'categoriaSelected'));
    }

}