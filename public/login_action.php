<?php
session_start();
require_once __DIR__ . '/../app/autoload.php';
use App\Core\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbClass = new Database();
    $db = $dbClass->getConnection();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];

        
        if (isset($_POST['redirect_to']) && $_POST['redirect_to'] === 'carrito') {
            header("Location: /techhub/views/ver_carrito.php");
        } else {
            header("Location: /techhub/public/index.php");
        }
        exit();
        
    } else {
        echo "<script>alert('Email o contraseña incorrectos 🌸'); window.location='/techhub/views/login.php';</script>";
        exit();
    }
}