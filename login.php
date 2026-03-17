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
    <header>
        <ul class="lista-nav">
            <li class="linea-nav">
                <article class="logo">
                    <a href="https://www.medicosdelmundo.org/" class="enlace-medicos">
                        <img src="styles/img/logo.png" alt="logo">
                    </a>
                </article>
            </li>
            <li class="linea-nav">
                <h1>Bienvenida</h1>
            </li>
            <li class="linea-nav">
                <form method="POST" action="" class="form-cabecera">
                    <input type="text" class="input-nav" placeholder="Buscar">
                    <input type="submit" class="boton-invisible" value="Buscar">
                </form>
            </li>
        </ul>
    </header>
    <main class="login_container">
        <article class="login_section">
    <!--        Poner aqui cualquier imagen que apetezca-->
        </article>
        <article class="login_box">
            <?php if (isset($mensaje_error)): ?>
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
    </main>
    <footer>
        <section class="footer-section">
            <h2>Médicos del Mundo España</h2>
            <p>Conde de Vilches, 15 · 28028, Madrid</p>
            <p>Lunes a viernes: 8:00 - 20:00</p>
            <p>
                Tel: <a href="tel:+34915436033">91 543 60 33</a> ·
                Email: <a href="mailto:informacion@medicosdelmundo.org">informacion@medicosdelmundo.org</a>
            </p>
            <p><a href="login.php">Iniciar Sesion</a></p>
        </section>
    </footer>
</body>
</html>
