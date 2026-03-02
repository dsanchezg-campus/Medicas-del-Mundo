<?php
class Faq extends Categoria
{
    private $titulo;
    private $id_faq;
    private $pregunta;
    private $respuesta;
    private $id_categoria;
    private $fecha_actualizacion;
    public function __construct($titulo,$id_faq,$pregunta,$respuesta,$id_categoria,$fecha_actualizacion){
        $this->titulo=$titulo;
        $this->id_faq=$id_faq;
        $this->pregunta=$pregunta;
        $this->respuesta=$respuesta;
        $this->id_categoria=$id_categoria;
        $this->fecha_actualizacion=$fecha_actualizacion;

    }
}   public function crearfaq(){
    return $faq
}
public function modificarfaq(){
    return $faq
}
public function eliminarfaq(){
    return[delete$faq]
}
public function listarfaq(){
    return $faq
}