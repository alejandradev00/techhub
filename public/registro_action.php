<?php
require_once __DIR__ . '/../app/autoload.php';

use App\Core\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbClass = new Database();
    $db = $dbClass->getConnection();

    
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion']; 
    $password = $_POST['password'];

    
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    try {
        
        $sql = "INSERT INTO usuarios (nombre, email, direccion, password) VALUES (:nombre, :email, :direccion, :password)";
        $stmt = $db->prepare($sql);

        
        $resultado = $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':direccion' => $direccion,
            ':password' => $passwordHash
        ]);

        if ($resultado) {
            echo "<div style='font-family:Quicksand, sans-serif; text-align:center; padding:50px; color:#ff8fab;'>";
            echo "<h2>¡Cuenta creada con éxito! 🎀✨</h2>";
            echo "<p>Ya eres parte de TechHub Store. Tu dirección de entrega ha sido registrada.</p>";
            echo "<a href='/techhub/views/login.php' style='color:#ffb7c5; font-weight:bold;'>Iniciar Sesión para comprar 🌸</a>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "<div style='font-family:Quicksand, sans-serif; text-align:center; padding:50px;'>";
            echo "Ese email ya está registrado. Intenta con otro 🌸";
            echo "<br><a href='javascript:history.back()'>Volver</a>";
            echo "</div>";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}