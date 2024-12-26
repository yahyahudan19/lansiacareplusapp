<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();

        // Jika role tidak sesuai, redirect ke dashboard sesuai role
        if (!in_array($user->role, $role)) {
            switch ($user->role) {
                case 'Puskesmas':
                    return redirect('/puskesmas/dashboard');
                case 'Dinkes':
                    return redirect('/dinkes/dashboard');
                case 'System Administrator':
                    return redirect('/dashboard');
                case 'Kader':
                    return redirect('/kader/dashboard');
                default:
                    return redirect('/login');
            }
        }

        return $next($request);
    }

}
