<?php
if ($_SESSION['usuaria']->ControlUsuariaEditora || $_SESSION['usuaria']->ControlUsuariaAdmin()) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['categoria'])) {
        Categoria::EliminarCategoria($_GET["categoria"]);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['contenido'])) {
        Bloque::EliminarBloque($_GET['contenido']);
    }
    header ("Location: ".$_SESSION['usuaria']->getRol()."/index.php");
}