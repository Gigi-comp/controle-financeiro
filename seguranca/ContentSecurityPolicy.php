<?php

declare(strict_types=1);

class ContentSecurityPolicy
{
    private string $nonce;

    public function __construct()
    {
        $this->nonce = base64_encode(random_bytes(16));
    }

    public function sendHeaders(): void
    {
        header('Content-Security-Policy: ' . $this->buildPolicy());
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    }

    public function getNonce(): string
    {
        return $this->nonce;
    }

    private function buildPolicy(): string
    {
        $n = $this->nonce;
        $directives = [
            "default-src 'self'",
            "script-src 'self' 'nonce-{$n}'",
            "style-src 'self'",     
            "img-src 'self' data:",
            "connect-src 'self'",
            "font-src 'self'",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "frame-ancestors 'none'",
            "upgrade-insecure-requests",
        ];

        return implode('; ', $directives);
    }
}