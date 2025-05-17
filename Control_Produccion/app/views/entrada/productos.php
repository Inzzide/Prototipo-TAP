<?php require_once '../app/views/templates/header.php'; ?>

<section class="formulario">
    <h2>Registrar Producto</h2>
    <form action="/Control_Produccion/public/EntradaController/guardarProducto" method="POST">
        <label for="tipo_producto">Tipo de Producto:</label>
        <input type="text" name="tipo_producto" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <label for="hora">Hora:</label>
        <input type="time" name="hora" required>

        <button type="submit" class="boton">Guardar Producto</button>
    </form>
</section>

<?php require_once '../app/views/templates/footer.php'; ?>

