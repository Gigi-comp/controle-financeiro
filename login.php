<?php

declare(strict_types=1);
require_once 'seguranca/init.php';
require_once 'classes/Usuario.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf->verify($_POST['csrf_token'] ?? '');

    $usuario = new Usuario();
    $login   = $usuario->validarLogin($_POST['email'] ?? '', $_POST['senha'] ?? '');

    if ($login) {
        $session->regenerate();
        $session->set('usuario', $login);
        header('Location: index.php');
        exit;
    }

    $erro = 'Credenciais inválidas.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Gestão de Ativos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="auth-page">
        <?php if ($erro !== ''): ?>
            <div style="max-width:460px;width:100%;margin-bottom:1rem;">
                <p style="color:red"><?= h($erro) ?></p>
            </div>
        <?php endif; ?>
        <form method="POST">
            <?= $csrf->inputField() ?>
            <h1>Gestão de Ativos</h1>
            <p class="form-subtitle">Entre com sua conta para continuar</p>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
        <div class="auth-alt">
            <a href="registro.php">Criar conta</a>
        </div>
    </div>
    <footer>
        <p>&copy; <?= date('Y') ?> Gestão de Ativos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>