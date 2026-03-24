<?php
class Contenido{
    private $id_extra;
    private $id_bloque;
    private $descripcion;
    private $url;
    private $fecha_actualizacion;

    public function __construct($id_extra, $id_bloque, $descripcion, $url, $fecha_actualizacion)
    {
        $this->id_extra = $id_extra;
        $this->id_bloque = $id_bloque;
        $this->descripcion = $descripcion;
        $this->url = $url;
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    //GETTERS
    public function getIdContenido()
    {
        return $this->id_extra;
    }

    public function getTitulo()
    {
        return $this->descripcion;
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
    public function setIdContenido($id_extra)
    {
        $this->id_extra = $id_extra;
    }

    public function setTitulo($descripcion)
    {
        $this->descripcion = $descripcion;
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

    public function CrearContenido($id_extra)
    {

    }

    public function ModificarContenido($id_extra)
    {

    }

    public function EliminarContenido($id_extra)
    {

    }
    public static function getContenidoByBloque($db, $id_bloque) :array{
        $stmt = $db->prepare("SELECT * FROM extra WHERE id_bloque = ? ");
        $stmt->execute([$id_bloque]);
        $contenidos = array();
        while ($consultaContenido = $stmt->fetch(PDO::FETCH_ASSOC)){
            $contenidos = new Contenido(
                $consultaContenido['id_extra'],
                $consultaContenido['id_bloque'],
                $consultaContenido['descripcion'],
                $consultaContenido['url'],
                $consultaContenido['fecha_actualizacion']
            );
        }
        return $contenidos;
    }
}
