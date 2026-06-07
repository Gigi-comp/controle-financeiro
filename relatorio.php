<?php

declare(strict_types=1);

require_once 'seguranca/init.php';
require_once 'classes/Ativo.php';

validarSessao();

$ativo     = new Ativo();
$relatorio = $ativo->calcularPrecoMedio();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Ativos — Gestão de Ativos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a class="nav-brand" href="index.php">Ativos</a>
            <ul class="menu">
                <li><a href="index.php">Início</a></li>
                <li><a href="compras.php">Compras</a></li>
                <li><a href="dividendos.php">Dividendos</a></li>
                <li><a href="grafico.php">Gráfico</a></li>
                <li><a href="relatorio.php" class="active">Relatório</a></li>
                <li><a href="usuarios.php">Usuários</a></li>
            </ul>
            <span class="nav-logout"><a href="logout.php">Sair</a></span>
        </nav>
    </header>
    <main>
        <div class="page-header">
            <h1>Relatório de Ativos</h1>
            <p>Resumo de preço médio e quantidade total por ativo.</p>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Ativo</th>
                        <th>Total Comprado</th>
                        <th>Preço Médio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($relatorio as $linha): ?>
                        <tr>
                            <td><?= h($linha['ativo']) ?></td>
                            <td><?= h((string) $linha['total_quantidade']) ?></td>
                            <td>R$ <?= number_format((float) $linha['preco_medio'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> Gestão de Ativos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>