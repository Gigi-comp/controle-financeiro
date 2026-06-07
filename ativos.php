<?php
declare(strict_types=1);

require_once 'seguranca/init.php';
require_once 'classes/Ativo.php';
validarSessao();
 
$ativo = new Ativo();
$relatorio = $ativo->calcularPrecoMedio();
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Ativos</title>
    <!-- nonce adicionado para que o CSP não bloqueie o stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Relatório de Ativos</h1>
    <table border="1">
        <tr>
            <th>Ativo</th>
            <th>Total Comprado</th>
            <th>Preço Médio</th>
        </tr>
        <?php foreach ($relatorio as $linha): ?>
            <tr>
                <td><?= h($linha['ativo']) ?></td>
                <td><?= h((string) $linha['total_quantidade']) ?></td>
                <td><?= number_format((float) $linha['preco_medio'], 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>