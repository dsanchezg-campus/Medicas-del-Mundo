<?php
require_once "classes/Usuario.php";
require_once "classes/Conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usuario"], $_POST["password"])) {
    session_start();
    $db = new Conexion();
    $conn = $db->conectar();
    if (Usuario::InicioSesion($_POST['usuario'], $_POST['password'], $db)){
        header("Location:".$_SESSION['usuaria']->getRol().".php");
    } else{
        $error = "Credenciales incorrectas";
    }
}
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
    <main class="login-container">
        <article class="login-section">
            <img src="" alt="Poner aqui cualquier imagen que apetezca">
        </article>
        <?php if (isset($error)){ ?>
        <article class="login-box">
            <article class="mensaje_error"><?php echo $error;?> </article>
        </article>
        <?php } ?>
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
    <a href="index.php" class="volver-inicio"><img src="styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>
