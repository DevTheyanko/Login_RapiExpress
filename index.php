<?php

$c = $_GET['c'] ?? 'auth';
$a = $_GET['a'] ?? 'login';


$controllerName = ucfirst($c) . 'Controller';
$method = $a;

$controllerFile = "controllers/{$controllerName}.php";


if (file_exists($controllerFile)) {
    require_once $controllerFile;

    
    if (class_exists($controllerName)) {
        $controller = new $controllerName();

        
        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            echo "Método '$method' no encontrado en el controlador '$controllerName'.";
        }
    } else {
        echo "Controlador '$controllerName' no encontrado.";
    }
} else {
    echo "Archivo del controlador '$controllerFile' no existe.";
}
