<?php
require_once "../classes/Usuario.php";
if ($_SESSION['usuaria']->ControlUsuariaAdmin()) {
    if (isset($_GET['page'])){
        Usuario::EliminarUsuaria($_GET['page']);
    }
    header ("Location: /".$_SESSION['usuaria']->getRol()."/index.php");
    exit();
}
header ("Location: /index.php");
exit();
