<?php

declare(strict_types=1);

function h(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
function validarSessao(): void
{
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }
}