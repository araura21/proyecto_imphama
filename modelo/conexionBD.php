<?php
class connectionDB {
    public $servername;
    public $username;
    public $password;
    public $database;
    public $conn;

    public function __construct() {
        $this->servername = "localhost";
        $this->username = "admin"; // No cambiar esto
        $this->password = "admin"; // No cambiar esto
        $this->database = "sistema_cotizaciones"; // No cambiar esto

        // Crear conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        // Verificar conexión
        if ($this->conn->connect_error) {
            die("Error en la conexión: " . $this->conn->connect_error);
        }
    }

    public function connection() {
        return $this->conn;
    }
}

?>
