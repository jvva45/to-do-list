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

<div class="container mt-5 d-flex justify-content-center">
    <div class="card card-custom p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center text-light mb-4">Acessar Sistema</h2>

        <?= $mensagem ?>

        <form action="/login/processar" method="POST">
            <div class="mb-3">
                <label class="form-label text-light">Email</label>
                <input type="email" name="email" class="form-control form-control-custom" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-light">Senha</label>
                <input type="password" name="senha" class="form-control form-control-custom" required>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>

            <p class="text-center mt-4">
                Ainda não tem conta? <a href="/cadastro" class="text-secondary-custom">Cadastrar</a>
            </p>
        </form>
    </div>
</div>

<?php require APP_PATH . 'views/layout/footer.php'; ?>