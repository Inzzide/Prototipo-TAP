<?php
require_once '../app/views/templates/header.php';
require_once '../config/db.php';
global $conn;

$query = $conn->query("SELECT producto, cantidad, motivo, fecha FROM mermas ORDER BY fecha DESC");
?>

<section class="formulario">
    <h2>Historial de Mermas</h2>

    <table class="tabla">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Motivo</th>
            <th>Fecha</th>
        </tr>
        <?php while ($row = $query->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['producto']) ?></td>
                <td><?= $row['cantidad'] ?></td>
                <td><?= nl2br(htmlspecialchars($row['motivo'])) ?></td>
                <td><?= $row['fecha'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>

<?php
$query->close();
$conn->close();
require_once '../app/views/templates/footer.php';
?>
