<?php
// Incluir todas las clases necesarias para el funcionamiento del módulo
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

// Validación comentada: Verificar si el usuario actual tiene permisos de editora
// Si no tiene permisos, redirige a la página principal
// if (!$_SESSION["usuaria"]->controlUsuarioEditora) {
//     header("location: ../index.php");
//     exit();
// }

// Verificar si se envió un formulario por POST con los datos de la categoría
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["nombre"], $_POST["descripcion"])) {
    // Crear una nueva instancia de Categoria con los datos del formulario
    $cat = new Categoria( $_POST["id_categoria"] ,$_POST["nombre"], $_POST["descripcion"], $_POST["prioridad"], $_POST["img"], $_POST["id_categoria"] ?? null, $_POST["fecha_actualizacion"]);
    try {
        // Intentar insertar la categoría en la base de datos
        $cat->InsertarCategoria();
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
    <!-- Formulario para agregar una nueva categoría -->
    <article class="anadir-categoria">
        <form action="" method="post" class="form-anadir">
            <!-- Campo oculto para identificar la acción del formulario -->
            <input type="hidden" name="action" value="categoria">

            <!-- Campo de nombre -->
            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre" required>

            <!-- Campo de descripción -->
            <label for="descripcion">Descripcion: </label>
            <input type="text" id="descripcion" name="descripcion" required>

            <!-- Campo de orden (posición de la categoría) -->
            <label for="orden">Orden: </label>
            <input type="number" id="orden" name="orden" required>

            <!-- Campo para subir imagen -->
            <label for="img">Imagen: </label>
            <input type="file" id="img" name="img" accept="image/*" required>

            <!-- Selector para elegir categoría padre (si es subcategoría) -->
            <label for="id_categoria">Pertenece a la categoria: </label>
            <select name="id_categoria" id="id_categoria">
                <option value="">Ninguna</option>
                <?php
                // Obtener todas las categorías y mostrarlas en el selector
                $categorias = Categoria::getCategorias();
                foreach ($categorias as $categoria) {
                    echo "<option value='" . $categoria->getIdCategoria() . "'>" . $categoria->getNombre() . "</option>";
                }
                ?>
            </select>

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
<!-- Botón flotante para regresar al inicio -->
<a href="../admin/index.php" class="volver-inicio"><img src="../styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>
