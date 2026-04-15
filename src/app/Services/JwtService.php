<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use RuntimeException;

class JwtService
{
    private string $secret;

    private int $ttl;

    private string $algo = 'HS256';

    public function __construct()
    {
        $secret = (string) env('JWT_SECRET', config('app.key', ''));

        if (str_starts_with($secret, 'base64:')) {
            $decoded = base64_decode(substr($secret, 7), true);
            $secret = $decoded !== false ? $decoded : '';
        }

        if ($secret === '') {
            throw new RuntimeException('JWT secret nao configurado.');
        }

        $this->secret = $secret;
        $this->ttl = max(1, (int) env('JWT_TTL', 3600));
    }

    public function issue(User $user): array
    {
        $now = time();

        $payload = [
            'iss' => config('app.url'),
            'sub' => $user->getKey(),
            'iat' => $now,
            'nbf' => $now,
            'exp' => $now + $this->ttl,
            'jti' => (string) Str::uuid(),
        ];

        return [
            'access_token' => $this->encode($payload),
            'token_type' => 'Bearer',
            'expires_in' => $this->ttl,
        ];
    }

    public function encode(array $payload): string
    {
        $header = [
            'typ' => 'JWT',
            'alg' => $this->algo,
        ];

        $headerEncoded = $this->base64UrlEncode(json_encode($header, JSON_THROW_ON_ERROR));
        $payloadEncoded = $this->base64UrlEncode(json_encode($payload, JSON_THROW_ON_ERROR));
        $signature = hash_hmac('sha256', $headerEncoded.'.'.$payloadEncoded, $this->secret, true);
        $signatureEncoded = $this->base64UrlEncode($signature);

        return $headerEncoded.'.'.$payloadEncoded.'.'.$signatureEncoded;
    }

    public function decode(string $token): array
    {
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            throw new RuntimeException('Token mal formado.');
        }

        [$headerEncoded, $payloadEncoded, $signatureEncoded] = $parts;

        $header = json_decode($this->base64UrlDecode($headerEncoded), true);
        $payload = json_decode($this->base64UrlDecode($payloadEncoded), true);
        $providedSignature = $this->base64UrlDecode($signatureEncoded);

        if (! is_array($header) || ! is_array($payload)) {
            throw new RuntimeException('Token invalido.');
        }

        if (($header['alg'] ?? null) !== $this->algo) {
            throw new RuntimeException('Algoritmo do token invalido.');
        }

        $expectedSignature = hash_hmac('sha256', $headerEncoded.'.'.$payloadEncoded, $this->secret, true);

        if (! hash_equals($expectedSignature, $providedSignature)) {
            throw new RuntimeException('Assinatura invalida.');
        }

        $now = time();

        if (($payload['nbf'] ?? 0) > $now) {
            throw new RuntimeException('Token ainda nao esta valido.');
        }

        if (($payload['exp'] ?? 0) <= $now) {
            throw new RuntimeException('Token expirado.');
        }

        if ($this->isBlacklisted($payload)) {
            throw new RuntimeException('Token revogado.');
        }

        return $payload;
    }

    public function blacklist(array $payload): void
    {
        if (! isset($payload['jti'])) {
            return;
        }

        $ttl = max(1, ((int) ($payload['exp'] ?? (time() + 60))) - time());

        Cache::put($this->blacklistKey((string) $payload['jti']), true, $ttl);
    }

    private function isBlacklisted(array $payload): bool
    {
        if (! isset($payload['jti'])) {
            return false;
        }

        return Cache::has($this->blacklistKey((string) $payload['jti']));
    }

    private function blacklistKey(string $jti): string
    {
        return 'jwt:blacklist:'.$jti;
    }

    private function base64UrlEncode(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $value): string
    {
        $padding = strlen($value) % 4;

        if ($padding > 0) {
            $value .= str_repeat('=', 4 - $padding);
        }

        $decoded = base64_decode(strtr($value, '-_', '+/'), true);

        if ($decoded === false) {
            throw new RuntimeException('Token invalido.');
        }

        return $decoded;
    }
}