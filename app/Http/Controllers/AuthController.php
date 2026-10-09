<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\TipoUsuario;
use App\Models\CategoriaCliente;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

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
            
            if ($user->idTipo == 2 && ! $user->aprobado) {
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

// Tipos de usuario habilitados para el registro público: solo Cliente y Dueño.
    // Nunca Administrador. Se resuelve por descripción para no depender del id.
    private function tiposRegistrables()
    {
        return TipoUsuario::all()
            ->filter(fn ($tipo) => in_array(strtolower($tipo->descripcion), ['cliente', 'dueño']))
            ->values();
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $tipos = $this->tiposRegistrables();
        $idDueño = $tipos->first(fn ($tipo) => strtolower($tipo->descripcion) === 'dueño')?->id;
        $locales = Local::whereNull('idUsuario')->get();
        return view('auth.register', compact('tipos', 'locales', 'idDueño'));
    }

    // Procesar registro
    public function register(Request $request) {
        
        try {

            $tiposPermitidos = $this->tiposRegistrables()->pluck('id')->all();
            $validated = $request->validate([
                'nombre' => 'required|string|max:100',
                'email' => 'required|email|unique:usuarios,email',
                'usuario' => 'required|string|max:100|unique:usuarios,usuario',
                'password' => 'required|min:6|confirmed',
                'idTipo' => ['required', Rule::in($tiposPermitidos)],
                'idLocal' => 'nullable|integer|exists:locales,id',
            ]);

            $tipo = TipoUsuario::find($validated['idTipo']);
            $esDueño = strtolower($tipo->descripcion) === 'dueño';

            $usuario = new Usuario();
            $usuario->nombre = $validated['nombre'];
            $usuario->email = $validated['email'];
            $usuario->usuario = $validated['usuario'];
            $usuario->password = Hash::make($validated['password']);
            $usuario->idTipo = $validated['idTipo'];
            // El dueño se registra en estado Pendiente: un administrador debe aprobarlo
            // antes de que pueda iniciar sesión. El cliente queda Aprobado.
            $usuario->aprobado = ! $esDueño;
            // El cliente arranca en la categoría de menor nivel: es la única que le
            // garantiza promociones sin que pueda autoasignarse un nivel mayor.
            // Se resuelve por nivel y no por id para no depender de los datos cargados.
            $usuario->idCategoriaCliente = $esDueño
                ? null
                : CategoriaCliente::orderBy('nivel')->value('id');
            
            $usuario->save();

            $idLocal = $request->idLocal;
            if($esDueño && $idLocal != null) {
                $local = Local::find($idLocal);
                if ($local && $local->idUsuario === null) {
                    $local->idUsuario = $usuario->id;
                    $local->save();
                }
                   
            }

            if ($esDueño) {
                return redirect()->route('login')->with('success',
                    'Registro exitoso. Tu cuenta de dueño quedó en estado Pendiente: un administrador debe aprobarla antes de que puedas iniciar sesión.');
            }

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
