<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Local;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = Usuario::with('tipoUsuario','categoria')->get();
        $locales_libres = Local::whereNull('idUsuario')->get();
        return view('admin.usuarios', compact('usuarios','locales_libres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function aprobarDueno(Request $request, $id)
    {
        $request->validate([
            'idLocal' => 'required|exists:locales,id',
        ]);
        
        $usuario = Usuario::findOrFail($id);

        if ($usuario->idTipo != 2) {
            return redirect()->back()->with('error', 'El usuario no es un dueño de local.');
        }

        $usuario->aprobado = true;
        $usuario->save();

        $local = Local::findOrFail($request->idLocal);
        $local->idUsuario = $usuario->id;
        $local->save();

        return redirect()->back()->with('success', 'Usuario aprobado correctamente y local vinculado.');
    }

    public function rechazarDueno($id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->idTipo != 2) {
            return redirect()->back()->with('error', 'Usuario no aprobado.');
        }
        $usuario->aprobado = false;
        $usuario->save();

        // Desvincular el local asociado
        $local = Local::where('idUsuario', $usuario->id)->first();

        if ($local) {
            $local->idUsuario = null;
            $local->save();
        }

        return redirect()->back()->with('success', 'Usuario rechazado y local desvinculado.');
    }
}
