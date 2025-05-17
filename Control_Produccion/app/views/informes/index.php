<?php
require_once '../app/views/templates/header.php';
require_once '../config/db.php';
global $conn;

// Obtener lista de trabajadores
$trabajadores = $conn->query("SELECT id, nombre FROM trabajadores");

// Capturar filtro (GET)
$filtro_trabajador = $_GET['trabajador_id'] ?? '';

// Construir SQL base
$sql = "SELECT i.id, t.nombre AS trabajador, i.titulo, i.contenido, i.fecha
        FROM informes i
        JOIN trabajadores t ON i.trabajador_id = t.id";

if (!empty($filtro_trabajador)) {
    $sql .= " WHERE t.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $filtro_trabajador);
} else {
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$resultado = $stmt->get_result();
?>

<section class="formulario">
    <h2>Lista de Informes</h2>

    <form method="GET" class="filtro-form">
        <label for="trabajador_id">Filtrar por Trabajador:</label>
        <select name="trabajador_id">
            <option value="">Todos</option>
            <?php while ($t = $trabajadores->fetch_assoc()): ?>
                <option value="<?= $t['id'] ?>" <?= $filtro_trabajador == $t['id'] ? 'selected' : '' ?>>
                    <?= $t['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" class="boton">Filtrar</button>
    </form>

    <table class="tabla">
        <tr>
            <th>Trabajador</th>
            <th>Título</th>
            <th>Contenido</th>
            <th>Fecha</th>
        </tr>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['trabajador'] ?></td>
                    <td><strong><?= htmlspecialchars($row['titulo']) ?></strong></td>
                    <td><?= nl2br(htmlspecialchars($row['contenido'])) ?></td>
                    <td><?= $row['fecha'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No se encontraron informes.</td></tr>
        <?php endif; ?>
    </table>
</section>

<?php
$stmt->close();
$conn->close();
require_once '../app/views/templates/footer.php';
?>
