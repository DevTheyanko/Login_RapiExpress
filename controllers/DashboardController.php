<?php
require_once 'models/Usuario.php';

class DashboardController {
    public function index() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php');
            exit();
        }
        
        
        $empleados = Usuario::obtenerTodos();
        
        include 'views/dashboard.php';
    }
}