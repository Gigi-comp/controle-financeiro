<?php

declare(strict_types=1);

require_once 'seguranca/init.php';
require_once 'classes/Dividendo.php';

validarSessao();

$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf->verify($_POST['csrf_token'] ?? '');

    $dividendo = new Dividendo();
    $dividendo->adicionarDividendo(
        $_POST['ativo']            ?? '',
        $_POST['valor']            ?? '',
        $_POST['data_recebimento'] ?? ''
    );

    $sucesso = 'Dividendo registrado com sucesso!';
}
$paginaAtiva = 'dividendos';
require_once 'partials/header.php';
?>

    <main>
        <div class="page-header">
            <h1>Cadastrar Dividendos</h1>
            <p>Registre um novo dividendo recebido.</p>
        </div>
        <?php if ($sucesso !== ''): ?>
            <p style="color:green"><?= h($sucesso) ?></p>
        <?php endif; ?>
        <form method="POST">
            <?= $csrf->inputField() ?>
            <label for="ativo">Ativo</label>
            <input type="text" id="ativo" name="ativo" required>
            <label for="valor">Valor Recebido</label>
            <input type="number" step="0.01" id="valor" name="valor" required>
            <label for="data_recebimento">Data de Recebimento</label>
            <input type="date" id="data_recebimento" name="data_recebimento" required>
            <button type="submit">Cadastrar</button>
        </form>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> Gestão de Ativos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>