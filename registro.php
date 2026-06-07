<?php

declare(strict_types=1);

require_once 'seguranca/init.php';
require_once 'classes/Usuario.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf->verify($_POST['csrf_token'] ?? '');

    $senha = $_POST['senha'] ?? '';

    if (strlen($senha) < 8) {
        $erro = 'A senha deve ter pelo menos 8 caracteres.';
    } else {
        $usuario = new Usuario();
        $usuario->criarUsuario(
            $_POST['nome']  ?? '',
            $_POST['email'] ?? '',
            $senha
        );
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta — Gestão de Ativos</title>
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
            <h1>Criar Conta</h1>
            <p class="form-subtitle">Preencha os dados para se registrar</p>
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Registrar</button>
        </form>
        <div class="auth-alt">
            <a href="login.php">Já tenho uma conta</a>
        </div>
    </div>
    <footer>
        <p>&copy; <?= date('Y') ?> Gestão de Ativos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>