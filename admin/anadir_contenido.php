<?php
// Incluir todas las clases necesarias para el funcionamiento del módulo
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

// Validación: Verificar si el usuario actual tiene permisos de editora
// Si no tiene permisos, redirige a la página principal
if (!$_SESSION["usuaria"]->controlUsuarioEditora) {
    header("location: ../index.php");
    exit();
}
// Verificar si se envió un formulario por POST con los datos del contenido
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["nombre"], $_POST["descripcion"])) {
    // Crear una nueva instancia de Contenido con los datos del formulario
    $cat = new Contenido($_POST["nombre"], $_POST["descripcion"]);
    try {
        // Intentar insertar el contenido en la base de datos
        $cat->InsertarContenido();
    } catch (Exception $e){
        // Si ocurre un error, capturarlo y almacenarlo en la variable $error
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Definir codificación de caracteres UTF-8 -->
    <meta charset="UTF-8">
    <!-- Configuración de viewport para responsividad -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Compatibilidad con versiones antiguas de Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Incluir CSS personalizado -->
    <link rel="stylesheet" href="../styles/style.css">
    <title>Bienvenidas</title>
    <!-- Favicon de la página -->
    <link rel="icon" type="../styles/img/logo.png" sizes="32x32" href="../styles/img/logo.png">
</head>
<body>
<!-- Encabezado con navegación -->
<?php
require_once "../header.php";
?>
<!-- Contenido principal -->
<main>
    <!-- Mostrar mensaje de error si existe -->
    <?php
    if (isset($error)) {
        ?>
        <article class="error">
            <p class="error-p"><?php echo $error; ?></p>
        </article>
        <?php
    }
    ?>
    <!-- Formulario para agregar una nueva categoría más simple -->
    <article class="anadir-categoria">
        <form action="" method="post" class="form-anadir">
            <!-- Campo oculto para identificar la acción como 'categoria' -->
            <input type="hidden" name="action" value="categoria">
            <!-- Campo de nombre -->
            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre" required>
            <!-- Botón para enviar el formulario -->
            <button type="submit">Añadir</button>
        </form>
    </article>
    <!-- Formulario para agregar contenido/bloques -->
    <article class="anadir-contenido">
        <form action="" method="post" class="form-anadir">
            <!-- Campo oculto para identificar la acción como 'contenido' -->
            <input type="hidden" name="action" value="contenido">
            <!-- Campo de título -->
            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" name="titulo" required>
            <!-- Campo de descripción -->
            <label for="descripcion">Descripcion: </label>
            <input type="text" id="descripcion" name="descripcion" required>
            <!-- Campo de texto/contenido principal -->
            <label for="texto">Texto: </label>
            <input type="text" id="texto" name="texto" required>
            <!-- Selector para elegir la categoría a la que pertenece este contenido -->
            <label for="id_categoria">Pertenece a la categoria: </label>
            <select name="id_categoria" id="id_categoria">
                <?php
                // Obtener todas las categorías y mostrarlas en el selector
                $categorias = Categoria::getCategorias();
                foreach ($categorias as $categoria) {
                    echo "<option value='" . $categoria->getIdCategoria() . "'>" . $categoria->getNombre() . "</option>";
                }
                ?>
            </select><br>
            <!-- Campo de prioridad -->
            <label for="prioridad">Prioridad: </label>
            <input type="number" id="prioridad" name="prioridad" required>
            <!-- Campo de fecha de actualización -->
            <label for="fecha_actualizacion">Fecha Actualizacion: </label>
            <input type="date" id="fecha_actualizacion" name="fecha_actualizacion" required>
            <!-- Botón para enviar el formulario -->
            <button type="submit">Añadir</button>
        </form>
    </article>
</main>
<!-- Procesamiento de formularios POST después de mostrar la página -->
<?php
// Verificar si se envió un formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    // Si la acción es 'contenido', crear un nuevo bloque
    if ($_POST['action'] === 'contenido') {
        // Crear instancia de Bloque con los datos del formulario
        $bloque = new Bloque(null, $_POST['prioridad'], $_POST['titulo'], $_POST['descripcion'], $_POST['texto'], null, $_POST['fecha_actualizacion'], $_POST['id_categoria']);
        // Guardar el bloque en la base de datos
        $bloque->CrearBloque();
        // Si la acción es 'categoria', crear una nueva categoría
    } elseif ($_POST['action'] === 'categoria') {
        // Crear instancia de Categoria con los datos del formulario
        $categoria = new Categoria(null, $_POST['nombre'], '', 0, '', null, date("Y-m-d H:i:s"));
        // Guardar la categoría en la base de datos
        $categoria->InsertarCategoria();
    }
}
?>
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
        <!-- Enlace a inicio de sesión -->
        <p><a href="login.php">Iniciar Sesion</a></p>
    </section>
</footer>
<!-- Enlace a inicio de sesión -->
<a href="../admin/index.php" class="volver-inicio"><img src="../styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>
