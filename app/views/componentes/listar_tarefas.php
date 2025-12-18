<?php if (empty($tarefas)): ?>

    <p class="texto-secundario text-center">
        Nenhuma tarefa encontrada.
    </p>

<?php else: ?>

    <?php foreach ($tarefas as $tarefa): ?>

        <div class="cartao-tarefa <?= $tarefa['status'] === 'concluida' ? 'tarefa-concluida' : '' ?>">



            <div class="d-flex justify-content-between align-items-start">

                <div>
                    <h6 class="text-light mb-1">
                        <?= htmlspecialchars($tarefa['titulo']) ?>
                    </h6>

                    <p class="texto-secundario mb-1">
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

                <div class="d-flex gap-2 align-items-center">

                    <?php if ($tarefa["status"] === "pendente"): ?>
                        
                        <a href="#" class="btn btn-link p-0 btn-concluir" data-id="<?= $tarefa["id"] ?>" title="Concluir Tarefa">
                            <i class="bi bi-check-circle-fill"></i>
                        </a>
                        <a href="/tarefa/editar?id=<?= $tarefa["id"] ?>" class="btn btn-link p-0 btn-editar" data-id="<?= $tarefa["id"] ?>" title="Editar Tarefa">
                            <i class="bi bi-pencil"></i>
                        </a>

                    <?php else: ?>
                        
                        <a href="#" class="btn btn-link p-0 btn-reabrir" data-id="<?= $tarefa["id"] ?>" title="Reabrir Tarefa">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    <?php endif; ?>

                    
                    <a href="#" class="btn btn-link p-0 btn-excluir" data-id="<?= $tarefa["id"] ?>" title="Excluir Tarefa">
                        <i class="bi bi-trash"></i>
                    </a>

                </div>

            </div>
        </div>

    <?php endforeach; ?>

<?php endif; ?>