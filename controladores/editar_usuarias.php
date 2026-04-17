<?php
require_once "../classes/Usuario.php";
if ($_SESSION['usuaria']->ControlUsuariaAdmin()) {
    if (isset($_POST['id']) &&
        (isset($_POST['nombre']) || isset($_POST['email']) || isset($_POST['password[]']))) {
        $usuaria = Usuario::getUsuaria($_POST['id']);
        if (empty($_POST['nombre'])) {
            $nombre = $usuaria->getNombre();
        }
        if (empty($_POST['email'])) {
            $email = $usuaria->getEmail();
        }
        $new_password = array();
        $new_password = $_POST['password[]'];
        if (empty($password['0']) && empty($password['1'])) {
            $password = $usuaria->getPassword();
        } elseif (empty($password['0']) || empty($password['1'])) {
            header ("Location: /admin/editar_editora.php");
        }
    }
    header ("Location: /".$_SESSION['usuaria']->getRol()."/index.php");
    exit();
}
header ("Location: /index.php");
exit();