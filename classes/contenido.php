<?php
class Contenido extends Bloque
{
private $id_contenido;
private $titulo;
private $url;
private $descripcion;
private $id_bloque;
private $id_madre;
private $fecha_actualizacion;
public function __construct($id_contenido, $titulo, $url, $descripcion, $id_madre, $fecha_actualizacion){
    $this->contenido=$id_contenido;
    $this->titulo=$titulo;
    $this->url=$url;
    $this->descripcion=$descripcion;
    $this->id_madre=$id_madre;
    $this->fecha_actualizacion=$fecha_actualizacion;
}
public function ListarContenido(){
    return$Contenido;
}
public function CrearContenido($id_contenido){
    create$Bloque
}
public function ModificarContenido($id_contenido){
    modify$Bloque
}
public function EliminarContenido($id_contenido){
    delete$Bloque
}
