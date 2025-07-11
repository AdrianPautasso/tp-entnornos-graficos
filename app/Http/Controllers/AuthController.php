<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
    
        $credentials = $request->validate([
            'usuario' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->idTipo == "Dueño" && ! $user->aprobado) {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'usuario' => 'Tu cuenta aún no fue aprobada por un administrador.',
                ]);
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'usuario' => 'Credenciales incorrectas.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $tipos = TipoUsuario::all();
        return view('auth.register', compact('tipos'));
    }

    // Procesar registro
    public function register(Request $request)
    {
        
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:100',
                'email' => 'required|email|unique:usuarios,email',
                'usuario' => 'required|string|max:100|unique:usuarios,usuario',
                'password' => 'required|min:6|confirmed',
                'idTipo' => 'required|exists:tipos_usuarios,id',
            ]);

            $usuario = new Usuario();
            $usuario->nombre = $validated['nombre'];
            $usuario->email = $validated['email'];
            $usuario->usuario = $validated['usuario'];
            $usuario->password = Hash::make($validated['password']);
            $usuario->idTipo = $validated['idTipo'];

            $usuario->save();

            return redirect()->route('login')->with('success', 'Registro exitoso.');
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
}
