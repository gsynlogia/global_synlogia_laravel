<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Musisz być zalogowany aby uzyskać dostęp do tej sekcji.');
        }

        $user = auth()->user();

        // Check if user is blocked
        if ($user->isBlocked()) {
            auth()->logout();
            return redirect('/login')->with('error', 'Twoje konto zostało zablokowane. Skontaktuj się z administratorem.');
        }

        // Check if user has the required permission
        if (!$user->hasPermission($permission)) {
            return redirect('/dashboard')->with('error', 'Nie masz uprawnień do tej sekcji.');
        }

        return $next($request);
    }
}