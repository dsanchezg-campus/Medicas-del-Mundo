<?php
// Incluir las clases necesarias para gestionar categorías, bloques y base de datos
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

session_start();
// CONTROL DE ACCESO ADMIN
// Si no tiene permisos, redirige a la página principal
require_once "../controladores/control_admin.php";

?>
<!doctype html>
<html lang="es">
<head>
    <!-- Definir codificación de caracteres UTF-8 -->
    <meta charset="UTF-8">
    <!-- Configuración de viewport para responsividad -->
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Compatibilidad con versiones antiguas de Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Incluir CSS personalizado -->
    <link rel="stylesheet" href="../styles/style.css">
    <title>Bienvenidas</title>
    <!-- Favicon de la página -->
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.medicosdelmundo.org/app/themes/mdm/library/medias/favicon/favicon-32x32.png">
</head>
<body>
<!-- Encabezado con navegación -->
<?php
require_once "../header.php";
?>
<!-- Contenido principal -->
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
    <!-- Mostrar categorías o subcategorías según el parámetro 'page' -->
    <section class="contenedor">
    <?php
    try {
        // Si se envió el parámetro 'page', mostrar subcategorías de esa categoría
        if (isset($_GET['page'])){
            $subcategorias = Categoria::getSubcategorias($_GET['page']);
            // Iterar sobre cada subcategoría y mostrarla
            foreach ($subcategorias as $subcategoria) {
                ?>
                <section class="categoria">
                    <!-- Botón para editar la categoría -->
                    <a href="editar_categoria.php?page=<?php echo $subcategoria->getIdcategoria(); ?>" class="boton-editar"><img src="../styles/img/lapiz.png" alt="Editar" class="boton-editar-img"></a>
                    <!-- Botón para eliminar la categoría -->
                    <a href="/Medicas-del-Mundo/controladores/eliminar_categoria.php?categoria=<?php echo $subcategoria->getIdcategoria(); ?>" class="boton-eliminar" onclick="return confirm('¿Estás segura de eliminar esta Categoría?');"><img src="../styles/img/basura.png" alt="Eliminar" class="boton-eliminar-img"></a>
                    <!-- Enlace para ver subcategorías dentro de esta categoría -->
                    <a class="enlace-bloque" href="index.php?page=<?php echo $subcategoria->getIdCategoria(); ?>">
                        <!-- Imagen de la categoría -->
                        <article class="imagen-categoria">
                            <img src="../styles/img/<?php echo $subcategoria->getImg(); ?>" alt="Imagen1">
                        </article>
                        <!-- Nombre y descripción de la categoría -->
                        <article class="testo-categoria">
                            <h1><?php echo $subcategoria->getNombre(); ?></h1>
                            <p><?php echo $subcategoria->getDescripcion(); ?></p>
                        </article>
                    </a>
                </section>
                
                <?php
            }
        } else {
            // Si no se envió 'page', mostrar todas las categorías principales
            $categorias = Categoria::getCategorias();
            // Iterar sobre cada categoría y mostrarla
            foreach ($categorias as $categoria) {
                ?>
                <section class="categoria">
                    <!-- Botón para editar la categoría -->
                    <a href="editar_categoria.php?page=<?php echo $categoria->getIdcategoria(); ?>" class="boton-editar"><img src="../styles/img/lapiz.png" alt="Editar" class="boton-editar-img"></a>
                    <!-- Botón para eliminar la categoría -->
                    <a href="/Medicas-del-Mundo/controladores/eliminar_categoria.php?categoria=<?php echo $categoria->getIdcategoria(); ?>" class="boton-eliminar" onclick="return confirm('¿Estás segura de eliminar esta Categoría?');"><img src="../styles/img/basura.png" alt="Eliminar" class="boton-eliminar-img"></a>
                    <!-- Enlace para ver subcategorías dentro de esta categoría -->
                    <a class="enlace-bloque" href="index.php?page=<?php echo $categoria->getIdcategoria(); ?>">
                        <!-- Imagen de la categoría -->
                        <article class="imagen-categoria">
                            <img src="<?php echo "../styles/img/".$categoria->getImg(); ?>" alt="Imagen1">
                        </article>
                        <!-- Nombre y descripción de la categoría -->
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
        // Si ocurre un error en la base de datos, capturarlo y mostrarlo
        echo $e->getMessage();
    }
    ?>
        <!-- Botón flotante para crear una nueva categoría -->
        <section class="crear-categoria">
            <a class="enlace-crear-categoria" href="anadir_categoria.php?page=<?= $_GET['page'] ?? null; ?>">
                <article class="testo-crear-categoria tamaño-variable">
                    <h1>+</h1>
                    <h3>Añadir Categoria</h3>
                </article>
            </a>
        </section>

    </section>

    <!-- Si se seleccionó una categoría, mostrar su contenido/bloques -->
    <?php
    if (isset($_GET['page'])){
        // Obtener todos los bloques que pertenecen a la categoría seleccionada
        $contenidos = Bloque::getBloquesByCategoria($_GET['page']);
        echo "<section class='contenedor'>";
        // Iterar sobre cada bloque de contenido
        foreach ($contenidos as $contenido) {
            ?>

            <section class="contenido-bloque">
                <!-- Botón para editar el contenido -->
                <a href="editar_contenido.php?page=<?php echo $contenido->getIdBloque(); ?>" class="boton-editar"><img src="../styles/img/lapiz.png" alt="Editar" class="boton-editar-img"></a>
                <!-- Botón para eliminar el contenido -->
                <a href="/Medicas-del-Mundo/controladores/eliminar_categoria.php?contenido=<?php echo $contenido->getIdBloque(); ?>" class="boton-eliminar" onclick="return confirm('¿Estás segura de eliminar este Contenido?');"><img src="../styles/img/basura.png" alt="Eliminar" class="boton-eliminar-img"></a>
                <!-- Enlace para ver el contenido completo del bloque -->
                <a class="enlace-bloque" href="content.php?page=<?php echo $contenido->getIdBloque(); ?>">
                    <!-- Imagen asociada al bloque (actualmente vacía) -->
                    <article class="imagen-contenido">
                        <img src="../styles/img/<?php  echo $contenido->getIcono(); ?>" alt="Imagen1">
                    </article>
                    <!-- Título y descripción del bloque -->
                    <article class="testo-contenido">
                        <h1><?php echo $contenido->getTituloBloque(); ?></h1>
                        <p><?php echo $contenido->getDescripcionBloque(); ?></p>
                    </article>
                </a>
            </section>
            <?php
        }
        ?>
        <!-- Añadir Contenido ubicado dentro del contenedor flex para alinearse con los otros -->
        <section class="anadir-contenido">
            <!-- Se añade el id de la categoría para preestablecerla en el select de añadir -->
            <a class="enlace-crear-categoria" href="anadir_contenido.php?page=<?php echo $_GET['page']; ?>">
                <article class="testo-crear-categoria tamaño-variable">
                    <h1>+</h1>
                    <h3>Añadir Contenido</h3>
                </article>
            </a>
        </section>
        <?php
        echo "</section>";
    }
    ?>
    <!-- Boton de regreso a inicio-->
    <a href='index.php' class='volver-inicio'><img src='/styles/img/casita.png' alt='regresa a inicio'></a>
</main>
<!-- Pie de página con información de contacto -->
<footer>
    <section class="footer-section">
        <!-- Nombre de la organización -->
        <h2>Médicos del Mundo España</h2>
        <!-- Dirección -->
        <p>Conde de Vilches, 15 · 28028, Madrid</p>
        <!-- Horarios -->
        <p>Lunes a viernes: 8:00 - 20:00</p>
        <!-- Información de contacto: teléfono y email -->
        <p>
            Tel: <a href="tel:+34915436033">91 543 60 33</a> ·
            Email: <a href="mailto:informacion@medicosdelmundo.org">informacion@medicosdelmundo.org</a>
        </p>
        <!-- Enlace para cerrar sesión -->
        <p><a href="../controladores/cerrar_sesion.php">Cerrar Sesión</a></p>
    </section>
</footer>
</body>
</html>



