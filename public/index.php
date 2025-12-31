<?php
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Controller.php';


spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/models/' . $class . '.php',
        __DIR__ . '/../app/controllers/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

$controllerName = $_GET['controller'] ?? 'dashboard';
$actionName     = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controllerName) . 'Controller';

if (!class_exists($controllerClass)) {
    http_response_code(404);
    die("Controller $controllerClass not found");
}

$controller = new $controllerClass();

if (!method_exists($controller, $actionName)) {
    http_response_code(404);
    die("Action $actionName not found in controller $controllerClass");
}

$controller->$actionName();
