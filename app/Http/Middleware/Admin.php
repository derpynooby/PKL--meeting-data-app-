<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     * This middleware checks if the authenticated user has the required status.
     * If the user has the correct status, the request continues to the next middleware/controller.
     * Otherwise, the user is redirected to the dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $status  The required status to access the route
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $status): Response
    {
        if (Auth::user()->status === $status) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
