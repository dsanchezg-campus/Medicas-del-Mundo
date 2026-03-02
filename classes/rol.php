<?php
class Rol {
    private $id_rol;
    private $nombre;
    public function __construct($id_rol,$nombre){
        $this->id_rol=$id_rol;
        $this->nombre=$nombre;
    }
    //GETTERS
    public function getTdRol(){
        return $this->id_rol;
    }
    public function getNombre(){
        return $this->nombre;
    }
    //METODOS
    public function setIdRol($id_rol){
    $this->id_rol=$id_rol;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
}
