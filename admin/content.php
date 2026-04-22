<?php
// Incluir clases necesarias para bloques, categorías, base de datos y contenido externo
require_once "../classes/Bloque.php";
require_once "../classes/Categoria.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
?>
<!-- Página para mostrar el contenido detallado de un bloque específico -->
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Bienvenidas</title>
    <link rel="icon" type="../image/png" sizes="32x32" href="https://www.medicosdelmundo.org/app/themes/mdm/library/medias/favicon/favicon-32x32.png">
</head>
<body>
<!-- Cabecera con logo y barra de búsqueda -->
<?php
require_once "../header.php";
?>
<!-- Contenido principal dividido en aside para bloques relacionados y sección para el contenido detallado -->
    <main>
        <aside class="subcategorias-content">
            
            <?php
            // Verificar si se ha especificado un bloque por parámetro 'page'
            if (isset($_GET['page'])) {
                // obtenemos el bloque de contenido de la página
                $bloque = Bloque::getBloqueById($_GET['page']);
                // obtenemos otros bloques pertenecientes a la misma categoria y que se mostraran en el aside
                $bloques_paralelos = Bloque::getBloquesByCategoria($bloque->getIdCategoria());
                // Iterar sobre los bloques paralelos y mostrarlos
                foreach ($bloques_paralelos as $bloque_paralelo) {
            ?>
            <section class="categoria-content">
                <a class="enlace-bloque-content" href="content.php?page=<?php echo $bloque_paralelo->getIdBloque(); ?>">
                    <article class="imagen-content">
                        <img src="<?php echo $bloque_paralelo->getIcono(); ?>" alt="Imagen1">
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
            ?>
        </aside>

        <!-- Sección principal con el contenido detallado del bloque -->
        <section class="contenedor-contenido">
            
            <?php
            // Mostrar contenido si hay parámetro 'page'
            if (isset($_GET['page'])) {
                // Obtener el bloque nuevamente (podría optimizarse)
                $bloque = Bloque::getBloqueById($_GET['page']);
                // Obtener contenidos extra asociados al bloque
                $contenidos = Contenido::getContenidoByBloque($bloque->getIdBloque());
            ?>
            <article class="titulo">
                <h1><?php echo $bloque->getTituloBloque();?></h1>
            </article>
            <article class="parrafo">
                <?php
                $texto = $bloque->getTextoBloque();
                $parrafos = preg_split("/\r\n/", $texto);
                foreach ($parrafos as $parrafo) {
                    if ($parrafo != "") {
                        echo "<p>" . htmlspecialchars($parrafo) . "</p>";
                    } else {
                        echo "<br>";
                    }

                }
                ?>
            </article>
                <?php
                // Iterar sobre los contenidos extra y mostrarlos como enlaces o imágenes
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
        </section>
    </footer>
    <a href="index.php" class="volver-inicio"><img src="../styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>