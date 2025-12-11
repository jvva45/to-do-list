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
        background: #0f1214;
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
</style>

<div class="container mt-5">

    <!-- Campo de pesquisa -->
    <div class="mb-3">
        <input type="text" class="form-control campo-busca" placeholder="Pesquisar tarefas...">
    </div>

    <!-- Filtros -->
    <div class="d-flex gap-2 mb-4">
        <button class="botao-filtro active">Todas</button>
        <button class="botao-filtro">Pendentes</button>
        <button class="botao-filtro">Concluídas</button>
    </div>

    <!-- Cartão de tarefa -->
    <div class="cartao-tarefa">
        <div class="d-flex justify-content-between">
            <h6 class="text-light mb-1">Review Q3 Marketing Plan</h6>
            <button class="btn btn-sm text-light">⋮</button>
        </div>

        <p class="texto-secundario">Check analytics and propose budget updates.</p>

        <div class="d-flex align-items-center gap-2 texto-secundario">
            📅 Oct 24
            <span class="status status-pendente">Pendente</span>
        </div>
    </div>

</div>

<?php require APP_PATH . 'views/layout/footer.php'; ?>
