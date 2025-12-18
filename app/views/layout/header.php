<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$logado = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">

</head>

<body class="d-flex flex-column min-vh-100">

  <?php if ($logado): ?>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
      <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
          <a class="navbar-brand mx-auto" href="/dashboard">

          </a>

          <a class="navbar-brand mx-auto" href="/dashboard">
            To-do-List
          </a>


          <div class="d-flex align-items-center ms-auto">

            <span class="navbar-text me-3 text-nowrap">
              <?= htmlspecialchars($_SESSION['user_nome'] ?? '') ?>
            </span>

            <a href="/logout" class="btn btn-outline-light btn-sm btn-outline-custom">Sair</a>
          </div>

        </div>
      </div>
    </nav>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>