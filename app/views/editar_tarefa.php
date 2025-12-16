<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

require APP_PATH . 'views/layout/header.php';
?>

<style>
    body {
        background: #0f1214;
        color: #fff;
    }
</style>

<div class="container mt-5">

    <form method="POST"
        action="<?= isset($tarefa) ? '/tarefa/atualizar' : '/tarefa/salvar' ?>">

        <?php if (isset($tarefa)): ?>
            <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
        <?php endif; ?>

 
        <div class="px-3">
            <input
                type="text"
                name="titulo"
                class="form-control bg-secondary text-white border-0 p-3 rounded-3 mb-2"
                placeholder="Título da tarefa"
                required
                value="<?= $tarefa['titulo'] ?? '' ?>">

            <textarea
                name="descricao"
                class="form-control bg-secondary text-white border-0 p-3 rounded-3"
                placeholder="Adicione detalhes, notas ou subtarefas..."
                rows="3"><?= $tarefa['descricao'] ?? '' ?></textarea>
        </div>

        <div class="mt-3 px-3">
            <div class="card bg-secondary text-white p-3 mb-3 rounded-3">

                <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-dark">
                    <span>📅 Data limite</span>
                    <input
                        type="date"
                        name="data"
                        class="form-control form-control-sm w-auto bg-dark text-white border-0"
                        value="<?= $tarefa['data_limite'] ?? '' ?>">
                </div>

                <div class="d-flex justify-content-between align-items-center py-2">
                    <span>✅ Status</span>
                    <select name="status" class="form-select bg-dark text-white border-0 w-auto">
                        <option value="pendente"
                            <?= ($tarefa['status'] ?? '') === 'pendente' ? 'selected' : '' ?>>
                            Pendente
                        </option>
                        <option value="concluida"
                            <?= ($tarefa['status'] ?? '') === 'concluida' ? 'selected' : '' ?>>
                            Concluída
                        </option>
                    </select>
                </div>
            </div>

            <a href="/dashboard" class="btn btn-outline-light w-100 rounded-3 py-3 mb-2">
                 Voltar
            </a>

            <button type="submit" class="btn btn-primary w-100 rounded-3 py-3 mb-3">
                <i class="bi bi-check-circle me-2"></i> Salvar Alterações   
            </button>
        </div>
    </form>
</div>

<?php require APP_PATH . 'views/layout/footer.php'; ?>