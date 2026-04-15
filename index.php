<?php
// Incluir las clases necesarias para manejar categorías, base de datos y bloques de contenido

require_once "Classes/Categoria.php";
require_once "Classes/DB.php";
require_once "Classes/Bloque.php";
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
<!-- Cabecera del sitio con logo, título y barra de búsqueda -->
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
                    <img src="<?php echo $subcategoria->getImg(); ?>" alt="Imagen1">
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
                    <img src="<?php  ?>" alt="Imagen1">
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