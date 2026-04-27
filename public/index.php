<?php
// public/index.php
require_once __DIR__ . '/../app/autoload.php';

use App\Core\Database;
use App\Controllers\ProductoController;

$dbClass = new Database();
$db = $dbClass->getConnection();

if ($db) {
    $controller = new ProductoController($db);
    $productos = $controller->listar();
    
    
    include __DIR__ . '/../views/catalogo.php';
}
?>