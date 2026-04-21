<?php
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

session_start();

// if (!$_SESSION["usuaria"]->controlUsuarioEditora) {
//     header("location: ../index.php");
//     exit();
// }

$error = null;
$categoria_edit = null;

// Obtenemos el ID de la categoría por la URL.
// Revisamos si viene como 'id_categoria' o como 'page' (por compatibilidad con tus enlaces anteriores)
$id_buscar = $_GET['id_categoria'] ?? $_GET['page'] ?? null;

if ($id_buscar) {
    try {
        // Hacemos una consulta directa para obtener los datos de la categoría ya que
        // la clase Categoria no tiene un metodo getCategoriaById implementado.
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
        $stmt->execute([$id_buscar]);
        $cat_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cat_data) {
            $categoria_edit = new Categoria(
                    $cat_data['id_categoria'],
                    $cat_data['nombre'],
                    $cat_data['descripcion'],
                    $cat_data['orden'],
                    $cat_data['img_cat'],
                    $cat_data['id_madre'],
                    $cat_data['fecha_actualizacion']
            );
        } else {
            $error = "La categoría solicitada no existe.";
        }
    } catch (Exception $e) {
        $error = "Error al buscar la categoría: " . $e->getMessage();
    }
}

// Lógica para actualizar la categoría al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["action"]) && $_POST["action"] == "editar_categoria") {
    try {
        $id_categoria_post = $_POST['id_categoria'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $orden = $_POST['orden'];
        // Si no se selecciona categoría madre, lo dejamos en null
        $id_madre = !empty($_POST['id_madre']) ? $_POST['id_madre'] : null;
        $fecha_actualizacion = $_POST['fecha_actualizacion'];
        $img_cat = $_POST['img_cat'];

        // Instanciamos la categoría con los datos editados
        $categoriaEditada = new Categoria($id_categoria_post, $nombre, $descripcion, $orden, $img_cat, $id_madre, $fecha_actualizacion);

        // Llamamos al metodo que ejecuta el UPDATE en la BD
        $categoriaEditada->ActualizarCategoria();

        // Redirigimos al inicio de admin o donde prefieras tras el éxito
        header("Location: ../admin/index.php");
        exit();
    } catch (Exception $e) {
        $error = "Error al actualizar: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Bienvenidas - Editar Categoría</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../styles/img/logo.png">
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

    if ($categoria_edit) {
        ?>
        <article class="anadir-categoria">
            <form action="" method="post" class="form-anadir">
                <input type="hidden" name="action" value="editar_categoria">
                <input type="hidden" name="id_categoria"
                       value="<?php echo htmlspecialchars($categoria_edit->getIdCategoria()); ?>">

                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre"
                       value="<?php echo htmlspecialchars($categoria_edit->getNombre()); ?>" required>

                <label for="descripcion">Descripción: </label>
                <input type="text" id="descripcion" name="descripcion"
                       value="<?php echo htmlspecialchars($categoria_edit->getDescripcion()); ?>" required>

                <label for="orden">Orden: </label>
                <input type="number" id="orden" name="orden"
                       value="<?php echo htmlspecialchars($categoria_edit->getOrden()); ?>" required>

                <label for="img_cat">Imagen: </label>
                <input type="text" id="img_cat" name="img_cat"
                       value="<?php echo htmlspecialchars($categoria_edit->getImg()); ?>" required>

                <label for="id_madre">Pertenece a la categoría (Madre): </label>
                <select name="id_madre" id="id_madre">
                    <option value="">Ninguna</option>
                    <?php
                    // Listamos las categorías para poder asignarle una categoría padre (que no sea ella misma)
                    $categorias = Categoria::getCategorias();
                    foreach ($categorias as $cat_opcion) {
                        if ($cat_opcion->getIdCategoria() != $categoria_edit->getIdCategoria()) {
                            $selected = ($categoria_edit->getIdMadre() == $cat_opcion->getIdCategoria()) ? "selected" : "";
                            echo "<option value='" . $cat_opcion->getIdCategoria() . "' $selected>" . htmlspecialchars($cat_opcion->getNombre()) . "</option>";
                        }
                    }
                    ?>
                </select><br>

                <label for="fecha_actualizacion">Fecha Actualización: </label>
                <input type="date" id="fecha_actualizacion" name="fecha_actualizacion"
                       value="<?php echo date('Y-m-d', strtotime($categoria_edit->getFechaActualizacion())); ?>" required>

                <button type="submit">Guardar Cambios</button>
            </form>
        </article>
    <?php } else { ?>
        <article class="error">
            <p class="error-p">Categoría no encontrada. Por favor, selecciona una categoría para editar desde el panel de administración.</p>
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
        <p><a href="login.php">Iniciar Sesión</a></p>
    </section>
</footer>
<a href="../admin/index.php" class="volver-inicio"><img src="../styles/img/casita.png" alt="regresa a inicio"></a>
</body>

</html>
