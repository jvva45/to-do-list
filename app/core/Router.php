<?php
// app/core/Router.php

class Router {
    protected $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][trim($uri, '/')] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][trim($uri, '/')] = $action;
    }

    public function run() {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'];

        if (empty($uri)) {
            $uri = 'login'; // Rota padrão
        }

        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];

            if (is_string($action)) {
                $this->loadView($action);
            } elseif (is_array($action) && count($action) === 2) {
                $this->callController($action);
            }
        } else {
            $this->loadView('404.php', 404);
        }
    }

    protected function loadView($viewName, $statusCode = 200) {
        http_response_code($statusCode );
        $viewPath = APP_PATH . 'views/' . $viewName;
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("Erro 404: View não encontrada.");
        }
    }

    protected function callController($action) {
        $controllerName = $action[0];
        $methodName = $action[1];

        // O arquivo do Controller já foi incluído no index.php
        
        $controller = new $controllerName();
        if (method_exists($controller, $methodName)) {
            $controller->$methodName();
        } else {
            die("Erro: Método {$methodName} não encontrado no Controller {$controllerName}.");
        }
    }
}
