<?php

declare(strict_types=1);

require_once 'seguranca/init.php';

require_once 'classes/Usuario.php';
validarSessao();
$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf->verify($_POST['csrf_token'] ?? '');

    if (isset($_POST['excluir'])) {
        $usuario->excluirUsuario($_POST['id'] ?? '');
    }
}

$usuarios = $usuario->listarUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários — Gestão de Ativos</title>
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
                <li><a href="relatorio.php">Relatório</a></li>
                <li><a href="usuarios.php" class="active">Usuários</a></li>
            </ul>
            <span class="nav-logout"><a href="logout.php">Sair</a></span>
        </nav>
    </header>
    <main>
        <div class="page-header">
            <h1>Gerenciar Usuários</h1>
            <p>Visualize, edite e remova usuários do sistema.</p>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= h((string) $u['id']) ?></td>
                            <td><?= h($u['nome']) ?></td>
                            <td><?= h($u['email']) ?></td>
                            <td>
                                <!-- Exclusão: POST + CSRF -->
                                <form method="POST" style="display:inline;">
                                    <?= $csrf->inputField() ?>
                                    <input type="hidden" name="id" value="<?= h((string) $u['id']) ?>">
                                    <button type="submit" name="excluir">Excluir</button>
                                </form>
                                <!-- Edição: GET simples -->
                                <form method="GET" action="editar_usuario.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= h((string) $u['id']) ?>">
                                    <button type="submit">Editar</button>
                                </form>
                            </td>
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