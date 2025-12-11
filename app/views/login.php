<?php


if (isset($_SESSION['user_id'])) {
    header("Location: /dashboard");
    exit;
}

$mensagem = '';

if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') {
    $mensagem = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Cadastro realizado com sucesso! Faça login.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>';
} 
elseif (isset($_GET['erro'])) {
    $mensagem = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Erro: ' . htmlspecialchars($_GET['erro']) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>';
}

require APP_PATH . 'views/layout/header.php';
?>

<div class="container mt-5">
    <h2 class="text-center">Login</h2>

    <?= $mensagem ?>

    <form action="/login/processar" method="POST">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100" type="submit">Entrar</button>

        <p class="text-center mt-3">
            Ainda não tem conta? <a href="/cadastro">Cadastrar</a>
        </p>
    </form>
</div>

<?php require APP_PATH . 'views/layout/footer.php'; ?>
