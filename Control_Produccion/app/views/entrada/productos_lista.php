<section class="formulario">
    <h2>Historial de Productos Ingresados</h2>

    <table class="tabla">
        <thead>
            <tr>
                <th>Tipo de Producto</th>
                <th>Cantidad</th>
                <th>Fecha y Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $query->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['tipo_producto']) ?></td>
                    <td><?= $row['cantidad'] ?></td>
                    <td><?= $row['fecha'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>
