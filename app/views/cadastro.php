<?php


if (isset($_SESSION['user_id'])) {
    header("Location: /dashboard");
    exit;
}

require APP_PATH . 'views/layout/header.php';
?>

<div class="container mt-5">
    <h2 class="text-center">Criar Conta</h2>

    <form action="/cadastro/processar" method="POST">

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>

        <p class="text-center mt-3">
            Já tem conta? <a href="/login">Fazer Loagin</a>
        </p>

    </form>
</div>

<?php require APP_PATH . 'views/layout/footer.php'; ?>
