<?php
// Incluir clases necesarias para usuario y base de datos
require_once "classes/Usuario.php";
require_once "classes/DB.php";

session_start();
// para cuando te redirijan para cerrar la sesion, elimina la sesión
Usuario::CerrarSesion();
// Verificar si se envió el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usuario"], $_POST["password"])) {
    $usuario = htmlspecialchars($_POST["usuario"]);
    $password = htmlspecialchars($_POST["password"]);
    // Intentar iniciar sesión con las credenciales proporcionadas
    // Guarda la usuaria en SESSION['usuaria']
    if (Usuario::InicioSesion($usuario, $password)){
        // Redirigir a la página según el rol del usuario
        header("Location:".$_SESSION['usuaria']->getRol().".php");
        exit;
    } else{
        // Mostrar mensaje de error si las credenciales son incorrectas
        $error = "Credenciales incorrectas";
    }
}
?>
<!DOCTYPE html>
<!-- Página de inicio de sesión para usuarios -->
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
<!-- Cabecera con logo y barra de búsqueda -->
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
<!-- Contenido principal con formulario de login -->
    <main class="login-container">
        <article class="login-section">
            <img src="" alt="Poner aqui cualquier imagen que apetezca">
        </article>
        <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
        <?php if (isset($error)){ ?>
        <article class="login-box">
            <article class="mensaje_error"><?php echo $error;?> </article>
        </article>
        <?php } ?>
        <!-- Formulario de inicio de sesión -->
        <form action="" method="post">
         <h1>Inicio de sesión</h1>
            <article class="form-usuario">
                <label for="usuario">Usuaria: </label>
                <input type="text" id="usuario" name="usuario" required>
            </article>
            <article class="form-password">
                <label for="password">Contraseña: </label>
                <input type="password" id="password" name="password" required>
            </article>
            <article class="boton-login">
                <button type="submit" class="input-login">LOGIN</button>
            </article>
        </form>
    </main>
<!-- Pie de página con información de contacto -->
    <footer>
        <section class="footer-section">
            <h2>Médicos del Mundo España</h2>
            <p>Conde de Vilches, 15 · 28028, Madrid</p>
            <p>Lunes a viernes: 8:00 - 20:00</p>
            <p>
                Tel: <a href="tel:+34915436033">91 543 60 33</a> ·
                Email: <a href="mailto:informacion@medicosdelmundo.org">informacion@medicosdelmundo.org</a>
            </p>
            <p><a href="login.php">Iniciar Sesión</a></p>
        </section>
    </footer>
<!-- Enlace para volver al inicio -->
    <a href="index.php" class="volver-inicio"><img src="styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>
