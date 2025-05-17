<?php require_once '../app/views/templates/header.php'; ?>


<section class="login-container">
    <div class="login-box">
        <h2>Centro de Producción</h2>
        <form action="/Control_Produccion/public/LoginController/autenticar" method="POST">
            <label for="correo">Correo</label>
            <input type="email" name="correo" placeholder="ejemplo@correo.com" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" placeholder="••••••••" required>

            <button type="submit" class="boton-login">Iniciar Sesión</button>
        </form>
    </div>
</section>

<?php require_once '../app/views/templates/footer.php'; ?>
