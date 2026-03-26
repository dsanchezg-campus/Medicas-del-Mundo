<?php
require_once "classes/Bloque.php";
require_once "classes/Categoria.php";
require_once "classes/DB.php";
require_once "classes/Contenido.php";
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
        <aside class="subcategorias-content">
            <?php
            if (isset($_GET['page'])) {
                // obtenemos el bloque de contenido de la página
                $bloque = Bloque::getBloqueById($_GET['page']);
                // obtenemos otros bloques pertenecientes a la misma categoria y que se mostraran en el aside
                $bloques_paralelos = Bloque::getBloquesByCategoria($bloque->getIdCategoria());
                if (!empty($bloques_paralelos)) {
                    foreach ($bloques_paralelos as $bloque_paralelo) {
            ?>
            <section class="categoria-content">
                <a class="enlace-bloque-content" href="content.php?page=<?php echo $bloque_paralelo->getIdBloque(); ?>">
                    <article class="imagen-content">
                        <img src="<?php echo $bloque_paralelo->getImg(); ?>" alt="Imagen1">
                    </article>

                    <article class="testo-content">
                        <h1><?php echo $bloque_paralelo->getTituloBloque(); ?></h1>
                        <p><?php echo $bloque_paralelo->getTextoBloque(); ?></p>
                    </article>
                </a>
            </section>
            <?php
                    }
                }
            }
            ?>
            <section class="categoria-content">

                <a class="enlace-bloque-content" href="index.php?page=1">
                    <article class="imagen-content">
                        <img src="styles/img/pensando.webp" alt="Imagen1">
                    </article>

                    <article class="testo-content">
                        <h1>Titulo 1</h1>
                        <p>Parrafo de texto texto texto texto texto texto texto
                            texto texto texto texto texto texto texto texto texto texto texto texto.
                        </p>
                    </article>
                </a>
            </section>
        </aside>

        <section class="contenedor-contenido">
            <?php
            if (isset($_GET['page'])) {
                $bloque = Bloque::getBloqueById($_GET['page']);
                //obtenemos los contenidos extra del bloque
                $contenidos = Contenido::getContenidoByBloque($bloque->getIdBloque());
            ?>
            <article class="titulo">
                <h1><?php echo $bloque->getTituloBloque();?></h1>
            </article>
            <article class="parrafo">
                <p><?php echo $bloque->getTextoBloque();?></p>
            </article>
                <?php
                foreach ($contenidos as $contenido) {
                    ?>
            <article class="enlace">
                <img src="<?php echo $contenido->getUrl(); ?>" alt="<?php echo $contenido->getDescripcion(); ?>">
            </article>
            <?php
                }
            }
            ?>
        <section>

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
        </section>
    </footer>
    <a href="index.php" class="volver-inicio"><img src="styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>