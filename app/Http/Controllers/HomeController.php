<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Novedad;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        //Usuario no logueado
        if (!Auth::check()) {
            // Usuario no logueado: promociones y novedades generales
            $promociones = Promocion::getVigentesYAprobadas();
            $novedades = Novedad::getVigentes();
            $auth = true;
            return view('welcome', compact('promociones', 'novedades', 'auth'));
        }

        //Usuario logueado

        $user = Auth::user();

        switch ($user->idTipo) {
            case 1: // Administrador
                return view('admin.index');
            case 2: // Dueño de local
                // Mostrar promociones del local(s) del dueño
                $locales = $user->locales;
                // Luego las promociones de esos locales, solo aprobadas y vigentes
                $promociones = Promocion::getVigentesYAprobadasPorLocal($locales);
                return view('dueno.index', compact('promociones', 'locales'));
            case 3: // Cliente
                // Mostrar promociones vigentes para la categoría del cliente
                $idCategoria = $user->idCategoriaCliente;
                $promociones = Promocion::getVigentesYAprobadasPorCategoria($idCategoria);
                $novedades = Novedad::getVigentesPorCategoria($idCategoria);
                return view('cliente.index', compact('promociones', 'novedades'));
            default:
                // Usuario con rol no esperado, o usuarios no registrados
                $promociones = Promocion::vigentesAprobadas();
                $novedades = Novedad::vigentes();
                return view('welcome', compact('promociones', 'novedades'));
        }
    }
}
