<?php

declare(strict_types=1);

require_once 'seguranca/init.php';
require_once 'classes/Compra.php';

validarSessao();

$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $csrf->verify($_POST['csrf_token'] ?? '');

        $compra = new Compra();
        $compra->adicionarCompra(
            $_POST['ativo']          ?? '',
            $_POST['quantidade']     ?? '',
            $_POST['valor_unitario'] ?? '',
            $_POST['data_compra']    ?? ''
        );

        $sucesso = 'Compra adicionada com sucesso!';

    } catch (\RuntimeException $e) {
        http_response_code(403);
        die('403 Forbidden — ' . $e->getMessage());
    }
}
$paginaAtiva = 'compras';
require_once 'partials/header.php';
?>

    <main>
        <div class="page-header">
            <h1>Cadastrar Compra</h1>
            <p>Registre uma nova compra de ativo na sua carteira.</p>
        </div>
        <?php if ($sucesso !== ''): ?>
            <p style="color:green"><?= h($sucesso) ?></p>
        <?php endif; ?>
        <form method="POST">
            <?= $csrf->inputField() ?>
            <label for="ativo">Ativo</label>
            <input type="text" id="ativo" name="ativo" required>
            <label for="quantidade">Quantidade</label>
            <input type="number" id="quantidade" name="quantidade" required>
            <label for="valor_unitario">Valor Unitário</label>
            <input type="number" step="0.01" id="valor_unitario" name="valor_unitario" required>
            <label for="data_compra">Data da Compra</label>
            <input type="date" id="data_compra" name="data_compra" required>
            <button type="submit">Cadastrar</button>
        </form>
    </main>

</body>
</html>