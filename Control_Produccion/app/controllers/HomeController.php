<?php
class HomeController {
    public function administrador() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
            echo "<script>alert('Acceso denegado'); window.location.href='/Control_Produccion/public/LoginController/index';</script>";
            exit;
        }

        require_once '../app/views/templates/header.php';
        require_once '../app/views/home/admin.php';
        require_once '../app/views/templates/footer.php';
    }

    public function trabajador() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'trabajador') {
            header("Location: /Control_Produccion/public/LoginController/index");
            exit;
        }
    
        require_once '../app/views/templates/header.php';
        require_once '../app/views/home/trabajador.php';
        require_once '../app/views/templates/footer.php';
    }
    
    public function index() {
        // Redirecciona siempre al login
        header("Location: /Control_Produccion/public/LoginController/index");
        exit;
    }
    

}
