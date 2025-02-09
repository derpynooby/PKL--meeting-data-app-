<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Operator
{
    /**
     * Handle an incoming request.
     * This middleware checks if the authenticated user has any of the required statuses.
     * If the user has one of the correct statuses, the request continues to the next middleware/controller.
     * Otherwise, the user is redirected to the dashboard.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$status  The required statuses to access the route
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$status): Response
    {
        if (in_array(Auth::user()->status, $status)) {
            return $next($request);
        }

        return redirect('/dashboard');
    }

}
