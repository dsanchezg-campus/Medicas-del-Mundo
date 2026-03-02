<?php
class Rol{
    private $id_rol;
    private $nombre;
    public function __construct($id_rol,$nombre){
        $this->id_rol=$id_rol;
        $this->nombre=$nombre;
    }
    public function getTitulo(){
        return $this->titulo;
    }


    public function getNombre(){
        return $this->nombre;
    }




    public function getIdRol(){
        return $this->id_rol;
    }
    public function setIdRol($id_rol){
        $this->id_rol=$id_rol;
    }
    public function getId(){
        return $this->id_rol;

    }
    public function getRol(){
        return $this->nombre;
    }
    //GETTERS
    public function setRol($rol){
    $this->nombre=$rol;
    return $this;
    public function setIDRol($id_rol){
        $this->id_rol=$id_rol;

    }
    public function setNombre($nombre){
        $this->nombre=$nombre;

    }
    public function setTitulo($titulo){
        $this->titulo=$titulo;

    }
    public function setID($id_bloque){
        $this->id_bloque=$id_bloque;

}
