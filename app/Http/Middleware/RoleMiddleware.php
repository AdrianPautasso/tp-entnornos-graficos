<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }
        // Assuming Usuario model has idTipo field
        if (! in_array($user->idTipo, $roles)) {
            abort(403, 'Acceso denegado');
        }
        return $next($request);
    }
}