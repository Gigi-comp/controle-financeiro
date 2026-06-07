<?php
declare(strict_types=1);

require_once 'seguranca/init.php';
require_once 'classes/Ativo.php';
require_once 'classes/Dividendo.php';

validarSessao();

$ativo    = new Ativo();
$dividendo = new Dividendo();

$investimentos = $ativo->calcularPrecoMedio();
$dividendos    = $dividendo->calcularDividendosPorAtivo();

$dadosGrafico = [];
foreach ($investimentos as $item) {
    $dadosGrafico[$item['ativo']] = [
        'investido'  => $item['total_valor'],
        'dividendos' => 0,
    ];
}
foreach ($dividendos as $item) {
    if (isset($dadosGrafico[$item['ativo']])) {
        $dadosGrafico[$item['ativo']]['dividendos'] = $item['total_dividendos'];
    }
}

$nonce = h($csp->getNonce());
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico — Gestão de Ativos</title>
    <script src="js/chart.umd.js" nonce="<?= $nonce ?>"></script>
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
                <li><a href="grafico.php" class="active">Gráfico</a></li>
                <li><a href="relatorio.php">Relatório</a></li>
                <li><a href="usuarios.php">Usuários</a></li>
            </ul>
            <span class="nav-logout"><a href="logout.php">Sair</a></span>
        </nav>
    </header>
    <main>
        <div class="page-header">
            <h1>Investimentos × Dividendos</h1>
            <p>Comparativo entre o total investido e os dividendos recebidos por ativo.</p>
        </div>
        <canvas id="graficoInvestimentosDividendos"></canvas>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> Gestão de Ativos. Todos os direitos reservados.</p>
    </footer>

    <script nonce="<?= $nonce ?>">
        const dados = <?php echo json_encode($dadosGrafico, JSON_HEX_TAG | JSON_HEX_AMP); ?>;

        const labels           = Object.keys(dados);
        const dadosInvestidos  = Object.values(dados).map(item => item.investido);
        const dadosDividendos  = Object.values(dados).map(item => item.dividendos);

        const ctx = document.getElementById('graficoInvestimentosDividendos').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Total Investido (R$)',
                        data: dadosInvestidos,
                        backgroundColor: 'rgba(34, 197, 94, 0.15)',
                        borderColor: 'rgba(34, 197, 94, 0.8)',
                        borderWidth: 1.5,
                        borderRadius: 4,
                    },
                    {
                        label: 'Dividendos Recebidos (R$)',
                        data: dadosDividendos,
                        backgroundColor: 'rgba(212, 168, 67, 0.15)',
                        borderColor: 'rgba(212, 168, 67, 0.8)',
                        borderWidth: 1.5,
                        borderRadius: 4,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#7a8f7a',
                            font: { family: 'Inter', size: 12 },
                            boxWidth: 12,
                            padding: 16,
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#556055', font: { family: 'Inter', size: 11 } },
                        grid: { color: '#1a221a' },
                    },
                    y: {
                        ticks: { color: '#556055', font: { family: 'Inter', size: 11 } },
                        grid: { color: '#1a221a' },
                    }
                }
            },
        });
    </script>
</body>
</html>