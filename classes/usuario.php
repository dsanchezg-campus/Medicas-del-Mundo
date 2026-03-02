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
public function set $titulo{
        return true;
    }
    public function setNombre($nombre){
        $titulo->set($nombre);
    }
    public function setEmail($email)  {
        $titulo->set($email);
    }
    public function setPassword($password){
        $titulo->set($password);
    }
    public function setIdUsuario($id_usuario){
        $titulo->set($id_usuario);
    }
    public function setIdMadre($id_madre){
        $titulo->set($id_madre);
    }
    public function setRol($id_rol){
        $titulo->set($id_rol);
    }
    public function setTitulo($titulo){
        $titulo->set($titulo);

}
public function iniciarsesion(){
        return $sesion
}
public function eliminarsesion(){
        return break$sesion
}
