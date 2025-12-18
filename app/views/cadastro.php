<?php


if (isset($_SESSION['user_id'])) {
    header("Location: /dashboard");
    exit;
}

require APP_PATH . 'views/layout/header.php';
?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="card card-custom p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center text-light mb-4">Criar Conta</h2>

        <form action="/cadastro/processar" method="POST">

            <div class="mb-3">
                <label class="form-label text-light">Nome</label>
                <input type="text" name="nome" class="form-control form-control-custom" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Email</label>
                <input type="email" name="email" class="form-control form-control-custom" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-light">Senha</label>
                <input type="password" name="senha" class="form-control form-control-custom" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Cadastrar</button>

            <p class="text-center mt-4">
                Já tem conta? <a href="/login" class="text-secondary-custom">Fazer Login</a>
            </p>

        </form>
    </div>
</div>

<?php require APP_PATH . 'views/layout/footer.php'; ?>