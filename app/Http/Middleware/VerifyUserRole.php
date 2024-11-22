<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class VerifyUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Cek apakah role user masih valid
        if ($user && !Role::find($user->role_id)) {
            Auth::logout(); // Logout pengguna
            return redirect('/')->withErrors(['Your role is no longer valid.']);
        }

        return $next($request);
    }
   
    
}
