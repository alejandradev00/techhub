<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub Store - Kawaii Edition ✨</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/techhub/public/css/estilos.css">
</head>
<body>
    <?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); 
    }
    ?>

    <div class="container" style="text-align: right; padding: 20px 10px;">
        <a href="/techhub/views/ver_carrito.php" style="text-decoration:none; font-size: 1.1em; margin-right: 20px;">
            🛒 <span id="carrito-count" style="color: #4a90e2; font-weight: bold;">
                (<?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>)
            </span>
        </a>

        <?php if(isset($_SESSION['usuario_nombre'])): ?>
            <span style="color: #ff8fab; font-weight: bold;">
                ✨ ¡Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>! ✨
            </span>
            <a href="/techhub/public/logout.php" style="margin-left:15px; color: #7d5a61;">Cerrar sesión</a>
        <?php else: ?>
            <a href="/techhub/views/login.php" style="color: #ff8fab; font-weight: bold;">Iniciar Sesión 🌸</a>
        <?php endif; ?>
    </div>

    <div class="container">
        <h1 style="margin-bottom: 30px;">Bienvenid@ a TechHub Store ✨</h1>
        
        <?php if (!empty($productos)): ?>
            <div class="productos-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
                <?php foreach ($productos as $item): ?>
                    <div class="card" style="text-align: center; padding: 20px; border: 2px solid #ffcad4; border-radius: 25px;">
                        <img src="/techhub/public/img/<?php echo $item['imagen']; ?>" style="width:100%; height: 200px; object-fit: contain; border-radius:15px;">
                        
                        <h4 style="color: #7d5a61; margin-top:10px;"><?php echo htmlspecialchars($item['nombre']); ?></h4>
                        
                        <p style="font-weight: bold; color: #ff8fab; font-size: 1.2em;">
                            $<?php echo number_format($item['precio'], 0, ',', '.'); ?>
                        </p>

                        <?php if ($item['stock'] > 0): ?>
                            <p style="color: #b19298; font-size: 0.85em; margin-bottom: 10px;">✨ ¡Quedan <?php echo $item['stock']; ?> disponibles!</p>
                            <a href="carrito_add.php?id=<?php echo $item['id']; ?>" class="btn-kawaii" style="text-decoration:none; display:block;">
                                Agregar a la bolsa 🛍️
                            </a>
                        <?php else: ?>
                            <p style="color: #ff6b6b; font-weight: bold; font-size: 0.85em; margin-bottom: 10px;">🚫 Agotado temporalmente</p>
                            <button class="btn-kawaii" style="background: #e0e0e0; color: #999; cursor: not-allowed; border:none; width: 100%;" disabled>
                                Sin Stock 🌸
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; font-size: 1.2em; color: #7d5a61;">No hay productos disponibles en este momento... 🌸</p>
        <?php endif; ?>
    </div>

<script>
document.querySelectorAll('.btn-kawaii').forEach(boton => {
    if (!boton.disabled) { 
        boton.addEventListener('click', function(e) {
            e.preventDefault(); 
            
            const url = this.getAttribute('href').replace('carrito_add.php', 'carrito_ajax.php');

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'success') {
                        document.querySelector('#carrito-count').innerHTML = `(${data.total})`;
                        
                        const colorOriginal = this.style.background;
                        this.style.background = '#b7e4c7'; 
                        setTimeout(() => this.style.background = colorOriginal, 500);
                    }
                })
                .catch(err => console.error('Error:', err));
        });
    }
});
</script>   
</body>
</html>