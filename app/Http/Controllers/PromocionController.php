<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoriaCliente;
use App\Models\Promocion;
use App\Models\Local;
use App\Models\UsoPromocion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $usuario = auth()->user();
        $idTipo = $usuario->idTipo;
        $idUsuario = $usuario->id;
        if ($idTipo == 2) {
            $local = Local::where('idUsuario',$idUsuario)->get();
            $promociones = Promocion::where('idLocal',$local[0]->id)->with('categoriaMinima')->get();
            return view('dueno.promociones', compact('promociones'));
        } 
        if ($idTipo == 1) {
            //$promociones = Promocion::where('estado','Pendiente')->with('categoriaMinima')->with('local')->get();

            $promociones = Promocion::where('estado', 'Pendiente')
            ->with(['categoriaMinima', 'local'])
            ->get()
            ->sortBy([
                ['local.nombre', 'asc'],
                ['id', 'asc'],
            ]);
            
            logger($promociones);
            return view('admin.promociones', compact('promociones'));
        }
        if ($idTipo == 3) {
            $idCategoria = $usuario->idCategoriaCliente;
            $promociones = Promocion::getVigentesYAprobadasPorCategoria($idCategoria);
            $usos_promociones = UsoPromocion::allByUser($idUsuario);
            // Obtener una colección de los IDs de las promociones usadas.
            $ids_promociones_utilizadas = $usos_promociones->pluck('idPromocion');

            // Filtrar la colección de promociones.
            $promociones_disponibles = $promociones->whereNotIn('id', $ids_promociones_utilizadas);
            
            if ($request->has('search') && $request->search !== '') {
                $search = $request->search;
                $promociones_disponibles = $promociones_disponibles->filter(function ($promocion) use ($search) {
                    // Usa Str::contains para buscar el texto de forma insensible a mayúsculas y minúsculas
                    return Str::contains($promocion->local->nombre, $search, true);
                });
            }

            return view('cliente.promociones', compact('usos_promociones','promociones_disponibles'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $usuario = auth()->user();
        try {
            $validated = $request->validate([
                'texto' => 'required|string|max:255',
                'fechaDesde' => 'required|date',
                'fechaHasta' => 'required|date|after:fecha_desde',
                'idCategoriaMinima' => 'integer|exists:categorias_clientes,id',
                'diasSemana' => 'required',
                'idLocal' => 'required|exists:locales,id'
            ]);

            $promocion = new Promocion();
            $promocion -> texto = $validated['texto'];
            $promocion -> fechaDesde = $validated['fechaDesde'];
            $promocion -> fechaHasta = $validated['fechaHasta'];
            $promocion -> idCategoriaMinima = $validated['idCategoriaMinima'];
            $promocion -> diasSemana = $validated['diasSemana'];
            $promocion -> estado = 'Pendiente';
            //$idLocal = Local::where('idUsuario',$usuario->id)->get()[0]->id;
            $promocion -> idLocal = $validated['idLocal'];;
            $promocion->save();
            return redirect()->route('promociones')->with('success', 'Registro exitoso.');
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
    public function show(Promocion $promocion) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promocion $promocion) {
        // Validación general de los campos que podrían actualizarse
        $validatedData = $request->validate([
            'estado' => 'nullable|string|in:Aprobada,Denegada,Pendiente'
        ]);

        // Actualiza solo los campos presentes en la request
        
        $promocion->fill($validatedData);
        $promocion->save();

        return redirect()->back()->with('success', 'Uso de promoción actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idPromocion) {
        $promocion = Promocion::findOrFail($idPromocion);
        $promocion->delete();

        return redirect()->back()->with('success', 'Promoción eliminada correctamente.');
    }

    public function agregarPromocion() {
        $categorias = CategoriaCliente::get();
        $locales = Local::where('idUsuario', auth()->user()->id)->get();
        return view('dueno.promociones_add', compact('categorias', 'locales'));
    }

}
