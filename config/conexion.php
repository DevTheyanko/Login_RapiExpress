<?php
class Conexion {
    private static $instancia = null;
    private $pdo;

    private function __construct() {
        $host = 'localhost';
        $dbname = 'rapiexpress';
        $username = 'root'; 
        $password = '';     
        
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"
        ];

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $username, $password, $options);
            
            
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            error_log("Error de conexión: " . $e->getMessage());
            die("Error al conectar con la base de datos. Por favor intente más tarde.");
        }
    }

    public static function getConexion() {
        if (self::$instancia === null) {
            self::$instancia = new Conexion();
        }
        return self::$instancia->pdo;
    }

    
    public static function verificarEstructura() {
        try {
            $pdo = self::getConexion();
            $stmt = $pdo->query("SHOW TABLES LIKE 'usuarios'");
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al verificar estructura: " . $e->getMessage());
            return false;
        }
    }
}
?>