<?php
require_once "Classes/DB.php";
$pass = password_hash("P@ssw0rd", PASSWORD_DEFAULT);
$db = DB::conectar();
$db->exec("UPDATE usuario SET password = '$pass' WHERE id_usuario = 1");

echo "Contraseña actualizada correctamente";
?>