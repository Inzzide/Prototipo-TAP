<section class="formulario">
    <h2>Listado de Asistencias</h2>
    <form method="GET" action="/Control_Produccion/public/EntradaController/listaAsistencias" class="form-busqueda">
        <label for="buscar">Buscar por nombre:</label>
        <input type="text" name="buscar" id="buscar" value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
        
        <div class="botones-busqueda">
            <button type="submit" class="boton verde">Buscar</button>
            <a href="/Control_Produccion/public/EntradaController/listaAsistencias" class="boton-rojo">Limpiar</a>
        </div>
    </form>

    <br>

    <table class="tabla">
        <tr>
            <th>Nombre</th>
            <th>RUT</th>
            <th>Fecha</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= htmlspecialchars($row['rut']) ?></td>
                <td><?= $row['fecha'] ?></td>
                <td>
                    <form method="POST" action="/Control_Produccion/public/EntradaController/actualizarAsistencia" class="form-inline">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="time" name="hora_entrada" value="<?= $row['hora_entrada'] ?>" class="input-hora">
                </td>
                <td>
                        <input type="time" name="hora_salida" value="<?= $row['hora_salida'] ?>" class="input-hora">
                </td>
                <td class="acciones-btns">
                    <div class="acciones-btns">
                        <button type="submit" class="boton verde">Guardar</button>
                        <a href="/Control_Produccion/public/EntradaController/eliminarAsistencia/<?= $row['id'] ?>" class="boton-rojo" onclick="return confirm('¿Eliminar este registro?')">Eliminar</a>
                    </div>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>
