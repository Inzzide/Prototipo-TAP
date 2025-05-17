<?php
require_once '../app/views/templates/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'trabajador') {
    echo "<script>alert('Acceso denegado'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
    exit;
}

$nombre = $_SESSION['usuario']['nombre'];
$id = $_SESSION['usuario']['id'];
?>

<section class="formulario">
    <h2>Registro de Asistencia</h2>

    <p><strong>Bienvenido, <?= $nombre ?></strong></p>

    <form action="/Control_Produccion/public/EntradaController/guardarAsistencia" method="POST">
        <input type="hidden" name="usuario_id" value="<?= $id ?>">

        <label for="accion">Acción:</label>
        <select name="accion" required>
            <option value="entrada">Marcar Entrada</option>
            <option value="salida">Marcar Salida</option>
        </select>

        <button type="submit" class="boton">Registrar</button>
    </form>
</section>

<?php require_once '../app/views/templates/footer.php'; ?>
