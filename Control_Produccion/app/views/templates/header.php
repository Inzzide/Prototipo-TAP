<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Centro de Producción</title>
    <link rel="stylesheet" href="/Control_Produccion/public/css/estilo.css">
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['usuario'])):
    echo "<!-- ROL: {$_SESSION['usuario']['rol']} -->"; // Para depuración
?>

    <nav>
        <a href="/Control_Produccion/public/HomeController/<?= $_SESSION['usuario']['rol'] ?>" class="boton">Inicio</a>
    </nav>
<?php endif; ?>
