<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Bienvenidas - Editar Contenido</title>
    <link rel="icon" type="../styles/img/logo.png" sizes="32x32" href="../styles/img/logo.png">
</head>
<body>
<?php
require_once "../header.php";
?>
<main>
    <?php
    if (isset($error)) {
        ?>
        <article class="error">
            <p class="error-p"><?php echo htmlspecialchars($error); ?></p>
        </article>
        <?php
    }
    ?>
    <article class="anadir-contenido">
        <form action="" method="post" class="form-anadir">
                <?php
                $usuaria = Usuario::getUsuaria($_GET["id_usuario"]);
                ?>

            <label for="nombre"><?php echo $usuaria->getRol().": ". $usuaria->getNombre(); ?> </label>
            <input type="text" id="nombre" name="nombre" placeholder="Cambiar Nombre">

            <label for="email">Email: <?php echo $usuaria->getEmail();?> </label>
            <input type="text" id="email" name="email" placeholder="Cambiar Email" accept="%@email.com">

            <label for="password">Cambiar contraseña: </label>
            <input type="password" id="password" name="password[]" placeholder="Introduzca nueva contraseña">
            <input type="password" id="password" name="password[]" placeholder="Repite la contraseña">
            <button type="submit">Editar usuaria</button>
        </form>
    </article>
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
<a href="../admin/index.php" class="volver-inicio"><img src="../styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>