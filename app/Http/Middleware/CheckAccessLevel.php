<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $accessLevel): Response
    {
        var_dump(auth()->user()->getAccessLevel());
        exit;
        if ($accessLevel >= 100 && auth()->user()->getAccessLevel >= 100 ) {
            abort(403);
        }
        if ($accessLevel >= 90 && auth()->user()->getAccessLevel >= 90 ) {
            abort(403);
        }
        if ($accessLevel >= 80 && auth()->user()->getAccessLevel >= 100 ) {
            abort(403);
        }
        if ($accessLevel >= 70 && auth()->user()->getAccessLevel >= 70 ) {
            abort(403);
        }
        if ($accessLevel >= 60 && auth()->user()->getAccessLevel >= 60 ) {
            abort(403);
        }
        if ($accessLevel >= 40 && auth()->user()->getAccessLevel >= 40 ) {
            abort(403);
        }
        if ($accessLevel >= 30 && auth()->user()->getAccessLevel >= 30 ) {
            abort(403);
        }
        if ($accessLevel >= 20 && auth()->user()->getAccessLevel >= 20 ) {
            abort(403);
        }
        if ($accessLevel >= 10 && auth()->user()->getAccessLevel >= 10 ) {
            abort(403);
        }
        return $next($request);
    }
}
