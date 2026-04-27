<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - TechHub Store 🌸</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/estilos.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 80px auto;
            background: white;
            padding: 35px;
            border-radius: 30px;
            border: 3px solid #ffcad4;
            box-shadow: 0 10px 0px #ffcad4;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 50px;
            border: 2px solid #ffcad4;
            outline: none;
            box-sizing: border-box;
        }
        
        .btn-kawaii {
            width: 100%;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 style="text-align:center; color: #ff8fab;">¡Hola de nuevo! ✨</h2>
        
        <form action="../public/login_action.php" method="POST">
            <input type="hidden" name="redirect_to" value="<?php echo isset($_GET['from']) ? htmlspecialchars($_GET['from']) : ''; ?>">
            
            <input type="email" name="email" placeholder="Tu email" required>
            <input type="password" name="password" placeholder="Tu contraseña" required>
            
            <button type="submit" class="btn-kawaii">Entrar a la tienda 🎀</button>
        </form>
        
        <p style="text-align:center; margin-top:20px;">
            <a href="registro.php" style="color: #ff8fab; text-decoration:none;">¿No tienes cuenta? Regístrate aquí 🌸</a>
        </p>
    </div>
</body>
</html>