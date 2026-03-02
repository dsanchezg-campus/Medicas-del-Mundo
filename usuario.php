<?php
class Usuario extends Rol
{
    private $nombre;
    private $email;
    private $password;
    private $id_usuario;
    private $id_rol;
    public function __construct($nombre, $email, $password, $id_usuario, $id_rol){
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->id_usuario = $id_usuario;
        $this->id_rol = $id_rol;

}
public function verificarsesion(){
        return true;
}
public function iniciarsesion(){
        return $sesion
}
public function eliminarsesion(){
        return break$sesion
}
