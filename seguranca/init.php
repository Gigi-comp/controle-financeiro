<?php

declare(strict_types=1);

require_once __DIR__ . '/ContentSecurityPolicy.php';
require_once __DIR__ . '/CsrfToken.php';
require_once __DIR__ . '/Session.php';
require_once __DIR__ . '/../functions.php';

$csp = new ContentSecurityPolicy();
$csp->sendHeaders();

$session = new Session([
    'name'        => 'CONTROLE_SESSION',
    'lifetime'    => 1800,
    'cookie_path' => '/',
    'samesite'    => 'Strict',
]);

$session->start();

$csrf = new CsrfToken($session);
$paginasPublicas = ['login.php', 'registro.php', 'logout.php'];
$paginaAtual = basename($_SERVER['PHP_SELF']);

if (!in_array($paginaAtual, $paginasPublicas, strict: true)) {
    validarSessao();
}