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

        // Solo los dueños (idTipo 2) acceden a esta vista: el middleware
        // 'role:2' ya redirige a los invitados al login y bloquea al resto.
        // El listado se limita a los locales que el usuario posee.
        $locales = Local::where('idUsuario', $usuario->id)->get();
        $ids_locales = $locales->pluck('id')->all();
        $promociones = Promocion::whereIn('idLocal', $ids_locales)->withCount('usosPromocion')->get();

        return view('usoPromociones', compact('promociones','locales'));
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
        $this->autorizarSobreUso($usoPromocion);

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
        $this->autorizarSobreUso($usoPromocion);

        $usoPromocion->delete();
        return redirect()->back()->with('success', 'Uso Promoción cancelada correctamente.');
    }

    /**
     * Verifica que el usuario tenga autoridad sobre el uso de promoción: un
     * dueño solo puede operar sobre usos de promociones de sus propios
     * locales y un cliente solo sobre los usos que él mismo realizó.
     */
    private function autorizarSobreUso(UsoPromocion $usoPromocion): void
    {
        $usuario = auth()->user();

        $autorizado = $usuario->idTipo == 2
            ? Promocion::whereIn('idLocal', Local::where('idUsuario', $usuario->id)->select('id'))
                ->whereKey($usoPromocion->idPromocion)
                ->exists()
            : $usoPromocion->idUsuario === $usuario->id;

        if (!$autorizado) { abort(403, 'Acceso denegado'); }
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
