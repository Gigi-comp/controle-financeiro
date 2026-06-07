<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($tituloPagina ?? 'Gestão de Ativos') ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a class="nav-brand" href="index.php">Ativos</a>
            <ul class="menu">
                <li><a href="index.php" <?= ($paginaAtiva ?? '') === 'inicio' ? 'class="active"' : '' ?>>Início</a></li>
                <li><a href="compras.php" <?= ($paginaAtiva ?? '') === 'compras' ? 'class="active"' : '' ?>>Compras</a></li>
                <li><a href="dividendos.php" <?= ($paginaAtiva ?? '') === 'dividendos' ? 'class="active"' : '' ?>>Dividendos</a></li>
                <li><a href="grafico.php" <?= ($paginaAtiva ?? '') === 'grafico' ? 'class="active"' : '' ?>>Gráfico</a></li>
                <li><a href="relatorio.php" <?= ($paginaAtiva ?? '') === 'relatorio' ? 'class="active"' : '' ?>>Relatório</a></li>
                <li><a href="usuarios.php" <?= ($paginaAtiva ?? '') === 'usuarios' ? 'class="active"' : '' ?>>Usuários</a></li>
            </ul>
            <span class="nav-logout"><a href="logout.php">Sair</a></span>
        </nav>
    </header>
    <main>