<?php
// Incluir todas las clases necesarias para el funcionamiento del módulo
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

session_start();
require_once "../controladores/control_editora.php";
if (empty($_GET['categoria'])){
    header ("Location: index.php");
    exit();
}
// Verificar si se envió un formulario por POST con los datos de la categoría
if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST["pregunta"], $_POST["respuesta"], $_POST['categoria'])) {
    $pregunta = $_POST["pregunta"];
    $respuesta = $_POST["respuesta"];
    $fecha_actualizacion = date("Y-m-d H:i:s", time());
    $categoria = new Faq(Faq::SiguienteId(), $_POST["nombre"], $_POST["descripcion"], $orden_cat, $imagen, $id_madre, $fecha);
    try {
        $categoria->InsertarCategoria();
        header ("location: index.php?page=". $categoria->getIdCategoria());
        exit();
    } catch (Exception $e) {
        // Si ocurre un error, capturarlo y almacenarlo en la variable $error
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
            <input type="hidden" name="categoria" value="<?= $_GET['categoria']; ?>" >

            <label for="pregunta">Pregunta: </label>
            <input type="text" id="pregunta" name="pregunta" required>

            <label for="respuesta">Respuesta: </label>
            <textarea id="respuesta" name="respuesta" required></textarea>

            <button type="submit">Añadir</button>
        </form>
    </article>
</main>
<!-- Pie de página con información de contacto de Médicos del Mundo -->
<?php require_once "../footer.php"; ?>
<a href="../admin/index.php" class="volver-inicio"><img src="../styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>