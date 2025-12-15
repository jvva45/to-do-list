<?php if (empty($tarefas)): ?>

    <p class="texto-secundario text-center">
        Nenhuma tarefa encontrada.
    </p>

<?php else: ?>

    <?php foreach ($tarefas as $tarefa): ?>

        <div class="cartao-tarefa">
            <div class="d-flex justify-content-between">
                <h6 class="text-light mb-1">
                    <?= htmlspecialchars($tarefa['titulo']) ?>
                </h6>
                <button class="btn btn-sm text-light">⋮</button>
            </div>

            <p class="texto-secundario">
                <?= htmlspecialchars($tarefa['descricao']) ?>
            </p>

            <div class="d-flex align-items-center gap-2 texto-secundario">
                📅 <?= date('d/m/Y', strtotime($tarefa['data_limite'])) ?>

                <span class="status 
                    <?= $tarefa['status'] === 'pendente'
                        ? 'status-pendente'
                        : 'status-concluido' ?>">
                    <?= ucfirst($tarefa['status']) ?>
                </span>
            </div>
        </div>

    <?php endforeach; ?>

<?php endif; ?>
