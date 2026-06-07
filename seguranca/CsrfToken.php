<?php

declare(strict_types=1);

class CsrfToken
{
    private const SESSION_KEY = '_csrf_token';

    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getToken(): string
    {
        if (!$this->session->has(self::SESSION_KEY)) {
            $this->session->set(
                self::SESSION_KEY,
                bin2hex(random_bytes(32))
            );
        }

        return $this->session->get(self::SESSION_KEY);
    }

    /**
     * @throws \RuntimeException
     */
    public function verify(string $tokenPost): void
    {
        $tokenSession = $this->session->get(self::SESSION_KEY, '');

        // hash_equals() é timing-safe
        if (empty($tokenPost) || !hash_equals($tokenSession, $tokenPost)) {
            http_response_code(403);

            throw new \RuntimeException(
                'CSRF token inválido. Requisição bloqueada.'
            );
        }
    }

    public function inputField(): string
    {
        $token = htmlspecialchars(
            $this->getToken(),
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }
}