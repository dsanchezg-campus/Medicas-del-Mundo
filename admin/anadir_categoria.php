<?php
// Incluir todas las clases necesarias para el funcionamiento del módulo
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

// Validación comentada: Verificar si el usuario actual tiene permisos de editora
// if (!$_SESSION["usuaria"]->controlUsuarioEditora) {
//     header("location: ../index.php");
//     exit();
// }

// Verificar si se envió un formulario por POST con los datos de la categoría
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["nombre"], $_POST["descripcion"])) {

    // 1. MANEJO DE LA IMAGEN CON $_FILES
    $nombre_imagen = "";
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = $_FILES['img']['name'];
        // OJO: Aquí deberías añadir la lógica para guardar físicamente el archivo en tu servidor.
        // Ejemplo: move_uploaded_file($_FILES['img']['tmp_name'], '../ruta_a_tus_imagenes/' . $nombre_imagen);
    }

    // 2. CORRECCIÓN DEL ID MADRE
    // Si en el select eligen "Ninguna" (value=""), lo pasamos como null a la BD
    $id_madre = !empty($_POST["id_categoria"]) ? $_POST["id_categoria"] : null;

    try {
        // 3. LLAMADA CORRECTA AL METODO ESTÁTICO CON SUS PARÁMETROS
        // Se llama a la clase directamente con :: y se le pasan los datos del formulario
        Categoria::InsertarCategoria(
                $_POST["nombre"],
                $_POST["descripcion"],
                $_POST["orden"],
                $nombre_imagen,
                $id_madre,
                $_POST["fecha_actualizacion"]
        );
        $exito = "Categoría añadida correctamente.";
    } catch (Exception $e){
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
            <input type="hidden" name="action" value="categoria">

            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripcion: </label>
            <input type="text" id="descripcion" name="descripcion" required>

            <label for="orden">Orden: </label>
            <input type="number" id="orden" name="orden" required>

            <label for="img">Imagen: </label>
            <input type="file" id="img" name="img" accept="image/*" required>

            <label for="id_categoria">Pertenece a la categoria: </label>
            <select name="id_categoria" id="id_categoria">
                <option value="">Ninguna</option>
                <?php
                $categorias = Categoria::getCategorias();
                if ($categorias) {
                    foreach ($categorias as $categoria) {
                        echo "<option value='" . $categoria->getIdCategoria() . "'>" . $categoria->getNombre() . "</option>";
                    }
                }
                ?>
            </select>

            <label for="prioridad">Prioridad: </label>
            <input type="number" id="prioridad" name="prioridad" required>

            <label for="fecha_actualizacion">Fecha Actualizacion: </label>
            <input type="date" id="fecha_actualizacion" name="fecha_actualizacion" required>

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