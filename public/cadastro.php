<?php
session_start();

// Se já estiver logado, manda pra dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
          crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Criar Conta</h2>

        <form action="processa_cadastro.php" method="POST">
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

            <button type="submit" name="create_usuario" class="btn btn-primary w-100">Cadastrar</button>

            <p class="text-center mt-3">Já tem conta? <a href="index.php">Fazer Login</a></p>
        </form>
    </div>

    <!-- Bootstrap JS Bundle via CDN (Popper incluído) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
            crossorigin="anonymous"></script>
</body>
</html>
