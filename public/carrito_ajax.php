<?php
session_start();

if (isset($_GET['id'])) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    
    $_SESSION['carrito'][] = $_GET['id'];

    // Respondemos en formato JSON
    echo json_encode([
        'status' => 'success',
        'total' => count($_SESSION['carrito'])
    ]);
    exit;
}