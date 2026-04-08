<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class WallValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    // protected function handle(Request $request)
    {
        // return $next($request);
        if (!env('APP_AUTHOR') == 'jonathancastro') {

            return response()->json([
                'status' => 401,
                'message' => 'Acceso no autorizado',
            ], 401);

        }

       

        return $next($request);
    }
}
