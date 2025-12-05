<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Legacy middleware - Use SupplyOfficerMiddleware instead
 * @deprecated Use SupplyOfficerMiddleware
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isSupplyOfficer()) {
            abort(403, 'Unauthorized access. Supply Officer privileges required.');
        }

        return $next($request);
    }
}
