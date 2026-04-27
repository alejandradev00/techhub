<?php
session_start();
require_once __DIR__ . '/../app/autoload.php';
use App\Core\Database;


if (!isset($_SESSION['usuario_id']) || empty($_SESSION['carrito'])) { 
    header("Location: /techhub/public/index.php"); 
    exit(); 
}

$dbClass = new Database();
$db = $dbClass->getConnection();


$stmt = $db->prepare("SELECT email, direccion FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $_SESSION['usuario_id']]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);


$codigo_orden = "TH-" . rand(1000, 9999) . "-" . strtoupper(substr(md5(time()), 0, 4));
$conteo_productos = array_count_values($_SESSION['carrito']);
$total_compra = 0;


foreach ($conteo_productos as $producto_id => $cantidad) {
    $st = $db->prepare("SELECT precio, stock FROM productos WHERE id = :id");
    $st->execute([':id' => $producto_id]);
    $prod = $st->fetch(PDO::FETCH_ASSOC);
    
    if ($prod) {
        $total_compra += ($prod['precio'] * $cantidad);
        
        
        $nuevo_stock = ($prod['stock'] >= $cantidad) ? ($prod['stock'] - $cantidad) : 0;
        
        
        $upd = $db->prepare("UPDATE productos SET stock = :nuevo_stock WHERE id = :id");
        $upd->execute([':nuevo_stock' => $nuevo_stock, ':id' => $producto_id]);
    }
}


$ins = $db->prepare("INSERT INTO ordenes (usuario_id, codigo_orden, total) VALUES (:u, :c, :t)");
$ins->execute([
    ':u' => $_SESSION['usuario_id'],
    ':c' => $codigo_orden,
    ':t' => $total_compra
]);


unset($_SESSION['carrito']); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Compra Exitosa! - TechHub 🛍️</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body style="background-color: #fff5f7;">
    <div class="container" style="margin-top: 60px; max-width: 700px;">
        <div class="card" style="padding: 40px; border-radius: 30px; border: 3px dashed #ffcad4; background: white; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
            <div style="text-align: center;">
                <span style="font-size: 4rem;">🎉</span>
                <h1 style="color: #ff8fab; margin-top: 15px;">¡Pedido Confirmado!</h1>
                <p style="color: #7d5a61;">Gracias por confiar en TechHub Store, <b><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></b>.</p>
            </div>

            <div style="background: #fff5f7; border-radius: 20px; padding: 25px; margin-top: 30px;">
                <h4 style="color: #ff8fab; border-bottom: 2px solid #ffcad4; padding-bottom: 10px;">Detalles del Envío 🌸</h4>
                <p><strong>Número de Orden:</strong> <span style="font-family: monospace; font-size: 1.1em;"><?php echo $codigo_orden; ?></span></p>
                <p><strong>Email de contacto:</strong> <?php echo htmlspecialchars($user_data['email']); ?></p>
                <p><strong>Dirección de entrega:</strong> <?php echo htmlspecialchars($user_data['direccion']); ?></p>
                <p><strong>Total pagado:</strong> $<?php echo number_format($total_compra, 0, ',', '.'); ?></p>
                <p><strong>Estado:</strong> <span class="badge bg-success" style="background-color: #b7e4c7 !important; color: #2d6a4f;">Pagado / Procesando</span></p>
            </div>

            <div class="alert alert-info mt-4" style="border-radius: 15px; background-color: #e3f2fd; border: none; color: #0d47a1;">
                ✨ Te hemos enviado un correo electrónico con el detalle de tus productos y el seguimiento de tu despacho.
            </div>

            <div class="text-center mt-4">
                <a href="/techhub/public/index.php" class="btn-kawaii" style="text-decoration: none; display: inline-block; width: 250px;">
                    Volver al Inicio 🎀
                </a>
            </div>
        </div>
    </div>
</body>
</html>