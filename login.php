<?php
$mensaje_error = isset($_POST['mensaje_error']) ? $_POST['mensaje_error'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/style.css">
    <title>Bienvenidas</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.medicosdelmundo.org/app/themes/mdm/library/medias/favicon/favicon-32x32.png">
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
     <h1>Inicio de sesion</h1>
        <article class="form_usuario">
            <label for="usuario">Usuario:</label>
            <input type="texto" id="usuario" name="usuario" required>
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
