<?php 
session_start();
require_once __DIR__ . '/../app/autoload.php';
use App\Core\Database;

$dbClass = new Database();
$db = $dbClass->getConnection();
$productos_carrito = [];
$total_compra = 0;

if (!empty($_SESSION['carrito'])) {
    $conteo_productos = array_count_values($_SESSION['carrito']);
    $ids_unicos = implode(',', array_keys($conteo_productos));
    
    $sql = "SELECT * FROM productos WHERE id IN ($ids_unicos)";
    $stmt = $db->query($sql);
    $productos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($productos_db as $p) {
        $cantidad = $conteo_productos[$p['id']];
        $subtotal = $p['precio'] * $cantidad;
        $total_compra += $subtotal;
        
        $p['cantidad_carrito'] = $cantidad;
        $p['subtotal_carrito'] = $subtotal;
        $productos_carrito[] = $p;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Bolsa Kawaii - TechHub ✨</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/techhub/public/css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 style="margin-top: 40px;">Tu Bolsa de Compras 🎀</h1>
        
        <?php if (!empty($productos_carrito)): ?>
            <div style="text-align: right; margin-bottom: 10px;">
                <a href="/techhub/public/carrito_clear.php" style="color: #ff8fab; font-size: 0.9em; text-decoration: none; font-weight: bold;">🗑️ Vaciar bolsa</a>
            </div>

            <div class="productos-lista">
                <?php foreach($productos_carrito as $item): ?>
                    <div class="card" style="display: flex; align-items: center; justify-content: space-between; padding: 15px; margin-bottom: 15px; border: 2px solid #ffcad4;">
                        <img src="/techhub/public/img/<?php echo $item['imagen']; ?>" style="width: 70px; height: 70px; object-fit: contain; border-radius: 10px; background: #fff;">
                        
                        <div style="flex-grow: 1; margin-left: 20px; text-align: left;">
                            <span style="font-weight: bold; color: #ff8fab; font-size: 1.1em;"><?php echo htmlspecialchars($item['nombre']); ?></span>
                            <br>
                            <small style="color: #7d5a61;">Cantidad: <?php echo $item['cantidad_carrito']; ?></small>
                        </div>
                        
                        <span style="font-weight: bold; color: #7d5a61;">$<?php echo number_format($item['subtotal_carrito'], 0, ',', '.'); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div style="text-align: right; padding: 20px; margin-top: 10px;">
                <h2 style="color: #7d5a61;">Total: <span style="color: #ff8fab;">$<?php echo number_format($total_compra, 0, ',', '.'); ?></span></h2>
            </div>
            
            <div style="text-align: center; margin-top: 20px; padding: 25px; background: white; border-radius: 20px; border: 2px dashed #ffcad4;">
                <?php if(isset($_SESSION['usuario_nombre'])): ?>
                    <a href="pago.php" class="btn-kawaii" style="text-decoration: none; display: inline-block;">
    Proceder a la compra 🛍️
</a>
                <?php else: ?>
                    <p style="color: #7d5a61; font-weight: bold;">¡Casi listo! ✨</p>
                    <p style="font-size: 0.9em; margin-bottom: 15px;">Para proceder al pago, por favor identifícate.</p>
                    <a href="/techhub/views/login.php?from=carrito" class="btn-kawaii" style="text-decoration: none; display: inline-block; width: 220px;">
    Identificarme 🎀
</a>
                <?php endif; ?>
                <br><br>
                <a href="/techhub/public/index.php" style="color: #ff8fab; text-decoration: none; font-weight: bold;">🌸 Seguir mirando</a>
            </div>
        <?php else: ?>
            <div class="card" style="text-align: center; padding: 50px;">
                <p style="font-size: 1.5em;">Tu bolsa está vacía... 🌸😭</p>
                <br>
                <a href="/techhub/public/index.php" class="btn-kawaii" style="text-decoration: none; display: inline-block; width: 200px;">Ir a la tienda 🛍️</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>