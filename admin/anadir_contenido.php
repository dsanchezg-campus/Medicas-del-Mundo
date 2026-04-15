<?php
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";

if (!$_SESSION["usuaria"]->controlUsuarioEditora) {
    header("location: ../index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["nombre"], $_POST["descripcion"])) {
    $cat = new Contenido($_POST["nombre"], $_POST["descripcion"]);
    try {
        $cat->InsertarContenido();
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
    <title>Bienvenidas</title>
    <link rel="icon" type="../styles/img/logo.png" sizes="32x32" href="../styles/img/logo.png">
</head>
<body>
    <header>
        <ul class="lista-nav">
            <li class="linea-nav">
                <article class="logo">
                    <a href="https://www.medicosdelmundo.org/" class="enlace-medicos">
                        <img src="../styles/img/logo.png" alt="logo">
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
        <?php
        if (isset($error)) {
            ?>
            <article class="error">
                <p class="error-p"><?php echo $error; ?></p>
            </article>
            <?php
        }
        ?>
        <article class="anadir-categoria">
            <form action="" method="post" class="form-anadir">
                <input type="hidden" name="action" value="categoria">
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre" required>
                <button type="submit">Añadir</button>
            </form>
        </article>
    <article class="anadir-contenido">
        <form action="" method="post" class="form-anadir">
            <input type="hidden" name="action" value="contenido">
            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" name="titulo" required>
            <label for="descripcion">Descripcion: </label>
            <input type="text" id="descripcion" name="descripcion" required>
            <label for="texto">Texto: </label>
            <input type="text" id="texto" name="texto" required>
            <label for="id_categoria">Pertenece a la categoria: </label>
            <select name="id_categoria" id="id_categoria">
                <?php
                $categorias = Categoria::getCategorias();
                foreach ($categorias as $categoria) {
                    echo "<option value='" . $categoria->getIdCategoria() . "'>" . $categoria->getNombre() . "</option>";
                }
                ?>
            </select><br>
            <label for="prioridad">Prioridad: </label>
            <input type="number" id="prioridad" name="prioridad" required>
            <label for="fecha_actualizacion">Fecha Actualizacion: </label>
            <input type="date" id="fecha_actualizacion" name="fecha_actualizacion" required>
            <button type="submit">Añadir</button>
        </form>
    </article>
    </main>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
        if ($_POST['action'] === 'contenido') {
            $bloque = new Bloque(null, $_POST['prioridad'], $_POST['titulo'], $_POST['descripcion'], $_POST['texto'], null, $_POST['fecha_actualizacion'], $_POST['id_categoria']);
            $bloque->CrearBloque();
        } elseif ($_POST['action'] === 'categoria') {
            $categoria = new Categoria(null, $_POST['nombre'], '', 0, '', null, date("Y-m-d H:i:s"));
            $categoria->InsertarCategoria();
        }
    }
    ?>

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
    <a href="admin.php" class="volver-inicio"><img src="../styles/img/casita.png" alt="regresa a inicio"></a>
</body>
</html>
