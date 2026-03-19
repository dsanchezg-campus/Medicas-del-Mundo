<?php
class Categoria
{
    private int $id_categoria;
    private int $orden;
    private string $nombre;
    private string $descripcion;
    private string $img;
    private int $id_madre;
    private string $fecha_actualizacion;
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    public function setDatos($id_categoria, $nombre, $descripcion, $id_madre, $fecha_actualizacion){
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

    public function numeroCategorias(){
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM categoria WHERE id_madre = NULL");
        $stmt->execute();
    }

    public function getCategorias(){

    }
}