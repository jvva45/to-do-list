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

    public function listarAjax()
    {
        if (!isset($_SESSION['user_id'])) {
            exit;
        }

        $usuarioId = $_SESSION['user_id'];

        $busca  = $_GET['busca']  ?? null;
        $filtro = $_GET['filtro'] ?? null;

   
        $resultado = $this->tarefaModel->listarTarefas($usuarioId, $filtro, $busca);

        $tarefas = [];
        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $tarefas[] = $row;
            }
        }

        require APP_PATH . 'views/componentes/listar_tarefas.php';
    }
    public function nova()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
        require APP_PATH . 'views/tarefa/form.php';
    }


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


    public function deletarTarefa()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }
        $id = $_POST['id'] ?? null;
        $usuarioId = $_SESSION['user_id'];

        $deletou = $this->tarefaModel->deletarTarefa($id, $usuarioId);

        header(
            $deletou
                ? "Location: /dashboard?sucesso=Tarefa excluída"
                : "Location: /dashboard?erro=Erro ao excluir"
        );
        exit();
    }
 
    public function concluirTarefa()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }
        $id = $_POST['id'] ?? null;
        $usuarioId = $_SESSION['user_id'];

        $concluiu = $this->tarefaModel->concluirTarefa($id, $usuarioId);

        header(
            $concluiu
                ? "Location: /dashboard?sucesso=Tarefa concluída"
                : "Location: /dashboard?erro=Erro ao concluir"
        );
        exit();
    }

    public function editar()
    {


        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $id = $_GET['id'] ?? null;
        $usuarioId = $_SESSION['user_id'];

        if (!$id) {
            header("Location: /dashboard");
            exit;
        }

        $tarefa = $this->tarefaModel->buscarTarefaPorId($id, $usuarioId);

        if (!$tarefa) {
            header("Location: /dashboard");
            exit;
        }

        require APP_PATH . 'views/editar_tarefa.php';
    }

    public function atualizarTarefa()
    {
        if (!isset($_POST['id'], $_POST['titulo'], $_POST['descricao'], $_POST['data'], $_POST['status'])) {
            header("Location: /dashboard?erro=Campos obrigatórios");
            exit();
        }

        $usuarioId = $_SESSION['user_id'];
        $id = trim($_POST['id']);
        $titulo = trim($_POST['titulo']);
        $descricao = trim($_POST['descricao']);
        $data_limite = trim($_POST['data']);
        $status = trim($_POST['status']);

        $atualizou = $this->tarefaModel->atualizarTarefa(
            $id,
            $usuarioId,
            $titulo,
            $descricao,
            $status,
            $data_limite
        );

        header(
            $atualizou
                ? "Location: /dashboard?sucesso=Tarefa atualizada"
                : "Location: /dashboard?erro=Erro ao atualizar"
        );
        exit();
    }
}
