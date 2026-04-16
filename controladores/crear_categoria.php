<?php
//comprobamos que la sesión este iniciada correctamente
if ($_SESSION['usuaria']->ControlUsuariaEditora() || $_SESSION['usuaria']->ControlUsuariaAdmin()) {
    //comprobamos que lleguen los datos correctos
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'], $_POST["nombre"], $_POST["descripcion"], $_POST['orden'], $_POST['img'], $_POST['id_categoria'], $_POST['fecha_actualizacion'])) {
        try {
            Categoria::InsertarCategoria(
                $_POST["nombre"],
                $_POST["descripcion"],
                $_POST["prioridad"],
                $_POST["img"],
                $_POST["id_categoria"] ?? null,
                $_POST["fecha_actualizacion"]);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
//volvemos al inicio según el rol de la usuaria
header("Location: ".$_SERVER['usuaria']->getRol()."/index.php");
exit();