<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p class="mb-0">&copy; <?= date('Y') ?> Sistema de Tarefas</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery (obrigatório para AJAX) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Script AJAX de busca -->
<script>
$(document).ready(function () {

    let timeout = null;
    let filtroAtual = null; // pendente | concluida | null

    function carregarTarefas() {
        $.ajax({
            url: '/tarefa/listar',
            method: 'GET',
            data: {
                busca: $('input[name="busca"]').val(),
                filtro: filtroAtual
            },
            success: function (html) {
                $('#lista-tarefas').html(html);
            }
        });
    }

    // BUSCA (digitando)
    $('input[name="busca"]').on('keyup', function () {

        clearTimeout(timeout);

        timeout = setTimeout(function () {
            carregarTarefas();
        }, 300);
    });

    // FILTRO (botões)
    $('.botao-filtro').on('click', function () {

        $('.botao-filtro').removeClass('active');
        $(this).addClass('active');

        filtroAtual = $(this).data('filtro') || null;

        carregarTarefas();
    });

});
</script>


</body>
</html>
