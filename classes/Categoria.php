<?php
class Categoria
{
    private $id_categoria;
    private $orden;
    private $nombre;
    private $descripcion;
    private $img;
    private $id_madre;
    private $fecha_actualizacion;

    public function __construct($id_categoria, $nombre, $descripcion, $id_madre, $fecha_actualizacion){
        $this->id_categoria = $id_categoria;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id_madre = $id_madre;
        $this->fecha_actualizacion = $fecha_actualizacion;
    }
    public function getIdCategoria(){
        return $this->id_categoria;
    }
    public function setIdCategoria($id_categoria){
        return $this->id_categoria = $id_categoria;
    }
    public function getOrden(){
        return $this->orden;
    }
    public function setOrden($orden){
        return $this->orden = $orden;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        return $this->nombre = $nombre;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        return $this->descripcion = $descripcion;
    }
    public function getImg(){
        return $this->img;
    }
    public function setImg($img){
        return $this->img = $img;
    }
    public function getIdMadre(){
        return $this->id_madre;
    }
    public function setIdMadre($id_madre){
        return $this->id_madre = $id_madre;
    }
    public function getFechaActualizacion(){
        return $this->fecha_actualizacion;
    }
    public function setFechaActualizacion($fecha_actualizacion){
        return $this->fecha_actualizacion = $fecha_actualizacion;
    }


}