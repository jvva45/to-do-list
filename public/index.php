<?php

define('APP_PATH', __DIR__ . '/../app/');
session_start();

require APP_PATH . 'core/Router.php';
require APP_PATH . 'controllers/AuthController.php'; 
require APP_PATH . 'controllers/TarefaController.php';

$router = new Router();

// Rotas públicas
$router->get('login', 'login.php');
$router->get('cadastro', 'cadastro.php');

// Dashboard (carregamento inicial)
$router->get('dashboard', ['TarefaController', 'listar']);


// Tarefas (AJAX único)
$router->get('tarefa/listar', ['TarefaController', 'listarAjax']); // ✅ BUSCA + FILTRO + LISTA
$router->get('tarefa/nova', ['TarefaController', 'nova']);
$router->post('tarefa/salvar', ['TarefaController', 'salvarTarefa']);
$router->post('tarefa/concluir', ['TarefaController', 'concluirTarefa']);
$router->post('tarefa/excluir', ['TarefaController', 'deletarTarefa']);   
$router->post('tarefa/atualizar', ['TarefaController', 'atualizarTarefa']);
$router->get('tarefa/editar', ['TarefaController', 'editar']);
// Auth
$router->post('cadastro/processar', ['AuthController', 'handleCadastro']);
$router->post('login/processar', ['AuthController', 'handleLogin']);
$router->get('logout', ['AuthController', 'handleLogout']);

$router->run();
