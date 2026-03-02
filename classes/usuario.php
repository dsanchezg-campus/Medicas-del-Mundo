<?php
class Usuario {
    private $nombre;
    private $email;
    private $password;
    private $id_usuario;
    private $rol;
    public function __construct($nombre, $email, $password, $id_usuario, $rol)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->id_usuario = $id_usuario;
        $this->rol = $rol;
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
    public function getRol(){
        return $this->rol;
    }
    //SETTERS
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function setIdMadre($id_madre) {
        $this->id_madre = $id_madre;
    }
    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function iniciarSesion() {

    }
    public function eliminarSesion() {
    }
}