<?php
session_start();

// Borramos solo el carrito
if (isset($_SESSION['carrito'])) {
    unset($_SESSION['carrito']);
}

// Redirigir
header("Location: /techhub/views/ver_carrito.php");
exit();