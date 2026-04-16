<?php
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
session_start();
// Verificar si se envió el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usuario"], $_POST["password"])) {
    $usuario = htmlspecialchars($_POST["usuario"]);
    $password = htmlspecialchars($_POST["password"]);
    // Intentar iniciar sesión con las credenciales proporcionadas
    // Guarda la usuaria en SESSION['usuaria']
    if (Usuario::InicioSesion($usuario, $password)){
        // Redirigir a la página según el rol del usuario
        header("Location:../".$_SESSION['usuaria']->getRol()."/index.php");
        exit;
    } else{
        // Mostrar mensaje de error si las credenciales son incorrectas
        $error = "Credenciales incorrectas";
        header("Location: ../login.php?error=".$error);
        exit();
    }
} else{
    $error = "introduzca los datos";
    header("Location: ../login.php?error=".$error);
    exit();
}