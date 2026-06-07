<?php

declare(strict_types=1);

require_once 'seguranca/init.php';

validarSessao();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Gestão de Ativos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a class="nav-brand" href="index.php">Ativos</a>
            <ul class="menu">
                <li><a href="index.php" class="active">Início</a></li>
                <li><a href="compras.php">Compras</a></li>
                <li><a href="dividendos.php">Dividendos</a></li>
                <li><a href="grafico.php">Gráfico</a></li>
                <li><a href="relatorio.php">Relatório</a></li>
                <li><a href="usuarios.php">Usuários</a></li>
            </ul>
            <span class="nav-logout"><a href="logout.php">Sair</a></span>
        </nav>
    </header>
    <main>
        <section class="dashboard">
            <div class="page-header">
                <h1>Bem-vindo à Gestão de Ativos</h1>
                <p>Gerencie seus investimentos e acompanhe os dividendos recebidos.</p>
            </div>
            <div class="cards">
                <div class="card">
                    <h2>Total Investido</h2>
                    <p>R$ 00,00</p>
                </div>
                <div class="card">
                    <h2>Total de Dividendos</h2>
                    <p>R$ 00,00</p>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> Gestão de Ativos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>