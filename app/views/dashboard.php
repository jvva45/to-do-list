<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

require APP_PATH . 'views/layout/header.php';

$nomeUsuario = $_SESSION['user_nome'] ?? 'Usuário';
?>

<style>
    body {
        background:   #0D1117;
        color: #fff;
    }

    .cartao-tarefa {
        background: #1c1f23;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 15px;
        color: white;
    }


    .campo-busca {
        background: #1c1f23;
        border: none;
        border-radius: 12px;
        padding: 12px 16px;
        color: #fff;
    }

    .campo-busca::placeholder {
        text-align: center;
        color: #aaa;
    }


    .botao-filtro {
        border: none;
        padding: 6px 14px;
        background: #1c1f23;
        border-radius: 20px;
        color: #fff;
        cursor: pointer;
        transition: 0.2s;
    }

    .botao-filtro.active,
    .botao-filtro:hover {
        background: #0d6efd;
    }

    .texto-secundario {
        font-size: 13px;
        color: #b8b8b8;
    }

    .status {
        padding: 2px 8px;
        font-size: 12px;
        border-radius: 6px;
        color: white;
    }

    .status-pendente {
        background: #f0ad4e;
    }

    .status-concluido {
        background: #5cb85c;
    }

    .fab-btn {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    }

    .tarefa-concluida {
        opacity: 0.6;
    }

    .tarefa-concluida h6 {
        text-decoration: line-through;
    }
</style>

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
        <button class="botao-filtro " data-filtro="">Todas</button>
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