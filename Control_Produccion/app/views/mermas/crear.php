<?php require_once '../app/views/templates/header.php'; ?>

<section class="formulario">
    <h2>Registrar Merma</h2>

    <form action="/Control_Produccion/public/MermasController/guardar" method="POST">
        <label for="producto">Producto:</label>
        <input type="text" name="producto" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required>

        <label for="motivo">Motivo:</label>
        <textarea name="motivo" rows="4" required></textarea>

        <button type="submit" class="boton">Registrar Merma</button>
    </form>
</section>

<?php require_once '../app/views/templates/footer.php'; ?>
