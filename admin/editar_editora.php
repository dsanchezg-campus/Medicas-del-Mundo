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
// Fundamental para poder acceder a las variables globales $_SESSION y saber quién está navegando.
session_start();

// 3. CONTROL DE ACCESO (Actualmente comentado)
// Aquí se comprobaba si la usuaria actual tenía el rol/permisos de editora.
// ALERTA: Al estar comentado, CUALQUIERA que acceda a esta URL podría editar contenido si sabe el ID.
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
// Inclusión de la cabecera
require_once "../header.php";
?>
<main>
    <?php
    // ERROR CRÍTICO 2: Variable indefinida.
    // Aquí preguntas si existe $error, pero $error nunca ha sido definida ni inicializada en la parte superior del PHP.
    // Esto no romperá la página por el 'isset', pero es código inútil aquí tal como está.
    if (isset($error)) {
        ?>
        <article class="error">
            <p class="error-p"><?php echo htmlspecialchars($error); ?></p>
        </article>
        <?php
    }
    ?>
    <article class="anadir-contenido">
        <form action="/controladores/editar_usuarias.php" method="post" class="form-anadir">
                <?php
                // ERROR CRÍTICO 3: Falta validación.
                // Estás asumiendo que $_GET["id_usuario"] siempre existe. Si alguien entra a 'editar_editora.php' sin parámetros,
                // esto dará un error "Undefined array key id_usuario".
                // Debería estar envuelto en un: if(isset($_GET["id_usuario"])) { ... }
                $usuaria = Usuario::getUsuaria($_GET["id_usuario"]);
                ?>

            <label for="nombre"><?php echo $usuaria->getRol().": ". $usuaria->getNombre(); ?> </label>
            <input type="text" id="nombre" name="nombre" placeholder="Cambiar Nombre">

            <label for="email">Email: <?php echo $usuaria->getEmail();?> </label>
            <input type="text" id="email" name="email" placeholder="Cambiar Email" accept="%@email.com">

            <label for="password">Cambiar contraseña: </label>
            <input type="password" id="password" name="password[]" placeholder="Introduzca nueva contraseña">
            <input type="password" id="password" name="password[]" placeholder="Repite la contraseña">
            <button type="submit">Editar usuaria</button>
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