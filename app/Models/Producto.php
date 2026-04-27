<?php
namespace App\Models;

use PDO;

class Producto {
    private $conn;
    private $table_name = "productos";

    
    private $id;
    private $nombre;
    private $precio;

    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function leerTodo() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}