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
$bloque = null;

if (isset($_GET['page'])) {
    $bloque = Bloque::getBloqueById($_GET['page']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["action"]) && $_POST["action"] == "contenido") {
    try {
        $id_bloque = $_POST['id_bloque'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $orden = $_POST['orden'];
        $id_categoria = $_POST['id_categoria'];
        $fecha_actualizacion = $_POST['fecha_actualizacion'];
        $img_cat = $_POST['img_cat'];

        $bloqueEditado = new Bloque($id_bloque, $prioridad, $nombre, $descripcion, null, $fecha_actualizacion, $id_categoria, null, $img_cat);
        $bloqueEditado->ActualizarBloque();

        header("Location: index.php?page=" . $id_categoria);
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
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
    <title>Bienvenidas - Editar Contenido</title>
    <link rel="icon" type="../styles/img/logo.png" sizes="32x32" href="../styles/img/logo.png">
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

    if ($id_categoria) {
        ?>
        <article class="anadir-contenido">
            <form action="" method="post" class="form-anadir">
                <input type="hidden" name="action" value="contenido">
                <input type="hidden" name="id_bloque"
                       value="<?php echo htmlspecialchars($id_categoria->getIdCategoria()); ?>">

                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre"
                       value="<?php echo htmlspecialchars($id_categoria->getNombre()); ?>" required>

                <label for="descripcion">Descripcion: </label>
                <input type="text" id="descripcion" name="descripcion"
                       value="<?php echo htmlspecialchars($id_categoria->getDescripcion()); ?>" required>

                <label for="orden">Orden: </label>
                <input type="text" id="orden" name="orden"
                       value="<?php echo htmlspecialchars($id_categoria->getOrden()); ?>" required>

                <label for="img_cat">Imagen </label>
                <input type="text" id="img_cat" name="img_cat"
                       value="<?php echo htmlspecialchars($id_categoria->getImg()); ?>" required>

                <label for="fecha_actualizacion">Orden: </label>
                <input type="text" id="fecha_actualizacion" name="fecha_actualizacion"
                       value="<?php echo htmlspecialchars($id_categoria->getFechaActualizacion()); ?>" required>

                <label for="id_categoria">Pertenece a la categoria: </label>
                <select name="id_categoria" id="id_categoria" required>
                    <?php
                    $id_categoria = Categoria::getCategorias();
                    foreach ($categorias as $categoria) {
                        $selected = ($id_categoria->getIdCategoria() == $categoria->getIdCategoria()) ? "selected" : "";
                        echo "<option value='" . $categoria->getIdCategoria() . "' $selected>" . htmlspecialchars($categoria->getNombre()) . "</option>";
                    }
                    ?>
                </select><br>

                <label for="prioridad">Prioridad: </label>
                <input type="number" id="prioridad" name="prioridad"
                       value="<?php echo htmlspecialchars($bloque->getOrdenBloque()); ?>" required>

                <label for="fecha_actualizacion">Fecha Actualizacion: </label>
                <input type="date" id="fecha_actualizacion" name="fecha_actualizacion"
                       value="<?php echo date('Y-m-d', strtotime($bloque->getFechaActualizacionBloque())); ?>" required>

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