<?php
class Faq {
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
    //GETTERS
    public function getTitulo(){
        return $this->titulo;
    }
    public function getIdFaq(){
        return $this->id_faq;
    }
    public function getPregunta(){
        return $this->pregunta;
    }
    public function getRespuesta(){
        return $this->respuesta;
    }
    public function getIdCategoria(){
        return $this->id_categoria;
    }
    public function getFechaActualizacion(){
        return $this->fecha_actualizacion;
    }
    //SETTERS
    public function setTitulo($titulo){
        $this->titulo=$titulo;
    }
    public function setIdFaq($id_faq){
        $this->id_faq=$id_faq;
    }
    public function setPregunta($pregunta){
        $this->pregunta=$pregunta;
    }
    public function setRespuesta($respuesta){
        $this->respuesta=$respuesta;
    }
    public function setIdCategoria($id_categoria){
        $this->id_categoria=$id_categoria;
    }
    public function setFechaActualizacion($fecha_actualizacion){
        $this->fecha_actualizacion=$fecha_actualizacion;
    }
    public function crearfaq(){
        $stmt = $db->prepare("INSERT INTO faq (titulo, pregunta, respuesta, id_categoria, fecha_actualizacion) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$this->titulo, $this->pregunta, $this->respuesta, $this->id_categoria, $this->fecha_actualizacion]);
        return $stmt->rowCount();
    }

    public function modificarfaq(){
        $stmt = $db->prepare("UPDATE faq SET titulo = ?, pregunta = ?, respuesta = ?, id_categoria = ?, fecha_actualizacion = ? WHERE id_faq = ?");
        $stmt->execute([$this->titulo, $this->pregunta, $this->respuesta, $this->id_categoria, $this->fecha_actualizacion, $this->id_faq]);
        return $stmt->rowCount();
    }
    public function eliminarfaq(){
        $stmt = $db->prepare("DELETE FROM faq WHERE id_faq = ?");
        $stmt->execute([$this->id_faq]);
        return $stmt->rowCount();
    }
    public static function listarfaq($db){
        $stmt = $db->prepare("SELECT * FROM faq");
        $stmt->execute();
        $faqs = array();
        while ($consultaFaq = $stmt->fetch(PDO::FETCH_ASSOC)){
            $faqs[] = new Faq(
                $consultaFaq['titulo'],
                $consultaFaq['id_faq'],
                $consultaFaq['pregunta'],
                $consultaFaq['respuesta'],
                $consultaFaq['id_categoria'],
                $consultaFaq['fecha_actualizacion']
            );
        }
        return $faqs;
    }
}