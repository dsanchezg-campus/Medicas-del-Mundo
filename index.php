<?php
require_once "Classes/Categoria.php";
require_once "Classes/Conexion.php";
$db = new Conexion();
$conn = $db->conectar();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
    <main>
        <?php
        try {
        if (isset($_GET['page'])){
            $subcategorias = Categoria::getSubcategorias($conn, $_GET['page']);
            foreach ($subcategorias as $subcategoria) {
        ?>
        <section class="categoria">
            <a class="enlace-bloque" href="index.php?page=<?php $subcategoria->getIdCategoria(); ?>">
                <article class="imagen-categoria">
                    <img src="<?php $subcategoria->getImg(); ?>>" alt="Imagen1">
                </article>
                <article class="testo-categoria">
                    <h1><?php $subcategoria->getNombre(); ?></h1>
                    <p><?php $subcategoria->getDescripcion(); ?></p>
                </article>
            </a>
        </section>
        <?php
            }
        } else {
            $categorias = Categoria::getCategorias($conn);
            foreach ($categorias as $categoria) {
        ?>
        <section class="categoria">
            <a class="enlace-bloque" href="index.php?page=<?php echo $categoria->getIdcategoria(); ?>">
                <article class="imagen-categoria">
                    <img src="<?php echo $categoria->getImg(); ?>" alt="Imagen1">
                </article>
                <article class="testo-categoria">
                    <h1><?php echo $categoria->getNombre(); ?></h1>
                    <p><?php echo $categoria->getDescripcion(); ?></p>
                </article>
            </a>
        </section>
        <?php
            }
        }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
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

