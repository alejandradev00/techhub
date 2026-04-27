<?php
session_start();

// Si no existe el carrito en la sesión, lo creamos como un arreglo vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Agregamos el ID al carrito (puedes agregar el mismo varias veces)
    $_SESSION['carrito'][] = $id;
    
    // Volvemos al catálogo con un mensaje de éxito
    header("Location: index.php?status=agregado");
    exit();
}