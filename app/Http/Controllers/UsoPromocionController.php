<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UsoPromocion;
use App\Models\Promocion;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;

class UsoPromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = auth()->user();
        $idTipoUsuario = $usuario->idTipo;
        $idUsuario = $usuario->id;
        switch ($idTipoUsuario) {
            case 1:
                // Admin
                echo "El usuario es del tipo 1.";
                break;
            
            case 2:
                // Dueño

                

                // Mostrar las solicitudes de promociones de los locales del cual es dueño
                $locales = Local::where('idUsuario',$idUsuario)->get();
                $ids_locales = $locales->pluck('id')->all();
                $promociones = Promocion::whereIn('idLocal', $ids_locales)->withCount('usosPromocion')->get();

                return view('usoPromociones', compact('promociones','locales'));
                echo "El usuario es del tipo 2.";
                break;
            
            case 3:
                // Cliente
                echo "El usuario es del tipo 3.";
                break;
            
            default:
                // Código a ejecutar si $idTipoUsuario no es 1, 2 o 3
                echo "Tipo de usuario no reconocido.";
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $usuario = auth()->user();
        try {
            $idCategoriaCliente = $usuario->idCategoriaCliente;
            $validated = $request->validate([
                'idPromocion' => [
                    'required',
                    'integer',                
                    function ($attribute, $value, $fail) use ($idCategoriaCliente) {
                        $promocion = Promocion::where('id', $value)
                                                ->where('estado', 'Aprobada')
                                                ->where('idCategoriaMinima', '<=', $idCategoriaCliente)
                                                ->first();

                        if (!$promocion) {
                            $fail('La promoción no existe, no está aprobada, o no cumples con el nivel de categoría mínimo.');
                        }
                    }
                ]
            ]);
            
            $idPromocion = $validated['idPromocion'];

            $usoPromocion = new UsoPromocion();
            $usoPromocion->idUsuario = $usuario->id;
            $usoPromocion->idPromocion = $idPromocion;
            $usoPromocion->fechaUso = Carbon::now()->toDateString();
            $usoPromocion->estado = 'Enviada';

            $usoPromocion->save();
            
            return redirect()->route('promociones')->with('success', 'Registro exitoso.');

        } catch (ValidationException $e) {
            // Errores de validación
            logger('Error de validación: ', $e->errors());
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
    public function show(UsoPromocion $usoPromocion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UsoPromocion $usoPromocion)
    {

        // Validación general de los campos que podrían actualizarse
        $validatedData = $request->validate([
            'estado' => 'nullable|string|in:Aceptada,Rechazada,Enviada',

        ]);

        // Actualiza solo los campos presentes en la request
        
        $usoPromocion->fill($validatedData);
        $usoPromocion->save();

        return redirect()->back()->with('success', 'Uso de promoción actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idUsoPromocion) {
        $usoPromocion = UsoPromocion::findOrFail($idUsoPromocion);
        $usoPromocion->delete();
        return redirect()->back()->with('success', 'Uso Promoción cancelada correctamente.');
    }

    public function getGestionUsoPromociones() {
        $usuario = auth()->user();
        $locales = Local::where('idUsuario', $usuario->id)->get();
        $localesIds = $locales->pluck('id');
        $promociones = Promocion::whereIn('idLocal', $localesIds)->get();
        $promocionesIds = $promociones->pluck('id');
        $usos_promociones = UsoPromocion::whereIn('idPromocion', $promocionesIds)->get();
        return view('dueno.gestionUsoPromociones', compact('locales', 'promociones', 'usos_promociones'));
    }

    public function reporte(Request $request)
    {
        $reporte = UsoPromocion::with([
                'usuario',
                'promocion.local'
            ])
            ->when($request->fecha_desde, fn($q) => $q->whereDate('fechaUso', '>=', $request->fecha_desde))
            ->when($request->fecha_hasta, fn($q) => $q->whereDate('fechaUso', '<=', $request->fecha_hasta))
            ->when($request->local_id, fn($q) => $q->whereHas('promocion.local', fn($q2) =>
                    $q2->where('id', $request->local_id)))
            ->when($request->estado, fn($q) => $q->where('estado', $request->estado))
            ->orderBy('fechaUso', 'desc')
            ->paginate(20);

        $locales = Local::orderBy('nombre')->get();

        return view('admin.reporte', compact('reporte', 'locales'));
    }

    
}
