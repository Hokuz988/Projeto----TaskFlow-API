<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureJsonRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        $writeMethods = ['POST', 'PUT', 'PATCH'];

        if (in_array($request->method(), $writeMethods, true)
            && ! $request->isJson()
            && ! $request->expectsJson()) {
            return response()->json([
                'message' => 'Esta API aceita apenas requisicoes JSON.',
            ], 406);
        }

        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}