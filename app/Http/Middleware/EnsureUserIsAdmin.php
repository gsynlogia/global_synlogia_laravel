<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Musisz być zalogowany aby uzyskać dostęp do panelu administracyjnego.');
        }

        // Check if user is admin (superuser or has admin role)
        if (!auth()->user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Nie masz uprawnień do panelu administracyjnego.');
        }

        return $next($request);
    }
}