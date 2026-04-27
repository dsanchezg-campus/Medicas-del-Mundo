<?php
require_once ("../classes/Bloque.php");
require_once ("../classes/Categoria.php");
require_once ("../classes/Contenido.php");
require_once ("../classes/DB.php");
require_once ("../classes/Rol.php");
require_once ("../classes/Usuario.php");

// 1. OBLIGATORIO: Iniciar la sesión antes de hacer nada con $_SESSION
session_start();

// Opcional pero necesario si no usas autoloader:
// require_once 'tus_clases.php'; // Asegúrate de cargar las clases Categoria, Bloque y la de la usuaria.

// 2. CRÍTICO: Primero comprobamos que la sesión 'usuaria' existe (isset).
// Si no lo haces y alguien entra sin loguearse, el código "peta" al intentar llamar a un metodo de algo que no existe.
if (isset($_SESSION['usuaria']) && ($_SESSION['usuaria']->controlUsuarioEditora() || $_SESSION['usuaria']->controlUsuarioAdmin())) {

    // Comprobamos qué vamos a eliminar: contenidos o categoria
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['categoria'])) {
        $categoria = Categoria::getCategoriaById($_GET['categoria']);
        unlink("../styles/img/".$categoria['img_cat']);
        Categoria::EliminarCategoria($_GET["categoria"]);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['contenido'])) {
        $bloque = Categoria::getCategoriaById($_GET['contenido']);
        unlink("../styles/img/".$bloque['icono']);
        Bloque::EliminarBloque($_GET['contenido']);
    }

    // Redirigimos al inicio según su rol
    header ("Location: ".$_SESSION['usuaria']->getRol()."/index.php");
    exit();
}

// Si no hay sesión iniciada (o no es editora/admin), redirigimos al inicio
header ("Location: ../index.php");
exit();