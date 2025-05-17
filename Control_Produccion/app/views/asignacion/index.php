<?php
require_once '../app/views/templates/header.php';
require_once '../config/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Debe iniciar sesión'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
    exit;
}

global $conn;
$id_usuario = $_SESSION['usuario']['id'];
$rol = $_SESSION['usuario']['rol'];

$sql = "SELECT a.tarea, a.fecha_asignacion, t.nombre 
        FROM asignaciones a
        JOIN trabajadores t ON a.trabajador_id = t.id";

if ($rol === 'trabajador') {
    $sql .= " WHERE trabajador_id = $id_usuario";
}

$sql .= " ORDER BY a.fecha_asignacion DESC";

$query = $conn->query($sql);
?>

<section class="formulario">
    <h2>Asignaciones</h2>
    <table class="tabla">
        <tr>
            <th>Trabajador</th>
            <th>Tarea</th>
            <th>Fecha</th>
        </tr>
        <?php while ($row = $query->fetch_assoc()): ?>
            <tr>
                <td><?= $row['nombre'] ?></td>
                <td><?= nl2br(htmlspecialchars($row['tarea'])) ?></td>
                <td><?= $row['fecha_asignacion'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>

<?php require_once '../app/views/templates/footer.php'; ?>
