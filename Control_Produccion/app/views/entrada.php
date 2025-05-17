<section class="formulario">
    <h2>Registrar Entrada</h2>

    <form action="/Control_Produccion/public/EntradaController/guardar" method="POST">
        <label for="trabajador_id">ID del Trabajador:</label>
        <input type="number" name="trabajador_id" id="trabajador_id" required>

        <label for="fecha_entrada">Fecha y Hora de Entrada:</label>
        <input type="datetime-local" name="fecha_entrada" id="fecha_entrada" required>

        <label for="fecha_salida">Fecha y Hora de Salida:</label>
        <input type="datetime-local" name="fecha_salida" id="fecha_salida">

        <label for="tipo_producto">Tipo de Producto:</label>
        <input type="text" name="tipo_producto" id="tipo_producto" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>

        <button type="submit" class="boton">Guardar Entrada</button>
    </form>
</section>
