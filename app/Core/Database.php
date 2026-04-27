<?php
namespace App\Core;
use PDO;
use PDOException;

class Database {
    
    private $host = "127.0.0.1";
    private $port = "3307"; 
    private $db_name = "techhub_db";
    private $username = "root";
    private $password = "";
    private $conn;

    
    public function getConnection() {
        $this->conn = null;
        try {
            
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            );
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}