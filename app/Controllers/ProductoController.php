<?php
namespace App\Controllers;

use App\Models\Producto;

class ProductoController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listar() {
        $productoModel = new Producto($this->db);
        $stmt = $productoModel->leerTodo();
        $productos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        
        return $productos;
    }
}