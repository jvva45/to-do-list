<?php

require_once APP_PATH . 'config/database.php';
require_once APP_PATH . 'models/TarefaModel.php';

class TarefaController
{
    private $tarefaModel;

    public function __construct()
    {
        global $conexao;
        $this->tarefaModel = new TarefaModel($conexao);
    }

    // 🧩 Carrega o dashboard
    public function listar()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $usuarioId = $_SESSION['user_id'];

        $resultado = $this->tarefaModel->listarTarefas($usuarioId);

        $tarefas = [];
        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $tarefas[] = $row;
            }
        }

        require APP_PATH . 'views/dashboard.php';
    }

    // ⚡ AJAX: busca + filtro
    public function listarAjax()
    {
        if (!isset($_SESSION['user_id'])) {
            exit;
        }

        $usuarioId = $_SESSION['user_id'];

        $busca  = $_GET['busca']  ?? null;
        $filtro = $_GET['filtro'] ?? null;

        // 🔥 usa o model já criado no construtor
        $resultado = $this->tarefaModel->listarTarefas($usuarioId, $filtro, $busca);

        $tarefas = [];
        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $tarefas[] = $row;
            }
        }

        require APP_PATH . 'views/componentes/listar_tarefas.php';
    }

    // 💾 Salvar tarefa
    public function salvarTarefa()
    {
        if (!isset($_POST['titulo'], $_POST['descricao'], $_POST['data'], $_POST['status'])) {
            header("Location: /tarefa/nova?erro=Campos obrigatórios");
            exit();
        }

        $usuarioId = $_SESSION['user_id'];
        $titulo = trim($_POST['titulo']);
        $descricao = trim($_POST['descricao']);
        $data_limite = trim($_POST['data']);
        $status = trim($_POST['status']);
        $data_criacao = date('Y-m-d H:i:s');

        $salvou = $this->tarefaModel->salvarTarefa(
            $usuarioId,
            $titulo,
            $descricao,
            $status,
            $data_criacao,
            $data_limite
        );

        header(
            $salvou
                ? "Location: /dashboard?sucesso=Tarefa criada"
                : "Location: /tarefa/nova?erro=Erro ao salvar"
        );
        exit();
    }
}
