<?php
class Usuario {
    private $nombre;
    private $email;
    private $password;
    private $id_usuario;
    private $id_rol;
    public function __construct($nombre, $email, $password, $id_usuario, $id_rol)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->id_usuario = $id_usuario;
        $this->id_rol = $id_rol;
    }
    //GETTERS
    public function getNombre(){
        return $this->nombre;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getIdUsuario(){
        return $this->id_usuario;
    }
    public function getIdRol(){
        return $this->id_rol;
    }
    //SETTERS
    public function setNombre($nombre) {
        $nombre->set($nombre);
    }
    public function setEmail($email) {
        $email->set($email);
    }
    public function setPassword($password) {
        $password->set($password);
    }
    public function setIdUsuario($id_usuario) {
        $id_usuario->set($id_usuario);
    }
    public function setIdMadre($id_madre) {
        $id_madre->set($id_madre);
    }
    public function setRol($id_rol) {
        $id_rol->set($id_rol);
    }

    public function iniciarSesion() {

    }
    public function eliminarSesion() {
    }
}