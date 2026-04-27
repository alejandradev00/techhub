<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - TechHub Store ✨</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/estilos.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 25px;
            border: 3px solid #ffcad4;
            box-shadow: 0 8px 0px #ffcad4;
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
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="../public/registro_action.php" method="POST">
            <h2 style="text-align:center; color: #ff8fab; margin-bottom: 20px;">Crea tu cuenta 🎀</h2>
            
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="email" name="email" placeholder="Tu email" required>
            <input type="text" name="direccion" placeholder="Dirección de entrega (ej: Providencia 123)" required>
            <input type="password" name="password" placeholder="Crea una contraseña" required>
            
            <button type="submit" class="btn-kawaii">Registrarme ✨</button>
        </form>
        
        <p style="text-align:center; margin-top:15px;">
            <a href="login.php" style="color: #ff8fab; text-decoration:none;">¿Ya tienes cuenta? Entra aquí 🌸</a>
        </p>
    </div>
</body>
</html>