<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class DetailedErrorLogging
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $response = $next($request);

            // Log successful admin requests for debugging
            if ($request->is('admin*')) {
                Log::channel('admin')->info('Admin Request Success', [
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'user_id' => auth()->id(),
                    'user_email' => auth()->user()?->email,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'timestamp' => now(),
                ]);
            }

            return $response;

        } catch (Throwable $e) {
            // Detailed error logging
            Log::channel('admin')->error('Admin Request Error', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'error_trace' => $e->getTraceAsString(),
                'request_url' => $request->fullUrl(),
                'request_method' => $request->method(),
                'request_data' => $request->all(),
                'user_id' => auth()->id(),
                'user_email' => auth()->user()?->email,
                'user_roles' => auth()->user()?->roles->pluck('name'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id' => $request->session()->getId(),
                'timestamp' => now(),
                'stack_trace' => $e->getTrace(),
            ]);

            // Re-throw the exception to maintain normal error handling
            throw $e;
        }
    }
}