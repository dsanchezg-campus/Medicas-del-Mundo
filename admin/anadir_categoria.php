<?php
// Incluir todas las clases necesarias para el funcionamiento del módulo
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

// CONTROL DE ACCESO ADMIN
require_once "../controladores/control_admin.php";

// Verificar si se envió un formulario por POST con los datos de la categoría
if ($_SERVER['REQUEST_METHOD'] == 'POST'
        && isset($_POST["nombre"], $_POST["descripcion"], $_FILES["img"])) {

    // 1. MANEJO DE LA IMAGEN CON $_FILES
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $imagen = uniqid() . "_" . basename($_FILES['img']['name']);
        $target_dir = "../styles/img/";
        $target_file = $target_dir . $imagen;
        $fecha = date("Y-m-d H:i:s", time());
        if (isset($_GET["page"])) {
            $orden_cat = Categoria::SiguienteOrden($_GET["page"]);
            $id_madre = $_GET["page"];
        } else{
            $id_madre = null;
            $orden_cat = Categoria::SiguienteOrden($id_madre);
        }
        $categoria = new Categoria(Categoria::SiguienteId(), $_POST["nombre"], $_POST["descripcion"], $orden_cat, $imagen, $id_madre, $fecha);
        if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
            try {
                $categoria->InsertarCategoria();
                header ("location: index.php?page=". $categoria->getIdCategoria());
                exit();
            } catch (Exception $e) {
                // Si ocurre un error, capturarlo y almacenarlo en la variable $error
                $error = $e->getMessage();
            }
        }
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
    <title>Bienvenidas</title>
    <link rel="icon" type="../styles/img/logo.png" sizes="32x32" href="../styles/img/logo.png">
</head>
<body>
<?php require_once "../header.php"; ?>
<main>
    <?php if (isset($exito)) { ?>
        <article class="exito" style="color: green; padding: 10px;">
            <p><?php echo $exito; ?></p>
        </article>
    <?php } ?>

    <?php if (isset($error)) { ?>
        <article class="error" style="color: red; padding: 10px;">
            <p class="error-p"><?php echo $error; ?></p>
        </article>
    <?php } ?>

    <article class="anadir-categoria">
        <form action="" method="post" class="form-anadir" enctype="multipart/form-data">
            <input type="hidden" name="action" value="categoria">

            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripcion: </label>
            <input type="text" id="descripcion" name="descripcion" required>

            <label for="img">Imagen: </label>
            <input type="file" id="img" name="img" accept="image/*" required>

            <button type="submit">Añadir</button>
        </form>
    </article>
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