<?php
class MermasController {
    public function index() {
        require_once '../app/views/mermas/index.php';
    }

    public function crear() {
        require_once '../app/views/mermas/crear.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../config/db.php';
            global $conn;

            $producto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];
            $motivo = $_POST['motivo'];

            $stmt = $conn->prepare("INSERT INTO mermas (producto, cantidad, motivo, fecha) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sis", $producto, $cantidad, $motivo);

            if ($stmt->execute()) {
                echo "<script>alert('Merma registrada correctamente'); window.location.href='/Control_Produccion/public/MermasController/crear';</script>";
            } else {
                echo "Error: " . $conn->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
}
