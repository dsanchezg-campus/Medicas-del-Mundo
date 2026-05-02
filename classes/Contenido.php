<?php
// Clase Contenido: Representa contenido extra (enlaces, URLs) asociados a bloques de contenido.
// Actualmente, solo implementa la recuperación de contenidos por bloque; otros métodos son stubs.
class Contenido{
    private $id_extra;
    private $url;
    private $descripcion;
    private $id_bloque;
    private $fecha_actualizacion;
    /**
     * @param $id_extra
     * @param $url
     * @param $descripcion
     * @param $id_bloque
     * @param $fecha_actualizacion
     */

    /**
     * @param $id_extra
     * @param $url
     * @param $descripcion
     * @param $id_bloque
     * @param $fecha_actualizacion
     */
    public function __construct($id_extra, $url, $descripcion, $id_bloque, $fecha_actualizacion)
    {
        $this->id_extra;
        $this->url = $url;
        $this->descripcion = $descripcion;
        $this->id_bloque = $id_bloque;
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    /************************* GETTERS y SETTERS ****************************************/
    /************************************************************************************/

    public function getIdExtra()
    {
        return $this->id_extra;
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

    /*********************************** METODOS ****************************************/
    /************************************************************************************/

    /**
     * Añade un nuevo contenido a la BD
     */
    public function InsertarContenido(): void
    {
        $db = DB::conectar();
        $stmt = $db->prepare("INSERT INTO extra(id_extra, id_bloque, descripcion, url, fecha_actualizacion) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$this->id_extra, $this->id_bloque, $this->descripcion, $this->url, $this->fecha_actualizacion]);
    }

    /**
     * Actualiza un contenido de la BD
     * @return void
     */
    public function ActualizarContenido(): void
    {
        $db = DB::conectar();
        $stmt = $db->prepare("UPDATE extra SET id_bloque = ?, descripcion = ?, url = ?, fecha_actualizacion = ? WHERE id_extra = ? ");
        $stmt->execute([$this->id_bloque, $this->descripcion, $this->url, $this->fecha_actualizacion, $this->id_extra]);
    }

    /**
     * Eliminar un contenido de la BD
     * @return void
     */
    public function EliminarContenido(): void
    {
        $db = DB::conectar();
        $stmt = $db->prepare("DELETE FROM extra WHERE id_extra = ?");
        $stmt->execute([$this->id_extra]);
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
