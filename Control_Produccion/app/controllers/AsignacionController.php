<?php
class AsignacionController {
    public function index() {
        require_once '../app/views/asignacion/index.php';
    }

    public function crear() {
        require_once '../app/views/asignacion/crear.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../config/db.php';
            global $conn;

            $trabajador_id = $_POST['trabajador_id'];
            $tarea = $_POST['tarea'];
            $fecha_asignacion = $_POST['fecha_asignacion']; 

            $stmt = $conn->prepare("INSERT INTO asignaciones (trabajador_id, tarea, fecha_asignacion) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $trabajador_id, $tarea, $fecha_asignacion);


            if ($stmt->execute()) {
                echo "<script>alert('Tarea asignada'); window.location.href='/Control_Produccion/public/AsignacionController/crear';</script>";
            } else {
                echo "Error: " . $conn->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
}
