<?php
class InformesController {
    public function index() {
        require_once '../app/views/informes/index.php';
    }

    public function crear() {
        require_once '../app/views/informes/crear.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../config/db.php';
            global $conn;

            $trabajador_id = $_POST['trabajador_id'];
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];

            $stmt = $conn->prepare("INSERT INTO informes (trabajador_id, titulo, contenido) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $trabajador_id, $titulo, $contenido);

            if ($stmt->execute()) {
                echo "<script>alert('Informe registrado correctamente'); window.location.href='/Control_Produccion/public/InformesController/crear';</script>";
            } else {
                echo "Error: " . $conn->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
}
