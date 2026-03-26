<?php
class Contenido{
    //identificador del objeto
    private $id_extra;
    private $url;
    private $descripcion;
    // id del objeto Bloque al que pertenece
    private $id_bloque;
    private $fecha_actualizacion;

    public function __construct($id_extra, $url, $descripcion, $id_bloque, $fecha_actualizacion)
    {
        $this->id_contenido = $id_extra;
        $this->url = $url;
        $this->descripcion = $descripcion;
        $this->id_bloque = $id_bloque;
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    //GETTERS
    public function getIdExtra()
    {
        return $this->id_contenido;
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
    public function setIdExtra($id_extra)
    {
        $this->id_extra = $id_extra;
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

    /**
     * Devuelve un array con los Contenidos pertenecientes a un Bloque
     * @param $id_bloque int identificador del Bloque al que pertenece el contenido
     * @return array
     */
    public static function getContenidoByBloque($id_bloque) :array{
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT * FROM extra WHERE id_bloque = ? ");
        $stmt->execute([$id_bloque]);
        $contenidos = array();
        while ($consultaContenido = $stmt->fetch(PDO::FETCH_ASSOC)){
            $contenido = new Contenido(
                $consultaContenido['id_extra'],
                $consultaContenido['url'],
                $consultaContenido['descripcion'],
                $consultaContenido['id_bloque'],
                $consultaContenido['fecha_actualizacion']
            );
            $contenidos[] = $contenido;
        }
        return $contenidos;
    }
}
