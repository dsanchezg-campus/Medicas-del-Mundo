<?php
// Incluir las clases necesarias para gestionar categorías, bloques y base de datos
require_once "classes/Usuario.php";
require_once "classes/Contenido.php";
require_once "classes/Categoria.php";
require_once "classes/Faq.php";
require_once "classes/Bloque.php";
?>
<!doctype html>
<!-- Página principal del sitio web de Médicos del Mundo, muestra categorías y contenido -->
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
<?php
include_once "header.php";
?>
    <main>
        <?php
        if (isset($_GET['page'])){
        $categoria_actual = Categoria::getCategoriaById($_GET['page']);
        ?>
        <section class="titulo-section"><a href="index.php<?= $categoria_actual->getIdMadre() ? "?page=".$categoria_actual->getIdMadre(): null; ?>">
                ⮌ Volver atrás</a>
            <h1 class="titulo-page"><?= $categoria_actual->getNombre(); ?></h1>
            <a href="FaQ.php?categoria=<?= $_GET['page'];?>" class="faq-variable">
                <span class="faq-link">?</span>
                <span class="faq-link-hover">Preguntas Frecuentes</span>
            </a></section>
        <?php
    }
    ?>
    <!-- Contenido principal: muestra categorías o subcategorías y bloques de contenido según el parámetro 'page' -->

        <?php
        // Manejo de excepciones para errores de base de datos
        try {
            // Verificar si se ha pasado un parámetro 'page' en la URL para mostrar subcategorías o categorías raíz
            if (isset($_GET['page'])){
                // Obtener subcategorías de la categoría padre especificada por 'page'
                $subcategorias = Categoria::getSubcategorias($_GET['page']);
                // Iterar sobre cada subcategoría y mostrarla como una sección
                foreach ($subcategorias as $subcategoria) {
        ?>
        <section class="categoria">
            <a class="enlace-bloque" href="index.php?page=<?php echo $subcategoria->getIdCategoria(); ?>">
                <article class="imagen-categoria">
                    <img src="styles/img/<?php echo $subcategoria->getImg(); ?>" alt="Imagen1">
                </article>
                <article class="testo-categoria">
                    <h1><?php echo $subcategoria->getNombre(); ?></h1>
                    <p><?php echo $subcategoria->getDescripcion(); ?></p>
                </article>
            </a>
        </section>
        <?php
            }
        } else {
                // Si no hay parámetro 'page', mostrar todas las categorías raíz (padres)
                $categorias = Categoria::getCategorias();
                // Iterar sobre cada categoría raíz y mostrarla
                foreach ($categorias as $categoria) {
        ?>
        <section class="categoria">
            <a class="enlace-bloque" href="index.php?page=<?php echo $categoria->getIdcategoria(); ?>">
                <article class="imagen-categoria">
                    <img src="styles/img/<?php echo $categoria->getImg(); ?>" alt="Imagen1">
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
            // Capturar y mostrar errores de conexión o consultas a la base de datos
            echo $e->getMessage();
        }
        ?>
        <?php
        // Si hay parámetro 'page', mostrar los bloques de contenido de esa categoría
        if (isset($_GET['page'])){
            // Obtener bloques de contenido asociados a la categoría especificada
            $contenidos = Bloque::getBloquesByCategoria($_GET['page']);
            // Iniciar contenedor para los bloques
            echo "<section class='contenedor'>";
            // Iterar sobre cada bloque y mostrarlo
            foreach ($contenidos as $contenido) {
        ?>

        <section class="contenido-bloque">
            <a class="enlace-bloque" href="content.php?page=<?php echo $contenido->getIdBloque(); ?>">
                <article class="imagen-contenido">
                    <img src="styles/img/<?= $contenido->getIcono(); ?>" alt="Imagen1">
                </article>
                <article class="testo-contenido">
                    <h1><?php echo $contenido->getTituloBloque(); ?></h1>
                    <p><?php echo $contenido->getDescripcionBloque(); ?></p>
                </article>
            </a>
        </section>
        
        <?php
            }
            // Cerrar el contenedor de bloques
            echo "</section>";
            // Enlace para volver al inicio (categorías raíz)
            echo "<a href='index.php' class='volver-inicio'><img src='styles/img/casita.png' alt='regresa a inicio'></a>";
        }
        ?>
    </main>
<!-- Pie de página con información de contacto de Médicos del Mundo -->
    <?php require_once "footer.php"; ?>
</body>
</html>