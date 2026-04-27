<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { 
    header("Location: login.php?from=carrito"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procesando Pago - TechHub ✨</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body style="background-color: #fff5f7;">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="card text-center" style="max-width: 500px; padding: 40px; border-radius: 30px; border: 3px solid #ffcad4;">
            <h2 style="color: #ff8fab; margin-bottom: 20px;">Estamos validando tu pago... 🌸</h2>
            
            <div class="spinner-heart" style="font-size: 3rem; color: #ff8fab; margin-bottom: 20px;">💖</div>
            
            <p style="color: #7d5a61;">Por favor, no cierres esta ventana mientras procesamos la transacción en Transbank.</p>
            
            <div style="background: #fff; border-radius: 15px; padding: 10px; margin-top: 15px;">
                <p style="margin-bottom: 0;">Redirigiendo en <span id="contador" style="font-weight: bold; font-size: 1.5em; color: #ff8fab;">5</span> segundos ✨</p>
            </div>
        </div>
    </div>

    <script>
        let segundos = 5;
        const contadorElemento = document.getElementById('contador');

        const timer = setInterval(() => {
            segundos--;
            contadorElemento.innerText = segundos;
            
            if (segundos <= 0) {
                clearInterval(timer);
                window.location.href = "confirmacion.php";
            }
        }, 1000);
    </script>

    <style>
        
        .spinner-heart {
            animation: heartbeat 1.5s ease-in-out infinite;
        }
        @keyframes heartbeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
</body>
</html>