<?php

class ConsultasController {
    public function index() {
        require_once '../app/views/templates/header.php';
        echo "<h2>Consultas y reportes</h2>";
        require_once '../app/views/templates/footer.php';
    }
}
