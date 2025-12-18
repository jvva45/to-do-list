<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

require APP_PATH . 'views/layout/header.php';

$nomeUsuario = $_SESSION['user_nome'] ?? 'Usuário';
?>



<div class="container mt-5">


    <form method="GET" action="/tarefa/listar" class="mb-3">
        <input
            type="text"
            name="busca"
            class="form-control campo-busca"
            placeholder="Pesquisar tarefas..."
            value="<?= $_GET['busca'] ?? '' ?>">
    </form>



    <div class="d-flex gap-2 mb-4">

        <button class="botao-filtro active" data-filtro="pendente">Pendentes</button>
        <button class="botao-filtro" data-filtro="concluida">Concluídas</button>
        <button class="botao-filtro" data-filtro="">Todas</button>
    </div>

    <div id="lista-tarefas">
        <?php require APP_PATH . 'views/componentes/listar_tarefas.php'; ?>
    </div>


    <div class="d-flex justify-content-end mb-3">
        <a href="tarefa/nova" class="btn btn-primary px-4 py-2">
            ➕ Nova Tarefa
        </a>
    </div>



</div>

<?php require APP_PATH . 'views/layout/footer.php'; ?>