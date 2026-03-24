<?php
class Contenido{
    private $id_contenido;
    private $titulo;
    private $url;
    private $descripcion;
    private $id_bloque;
    private $fecha_actualizacion;

    public function __construct($id_contenido, $titulo, $url, $descripcion, $id_bloque, $fecha_actualizacion)
    {
        $this->id_contenido = $id_contenido;
        $this->titulo = $titulo;
        $this->url = $url;
        $this->descripcion = $descripcion;
        $this->id_bloque = $id_bloque;
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    //GETTERS
    public function getIdContenido()
    {
        return $this->id_contenido;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getIdBloque()
    {
        return $this->id_bloque;
    }

    public function getFechaActualizacion()
    {
        return $this->fecha_actualizacion;
    }

    //SETTERS
    public function setIdContenido($id_contenido)
    {
        $this->id_contenido = $id_contenido;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setIdBloque($id_bloque)
    {
        $this->id_bloque = $id_bloque;
    }

    public function setFechaActualizacion($fecha_actualizacion)
    {
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    public function ListarContenido()
    {

    }

    public function CrearContenido($id_contenido)
    {

    }

    public function ModificarContenido($id_contenido)
    {

    }

    public function EliminarContenido($id_contenido)
    {

    }
    public static function getContenidoByBloque($db, $id_bloque) :array{
        $stmt = $db->prepare("SELECT * FROM contenido WHERE id_bloque = ? ");
        $stmt->execute([$id_bloque]);
        $contenidos = array();
        while ($consultaContenido = $stmt->fetch(PDO::FETCH_ASSOC)){
            $contenidos = new Contenido(
                $consultaContenido['id_bloque'],
                $consultaContenido['titulo'],
                $consultaContenido['url'],
                $consultaContenido['descripcion'],
                $consultaContenido['id_bloque'],
                $consultaContenido['fecha_actualizacion']
            );
        }
        return $contenidos;
    }
}
