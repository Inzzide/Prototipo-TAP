<?php
require_once '../app/views/templates/header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario']['rol'], ['trabajador', 'administrador'])) {
    echo "<script>alert('Acceso denegado'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
    exit;
}

$trabajador_id = $_SESSION['usuario']['id'];
?>

<section class="formulario">
    <h2>Crear Informe</h2>

    <form action="/Control_Produccion/public/InformesController/guardar" method="POST">
        <input type="hidden" name="trabajador_id" value="<?= $trabajador_id ?>">

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>

        <label for="contenido">Contenido:</label>
        <textarea name="contenido" rows="6" required></textarea>

        <button type="submit" class="boton">Guardar Informe</button>
    </form>
</section>

<?php require_once '../app/views/templates/footer.php'; ?>
