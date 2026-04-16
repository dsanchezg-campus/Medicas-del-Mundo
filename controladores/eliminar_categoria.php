<?php
//comprobamos que la sesion esta iniciada correctamente
if ($_SESSION['usuaria']->ControlUsuariaEditora() || $_SESSION['usuaria']->ControlUsuariaAdmin()) {
    //comprobamos que vamos a eliminar: contenidos o categoria
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['categoria'])) {
        Categoria::EliminarCategoria($_GET["categoria"]);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['contenido'])) {
        Bloque::EliminarBloque($_GET['contenido']);
    }
    //redirigimos al inicio de las usuarias
    header ("Location: ".$_SESSION['usuaria']->getRol()."/index.php");
    exit();
}
//si no hay sesion iniciada redirigimos al inicio
header ("Location: ../index.php");
exit();