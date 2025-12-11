<?php

define('APP_PATH', __DIR__ . '/../app/');
session_start();


require APP_PATH . 'core/Router.php';
require APP_PATH . 'controllers/AuthController.php'; 

$router = new Router();


$router->get('login', 'login.php');
$router->get('cadastro', 'cadastro.php');
$router->get('dashboard', 'dashboard.php'); 
$router->get('logout', ['AuthController', 'handleLogout']);

$router->post('cadastro/processar', ['AuthController', 'handleCadastro']);
$router->post('login/processar', ['AuthController', 'handleLogin']);


$router->run();
