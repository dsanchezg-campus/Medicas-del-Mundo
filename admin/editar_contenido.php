<?php
// 1. IMPORTACIÓN DE DEPENDENCIAS
// Se incluyen las clases necesarias para trabajar con la base de datos y los objetos del dominio.
// 'require_once' asegura que el archivo se incluya solo una vez, evitando errores de re-declaración.
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

// 2. INICIO DE SESIÓN
session_start();

// 3. CONTROL DE ACCESO (Actualmente comentado)
// if (!$_SESSION["usuaria"]->controlUsuarioEditora) {
//     header("location: ../index.php"); // Redirige al inicio si no tiene permisos
//     exit(); // Detiene la ejecución del script por seguridad
// }

// 4. INICIALIZACIÓN DE VARIABLES
$error = null; // Guardará los mensajes de error si la actualización falla.
$bloque = null; // Guardará el objeto Bloque que vamos a editar.

// 5. CARGA DE DATOS (METODO GET)
// Si la URL contiene '?page=X', se busca ese bloque en la base de datos.
if (isset($_GET['page'])) {
    $bloque = Bloque::getBloqueById($_GET['page']);
}

// 6. PROCESAMIENTO DEL FORMULARIO (METODO POST)
// Verifica si se ha enviado el formulario por POST y si la acción es "contenido".
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["action"]) && $_POST["action"] == "contenido") {
    try {
        // Se recogen todos los datos enviados por el usuario desde el formulario.
        // MEJORA: Faltaría sanear o validar estos datos (trim, filtros) antes de usarlos.
        $id_bloque = $_POST['id_bloque'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $texto = $_POST['texto'];
        $prioridad = $_POST['prioridad'];
        $id_categoria = $_POST['id_categoria'];
        $fecha_actualizacion = $_POST['fecha_actualizacion'];

        // Se instancia un nuevo objeto Bloque con los datos actualizados.
        $bloqueEditado = new Bloque($id_bloque, $prioridad, $titulo, $descripcion, $texto, null, $fecha_actualizacion, $id_categoria, null);

        // Se llama al metodo que ejecuta la consulta UPDATE en la base de datos.
        $bloqueEditado->ActualizarBloque();

        // Si odo sale bien, redirige al índice de esa categoría.
        header("Location: index.php?page=" . $id_categoria);
        exit();
    } catch (Exception $e){
        $error = $e->getMessage();
    }
}
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
// Inclusión de la cabecera (menú de navegación, logo, etc.)
require_once "../header.php";
?>
<main>
    <?php
    // 7. GESTIÓN DE ERRORES EN LA VISTA
    // Si la variable $error tiene contenido (hubo un fallo en el POST), se muestra al usuario.
    if (isset($error)) {
        ?>
        <article class="error">
            <p class="error-p"><?php echo htmlspecialchars($error); ?></p>
        </article>
        <?php
    }

    if ($bloque) {
    ?>
    <article class="anadir-contenido">
        <form action="" method="post" class="form-anadir">
            <input type="hidden" name="action" value="contenido">
            <input type="hidden" name="id_bloque" value="<?php echo htmlspecialchars($bloque->getIdBloque()); ?>">

            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($bloque->getTituloBloque()); ?>" required>

            <label for="descripcion">Descripcion: </label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($bloque->getDescripcionBloque()); ?>" required>

            <label for="texto">Texto: </label>
            <textarea id="texto" name="texto" required><?php echo htmlspecialchars($bloque->getTextoBloque()); ?></textarea>

            <label for="id_categoria">Pertenece a la categoria: </label>
            <select name="id_categoria" id="id_categoria" required>
                <?php
                // Carga dinámica de categorías desde la BD
                $categorias = Categoria::getCategorias();
                foreach ($categorias as $categoria) {
                    // Comprueba si la categoría actual del bucle es la que tiene asignada el bloque para pre-seleccionarla
                    $selected = ($bloque->getIdCategoria() == $categoria->getIdCategoria()) ? "selected" : "";
                    echo "<option value='" . $categoria->getIdCategoria() . "' $selected>" . htmlspecialchars($categoria->getNombre()) . "</option>";
                }
                ?>
            </select><br>

            <label for="prioridad">Prioridad: </label>
            <input type="number" id="prioridad" name="prioridad" value="<?php echo htmlspecialchars($bloque->getOrdenBloque()); ?>" required>

            <label for="fecha_actualizacion">Fecha Actualizacion: </label>
            <input type="date" id="fecha_actualizacion" name="fecha_actualizacion" value="<?php echo date('Y-m-d', strtotime($bloque->getFechaActualizacionBloque())); ?>" required>

            <button type="submit">Editar Contenido</button>
        </form>
    </article>
    <?php } else { ?>
        <article class="error">
            <p class="error-p">Contenido no encontrado. Por favor, selecciona un contenido para editar.</p>
        </article>
    <?php } ?>
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
