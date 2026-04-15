<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class JwtAuthenticate
{
    public function __construct(private readonly JwtService $jwt)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $token = $this->extractToken($request);

        if (! $token) {
            return response()->json([
                'message' => 'Token de autenticacao nao fornecido.',
            ], 401);
        }

        try {
            $payload = $this->jwt->decode($token);
        } catch (Throwable $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);
        }

        $user = User::find($payload['sub'] ?? null);

        if (! $user) {
            return response()->json([
                'message' => 'Usuario do token nao encontrado.',
            ], 401);
        }

        $request->setUserResolver(fn () => $user);
        $request->attributes->set('jwt_payload', $payload);
        $request->attributes->set('jwt_token', $token);

        return $next($request);
    }

    private function extractToken(Request $request): ?string
    {
        $header = $request->header('Authorization');

        if (! is_string($header) || ! str_starts_with($header, 'Bearer ')) {
            return null;
        }

        $token = trim(substr($header, 7));

        return $token !== '' ? $token : null;
    }
}