<?php
require_once '../app/views/templates/header.php';
require_once '../config/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    echo "<script>alert('Acceso denegado'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
    exit;
}

global $conn;
$trabajadores = $conn->query("SELECT id, nombre FROM trabajadores");
?>

<section class="formulario">
    <h2>Asignar Tarea a Trabajador</h2>

    <form action="/Control_Produccion/public/AsignacionController/guardar" method="POST">
        <label for="trabajador_id">Trabajador:</label>
        <select name="trabajador_id" required>
            <option value="">Seleccione</option>
            <?php while ($t = $trabajadores->fetch_assoc()): ?>
                <option value="<?= $t['id'] ?>"><?= $t['nombre'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="tarea">Tarea:</label>
        <textarea name="tarea" rows="4" required></textarea>

        <label for="fecha_asignacion">Fecha:</label>
        <input type="date" name="fecha_asignacion" required>


        <button type="submit" class="boton">Asignar</button>
    </form>
</section>

<?php require_once '../app/views/templates/footer.php'; ?>
