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
</style>

<div class="container mt-5">

    <form id="taskForm" method="POST" action="/tarefa/salvar">


        <!-- Campo título -->
        <div class="px-3">
            <input
                type="text"
                name="titulo"
                class="form-control bg-secondary text-white border-0 p-3 rounded-3 mb-2"
                placeholder="Título da tarefa"
                required>

            <textarea
                name="descricao"
                class="form-control bg-secondary text-white border-0 p-3 rounded-3"
                placeholder="Adicione detalhes, notas ou subtarefas..."
                rows="3"></textarea>
        </div>

        <!-- Campos da tarefa -->
        <div class="mt-3 px-3">

            <div class="card bg-secondary text-white p-3 mb-3 rounded-3">

                <!-- Data -->
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-dark">
                    <span><i class="bi bi-calendar-event me-2"></i> Data limite</span>
                    <input
                        type="date"
                        name="data"
                        min="<?= date('Y-m-d') ?>"
                        class="form-control form-control-sm w-auto bg-dark text-white border-0">

                </div>

                <!-- Status -->
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-dark">
                    <span><i class="bi bi-check2-circle me-2"></i> Status</span>
                    <select name="status" class="form-select bg-dark text-white border-0 w-auto">
                        <option value="pendente">Pendente</option>
                        <option value="concluida">Concluido</option>

                    </select>
                </div>


            </div>




            <!-- Voltar -->
            <a href="/dashboard" class="btn btn-outline-light w-100 rounded-3 py-3 mb-2">
                <i class="bi bi-arrow-left me-2"></i> Voltar
            </a>

            <!-- Criar -->
            <button type="submit" class="btn btn-primary w-100 rounded-3 py-3 mb-3">
                <i class="bi bi-check-circle me-2"></i> Criar Tarefa
            </button>



        </div>

    </form>

</div>

<?php require APP_PATH . 'views/layout/footer.php'; ?>