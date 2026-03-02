<?php
$mensaje_error = isset($_POST['mensaje_error']) ? $_POST['mensaje_error'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<section class="login_container">
    <article class="login_section">
<!--        Poner aqui cualquier imagen que apetecca-->
    </article>
    <article class="login_box">
        <?php if (isset($mensaje_error)): ?>}
        <article class="mensaje_error"><?php echo htmlspecialchars($mensaje_error);?> </article>
        <?php endif; ?>
    </article>
    <form action="inicio_sesion.php" method="post">
     <h3>Inicio de sesion</h3>
        <article class="form_usuario">
            <label for="usuario">Usuario:</label>
            <input type="texo" id="usuario" name="usuario" required>
        </article>
        <article class="form_password">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </article>
        <article class="boton_login">
            <button type="submit">Login</button>
        </article>
    </form>
</section>
</body>
</html>
