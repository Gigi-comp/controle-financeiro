<?php

declare(strict_types=1);

require_once 'seguranca/init.php';
require_once 'classes/Usuario.php';

validarSessao();

$usuario = new Usuario();

if (isset($_GET['id'])) {
    $usuarioSelecionado = $usuario->buscarUsuario($_GET['id']);
    if (!$usuarioSelecionado) {
        die(h('Usuário não encontrado.'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf->verify($_POST['csrf_token'] ?? '');

    $usuario->atualizarUsuario(
        $_POST['id']    ?? '',
        $_POST['nome']  ?? '',
        $_POST['email'] ?? ''
    );

    header('Location: usuarios.php');
    exit;
}
$paginaAtiva = 'editar_usuario';
require_once 'partials/header.php';
?>

    <main>
        <div class="page-header">
            <h1>Editar Usuário</h1>
            <p>Altere os dados do usuário selecionado.</p>
        </div>
        <form method="POST">
            <?= $csrf->inputField() ?>
            <input type="hidden" name="id" value="<?= h((string) $usuarioSelecionado['id']) ?>">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= h($usuarioSelecionado['nome']) ?>" required>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="<?= h($usuarioSelecionado['email']) ?>" required>
            <button type="submit">Salvar Alterações</button>
        </form>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> Gestão de Ativos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>