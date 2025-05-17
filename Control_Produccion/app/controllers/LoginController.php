<?php
class LoginController {
    public function index() {
        require_once '../app/views/login/index.php';
    }

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../config/db.php';
            global $conn;

            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];

            $stmt = $conn->prepare("SELECT * FROM trabajadores WHERE correo = ?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows === 1) {
                $usuario = $resultado->fetch_assoc();

                // Contraseña sin cifrado
                if ($contrasena === $usuario['contraseña']) {
                    session_start();
                    $_SESSION['usuario'] = [
                        'id' => $usuario['id'],
                        'nombre' => $usuario['nombre'],
                        'rol' => $usuario['rol']
                    ];

                    if ($usuario['rol'] === 'administrador') {
                        header("Location: /Control_Produccion/public/HomeController/administrador");
                    } else {
                        header("Location: /Control_Produccion/public/HomeController/trabajador");
                    }
                    exit;
                }
            }

            echo "<script>alert('Credenciales incorrectas'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /Control_Produccion/public/LoginController/index");
        exit;
    }
}
