<?php

declare(strict_types=1);
class Session
{
    private bool $started = false;
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function start(): void
    {
        if ($this->started || session_status() === PHP_SESSION_ACTIVE) {
            $this->started = true;
            return;
        }
        $isHttps = $this->isHttps();

        ini_set('session.cookie_httponly', '1');
        ini_set('session.cookie_secure',   $isHttps ? '1' : '0');
        ini_set('session.cookie_samesite', $this->config['samesite']);
        ini_set('session.use_strict_mode', '1');
        ini_set('session.gc_maxlifetime',  (string) $this->config['lifetime']);

        session_name($this->config['name']);
        session_start([
            'cookie_lifetime' => 0,
            'cookie_path'     => $this->config['cookie_path'],
        ]);

        if (!$this->has('__session_init')) {
            session_regenerate_id(true);
            $this->set('__session_init', true);
        }

        $this->started = true;
    }

    public function regenerate(): void
    {
        session_regenerate_id(true);
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function destroy(): void
    {
        session_unset();
        session_destroy();
        $this->started = false;
    }

    public function isHttps(): bool
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);
    }
}