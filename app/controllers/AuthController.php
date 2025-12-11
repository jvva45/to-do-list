<?php

require_once APP_PATH . 'config/database.php';
require_once APP_PATH . 'models/User.php';

class AuthController {

    private $userModel;

    public function __construct()
    {
        global $conexao;
        $this->userModel = new User($conexao);
    }

   
    public function handleCadastro()
    {
        if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
            header("Location: /cadastro?erro=" . urlencode("Todos os campos são obrigatórios."));
            exit();
        }

        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha_pura = $_POST['senha'];

        if ($this->userModel->findByEmail($email)) {
            header("Location: /cadastro?erro=" . urlencode("E-mail já cadastrado."));
            exit();
        }

        $senha_hash = password_hash($senha_pura, PASSWORD_DEFAULT);

        $criou = $this->userModel->create($nome, $email, $senha_hash);

        if ($criou) {
            header("Location: /login?cadastro=sucesso");
            exit();
        } else {
            header("Location: /cadastro?erro=" . urlencode("Erro ao cadastrar usuário."));
            exit();
        }
    }

    public function handleLogin()
    {
        if (!isset($_POST['email'], $_POST['senha'])) {
            header("Location: /login?erro=" . urlencode("Todos os campos são obrigatórios."));
            exit();
        }

        $email = trim($_POST['email']);
        $senha_pura = $_POST['senha'];

        $usuario = $this->userModel->findByEmail($email);

        if (!$usuario) {
            header("Location: /login?erro=" . urlencode("Usuário não encontrado."));
            exit();
        }

        if (!password_verify($senha_pura, $usuario['senha'])) {
            header("Location: /login?erro=" . urlencode("Senha incorreta."));
            exit();
        }

        // Login correto
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nome'] = $usuario['nome'];

        header("Location: /dashboard");
        exit();
    }


    public function handleLogout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        setcookie(session_name(), '', time() - 3600, '/');

        header("Location: /login");
        exit();
    }
}
