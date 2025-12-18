<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p class="mb-0 text-secondary-custom">&copy; <?= date('Y') ?> Sistema de Tarefas</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


<!-- Script AJAX de busca -->
<script>
    $(document).ready(function() {

        let timeout = null;
        let filtroAtual = 'pendente'; 

        function carregarTarefas() {
            $.ajax({
                url: '/tarefa/listar',
                method: 'GET',
                data: {
                    busca: $('input[name="busca"]').val(),
                    filtro: filtroAtual
                },
                success: function(html) {
                    $('#lista-tarefas').html(html);
                }
            });

             
        }
carregarTarefas(); 

   
        $('input[name="busca"]').on('keyup', function() {

            clearTimeout(timeout);

            timeout = setTimeout(function() {
                carregarTarefas();
            }, 300);
        });

    
        $('.botao-filtro').on('click', function() {

            $('.botao-filtro').removeClass('active');
            $(this).addClass('active');

            filtroAtual = $(this).data('filtro') || null;

            carregarTarefas();
        });


        $(document).on('click', '.btn-concluir', function(e) {
            e.preventDefault();

            const btn = $(this);
            const id = btn.data('id');

            $.ajax({
                url: '/tarefa/concluir',
                data: {
                    id: id
                },
                type: 'POST', 
                success: function() {
                    const cartao = btn.closest('.cartao-tarefa');
                    const status = cartao.find('.status');

                   
                    btn.remove();

                
                    cartao.addClass('tarefa-concluida');


                    carregarTarefas();
                }

            });

            



        });

        
        $(document).on('click', '.btn-excluir', function(e) {
            e.preventDefault();

            const btn = $(this);
            const id = btn.data('id');

            $.ajax({
                url: '/tarefa/excluir',
                data: {
                    id: id
                },
                type: 'POST', // ou POST, conforme sua rota
                success: function() {
                    const cartao = btn.closest('.cartao-tarefa');
                    const status = cartao.find('.status');

                    // Remove botão concluir
                    btn.remove();

        


                    carregarTarefas();
                }

            });

            

            

        });

        // Lógica para REABRIR TAREFA
        $(document).on('click', '.btn-reabrir', function(e) {
            e.preventDefault();

            const btn = $(this);
            const id = btn.data('id');

            $.ajax({
                url: '/tarefa/reabrir', // Assumindo que você tem uma rota /tarefa/reabrir
                data: {
                    id: id
                },
                type: 'POST',
                success: function() {
                    carregarTarefas();
                }
            });
        });

    });
</script>


</body>

</html>