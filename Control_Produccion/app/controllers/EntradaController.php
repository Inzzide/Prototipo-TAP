<?php
class EntradaController {

    // Vista principal (puede omitirse si no se usa ya)
    public function index() {
        require_once '../app/views/templates/header.php';
        require_once '../app/views/entrada/productos.php'; // O redirigir directamente al menú
        require_once '../app/views/templates/footer.php';
    }

    // Mostrar formulario de registro de productos
    public function productos() {
        require_once '../app/views/templates/header.php';
        require_once '../app/views/entrada/productos.php';
        require_once '../app/views/templates/footer.php';
    }

    // Mostrar formulario de registro de trabajadores
    public function trabajadores() {
        require_once '../app/views/templates/header.php';
        require_once '../app/views/entrada/trabajadores.php';
        require_once '../app/views/templates/footer.php';
    } 

    // Mostrar formulario editor de asistencias para admin
   public function listaAsistencias() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
        echo "<script>alert('Acceso denegado'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
        exit;
    }

    require_once '../config/db.php';
    global $conn;

    $buscar = $_GET['buscar'] ?? '';
    $buscar = "%" . $buscar . "%";

    $sql = "SELECT a.id, t.nombre, t.rut, a.fecha, a.hora_entrada, a.hora_salida 
            FROM asistencias a
            JOIN trabajadores t ON a.usuario_id = t.id
            WHERE t.nombre LIKE ?
            ORDER BY a.fecha DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $buscar);
    $stmt->execute();
    $result = $stmt->get_result();

    require_once '../app/views/templates/header.php';
    require '../app/views/entrada/trabajadores_lista.php';
    require_once '../app/views/templates/footer.php';

    $stmt->close();
    $conn->close();
}


// Guardar cambios en el formulario asistencias
public function actualizarAsistencia() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../config/db.php';
        global $conn;

        $id = $_POST['id'];
        $entrada = $_POST['hora_entrada'];
        $salida = $_POST['hora_salida'];

        $stmt = $conn->prepare("UPDATE asistencias SET hora_entrada = ?, hora_salida = ? WHERE id = ?");
        $stmt->bind_param("ssi", $entrada, $salida, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Registro actualizado'); window.location.href='/Control_Produccion/public/EntradaController/listaAsistencias';</script>";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}

// eliminar datos del formulario asistencias
public function eliminarAsistencia($id) {
    require_once '../config/db.php';
    global $conn;

    $stmt = $conn->prepare("DELETE FROM asistencias WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Registro eliminado'); window.location.href='/Control_Produccion/public/EntradaController/listaAsistencias';</script>";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}




    // Vista asistencias por trabajador
    public function historial() {
        require_once '../app/views/entrada/asistencias.php';
    }

    // Vista Lista de productos
    public function historialProductos() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
        echo "<script>alert('Acceso denegado'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
        exit;
    }

    require_once '../config/db.php';
    global $conn;

    $query = $conn->query("SELECT tipo_producto, cantidad, fecha FROM entradas ORDER BY fecha DESC");

    require_once '../app/views/templates/header.php';
    require '../app/views/entrada/productos_lista.php';
    require_once '../app/views/templates/footer.php';

    $query->close();
    $conn->close();
}
    

    // Guardar productos en la tabla entradas
    public function guardarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../config/db.php';
            global $conn;

            $tipo = $_POST['tipo_producto'] ?? '';
            $cantidad = $_POST['cantidad'] ?? '';
            $fecha = $_POST['fecha'] ?? '';
            $hora = $_POST['hora'] ?? '';
            $fecha_completa = $fecha . ' ' . $hora;

            $stmt = $conn->prepare("INSERT INTO entradas (tipo_producto, cantidad, fecha) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $tipo, $cantidad, $fecha_completa);

            if ($stmt->execute()) {
                echo "<script>alert('Producto registrado correctamente'); window.location.href='/Control_Produccion/public/EntradaController/productos';</script>";
            } else {
                echo "Error al guardar: " . $conn->error;
            }

            $stmt->close();
            $conn->close();
        }
    }

    // Guardar asistencia de trabajadores
    public function guardarAsistencia() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../config/db.php';
            global $conn;

            $usuario_id = $_POST['usuario_id'];
            $accion = $_POST['accion'];

            $fecha_actual = date('Y-m-d');
            $hora_actual = date('H:i:s');

            if ($accion === 'entrada') {
                $stmt = $conn->prepare("INSERT INTO asistencias (usuario_id, fecha, hora_entrada) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $usuario_id, $fecha_actual, $hora_actual);
            } elseif ($accion === 'salida') {
                // Buscar última fila del día sin salida
                $buscar = $conn->prepare("SELECT id FROM asistencias WHERE usuario_id = ? AND fecha = ? AND hora_salida IS NULL ORDER BY id DESC LIMIT 1");
                $buscar->bind_param("is", $usuario_id, $fecha_actual);
                $buscar->execute();
                $resultado = $buscar->get_result();

                if ($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc();
                    $id_asistencia = $row['id'];

                    $stmt = $conn->prepare("UPDATE asistencias SET hora_salida = ? WHERE id = ?");
                    $stmt->bind_param("si", $hora_actual, $id_asistencia);
                } else {
                    echo "<script>alert('No se encontró entrada previa sin salida para hoy.'); window.location.href='/Control_Produccion/public/EntradaController/trabajadores';</script>";
                    return;
                }
            }

            if (isset($stmt) && $stmt->execute()) {
                echo "<script>alert('Registro guardado correctamente'); window.location.href='/Control_Produccion/public/EntradaController/trabajadores';</script>";
            } else {
                echo "Error: " . $conn->error;
            }

            $stmt?->close();
            $conn->close();
        }
    }
}
