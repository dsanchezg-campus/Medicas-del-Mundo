<?php
require_once "../classes/Usuario.php";
if ($_SESSION['usuaria']->ControlUsuariaAdmin()) {
    if (isset($_POST['id']) &&
        (isset($_POST['nombre']) || isset($_POST['email']) || isset($_POST['password[]']))) {
        $usuaria = Usuario::getUsuaria($_POST['id']);
        if (!empty($_POST['nombre'])) {
            $usuaria->setNombre($_POST['nombre']);
        }
        if (empty($_POST['email'])) {
            $usuaria->setEmail($_POST['email']);
        }
        $new_password = array();
        $new_password = $_POST['password[]'];
        if (!empty($new_password['0']) || !empty($new_password['1'])) {
            if ($new_password['0'] != $new_password['1']){
                $error = "Contraseñas no coinciden";
                header ("location: /admin/editar_editora.php?error=".$error);
                exit();
            } else {
                $usuaria->setPassword($new_password['0']);
            }
        }
        $usuaria->ActualizarUsuaria() ?
            header ("location: /admin/ver_editoras.php") :
            header ("location: /admin/editar_editora.php?error=1");
        exit();
    }
    header ("Location: /".$_SESSION['usuaria']->getRol()."/index.php");
    exit();
}
header ("Location: /index.php");
exit();