<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisableOctane
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('telescope*')) {
            // Ensure the request bypasses Octane and uses the regular HTTP kernel
            app()->instance(\Illuminate\Contracts\Http\Kernel::class, app(\App\Http\Kernel::class));
        }
        return $next($request);
    }
}
