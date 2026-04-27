<?php
// Clase Faq: Maneja las preguntas frecuentes (FAQ) del sistema.
// Permite crear, modificar, eliminar y listar FAQs asociadas a categorías.
class Faq {
    // Propiedades privadas de la FAQ
    private $titulo;
    private $id_faq;
    private $pregunta;
    private $respuesta;
    private $id_categoria;
    private $fecha_actualizacion;
    /**
     * Constructor: Inicializa un objeto Faq con los datos proporcionados
     * @param $titulo
     * @param $id_faq
     * @param $pregunta
     * @param $respuesta
     * @param $id_categoria
     * @param $fecha_actualizacion
     */

    public function __construct($titulo,$id_faq,$pregunta,$respuesta,$id_categoria,$fecha_actualizacion){
        $this->titulo=$titulo;
        $this->id_faq=$id_faq;
        $this->pregunta=$pregunta;
        $this->respuesta=$respuesta;
        $this->id_categoria=$id_categoria;
        $this->fecha_actualizacion=$fecha_actualizacion;

    }

    // Getters para acceder a las propiedades
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

    // Setters para modificar las propiedades
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
    /**
     * Metodo para crear una nueva FAQ en la base de datos
     * @return void
     */
    public function InsertarFAQ(){
        $db = DB::conectar();
        $stmt = $db->prepare("INSERT INTO faq (titulo, pregunta, respuesta, id_categoria, fecha_actualizacion) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$this->titulo, $this->pregunta, $this->respuesta, $this->id_categoria, $this->fecha_actualizacion]);
    }
    /**
     * Metodo para modificar el FAQ de la BD
     * @return void
     */
    public function ActualizarFAQ(){
        $db = DB::conectar();
        $stmt = $db->prepare("UPDATE faq SET titulo = ?, pregunta = ?, respuesta = ?, id_categoria = ?, fecha_actualizacion = ? WHERE id_faq = ?");
        $stmt->execute([$this->titulo, $this->pregunta, $this->respuesta, $this->id_categoria, $this->fecha_actualizacion, $this->id_faq]);
    }
    /**
     * Metodo para eliminar FAQ de la BD
     * @return void
     */
    public function EliminarFAQ(){
        $db = DB::conectar();
        $stmt = $db->prepare("DELETE FROM faq WHERE id_faq = ?");
        $stmt->execute([$this->id_faq]);
    }

    /**
     * Obtiene de la BD todos los FAQ
     * @return array objetos Faq
     */
    public static function ListarFAQ() :array{
        $db = DB::conectar();
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
    /**
     * Obtiene de la BD todos los FAQ de una categoria especifica
     * @param $id_categoria
     * @return array objetos Faq
     */
    public static function ListarFAQPorCategoria($id_categoria) :array{
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT * FROM faq WHERE id_categoria = ?");
        $stmt->execute([$id_categoria]);
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