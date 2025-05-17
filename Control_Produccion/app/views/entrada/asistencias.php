<?php
require_once '../app/views/templates/header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Validación de sesión
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'trabajador') {
    echo "<script>alert('Acceso denegado'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
    exit;
}

require_once '../config/db.php';
global $conn;

$id_usuario = $_SESSION['usuario']['id'];

$query = $conn->prepare("SELECT fecha, hora_entrada, hora_salida FROM asistencias WHERE usuario_id = ? ORDER BY fecha DESC, id DESC");
$query->bind_param("i", $id_usuario);
$query->execute();
$resultado = $query->get_result();
?>

<section class="formulario">
    <h2>Historial de Asistencia</h2>
    <p><strong>Trabajador:</strong> <?= $_SESSION['usuario']['nombre'] ?></p>

    <table class="tabla">
        <tr>
            <th>Fecha</th>
            <th>Hora de Entrada</th>
            <th>Hora de Salida</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['fecha'] ?></td>
                <td><?= $row['hora_entrada'] ?? '-' ?></td>
                <td><?= $row['hora_salida'] ?? '-' ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>

<?php
$query->close();
$conn->close();
require_once '../app/views/templates/footer.php';
?>
