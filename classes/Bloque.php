<?php
include_once "DB.php";
class Bloque
{
    private $id_bloque;
    private $orden_bloque;
    private $titulo_bloque;
    private $descripcion_bloque;
    private $texto_bloque;
    private $id_madre_bloque;
    private $id_categoria;
    private $fecha_actualizacion_bloque;
    private string $icono;


    public function __construct($id_bloque, $orden_bloque, $titulo_bloque, $descripcion, $texto_bloque, $id_madre, $fecha_actualizacion, $id_categoria, $icono){
        $this->id_bloque = $id_bloque;
        $this->orden_bloque = $orden_bloque;
        $this->titulo_bloque = $titulo_bloque;
        $this->descripcion_bloque = $descripcion;
        $this->texto_bloque = $texto_bloque;
        $this->id_madre_bloque = $id_madre;
        $this->fecha_actualizacion_bloque = $fecha_actualizacion;
        $this->id_categoria = $id_categoria;
        $this->icono = $icono;
    }
    public function CrearBloque(){
        $db = DB::conectar();
        $stmt = $db->prepare("INSERT INTO bloque (orden, titulo, descripcion, texto, id_madre, fecha_actualizacion, id_categoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $this->orden_bloque,
            $this->titulo_bloque,
            $this->descripcion_bloque,
            $this->texto_bloque,
            $this->id_madre_bloque,
            $this->fecha_actualizacion_bloque,
            $this->id_categoria
        ]);
    }
    public function ActualizarBloque(){
        $db = DB::conectar();
        $stmt = $db->prepare("UPDATE bloque SET orden = ?, titulo = ?, descripcion = ?, texto = ?, id_madre = ?, fecha_actualizacion = ?, id_categoria = ? WHERE id_bloque = ?");
        $stmt->execute([
            $this->orden_bloque,
            $this->titulo_bloque,
            $this->descripcion_bloque,
            $this->texto_bloque,
            $this->id_madre_bloque,
            $this->fecha_actualizacion_bloque,
            $this->id_categoria,
            $this->id_bloque
        ]);
    }
    public function EliminarBloque(){
        $db = DB::conectar();
        $stmt = $db->prepare("DELETE FROM bloque WHERE id_bloque = ?");
        $stmt->execute([$this->id_bloque]);
    }


    public function getIdBloque(){
        return $this->id_bloque;
    }
    public function setIdBloque($id_bloque){
        $this->id_bloque = $id_bloque;
    }
    public function getOrdenBloque(){
        return $this->orden_bloque;
    }
    public function setOrdenBloque($orden_bloque){
        $this->orden_bloque = $orden_bloque;
    }
    public function getTituloBloque(){
        return $this->titulo_bloque;
    }
    public function setTituloBloque($titulo_bloque){
        $this->titulo_bloque = $titulo_bloque;
    }
    public function getDescripcionBloque(){
        return $this->descripcion_bloque;
    }
    public function setDescripcionBloque($descripcion_bloque){
        $this->descripcion_bloque = $descripcion_bloque;
    }
    public function getTextoBloque(){
        return $this->texto_bloque;
    }
    public function setTextoBloque($texto_bloque){
        $this->texto_bloque = $texto_bloque;
    }
    public function getIdMadreBloque(){
        return $this->id_madre_bloque;
    }
    public function setIdMadreBloque($id_madre_bloque){
        $this->id_madre_bloque = $id_madre_bloque;
    }
    public function getFechaActualizacionBloque(){
        return $this->fecha_actualizacion_bloque;
    }
    public function setFechaActualizacionBloque($fecha_actualizacion_bloque){
        $this->fecha_actualizacion_bloque = $fecha_actualizacion_bloque;
    }
    public function getIdCategoria(){
        return $this->id_categoria;
    }
    public function setIdCategoria($id_categoria){
        $this->id_categoria = $id_categoria;
    }
    public function getIcono(){
        return $this->icono;
    }
    public static function getBloquesByCategoria($id_categoria) :array{
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT * FROM bloque WHERE id_categoria = ? ORDER BY orden ASC");
        $stmt->execute([$id_categoria]);
        $bloques = array();

        while ($bloque = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $bloque_pasar = new Bloque(
                $bloque['id_bloque'],
                $bloque['orden'],
                $bloque['titulo'],
                $bloque['descripcion'],
                $bloque['texto'],
                $bloque['id_madre'],    
                $bloque['fecha_actualizacion'],
                $bloque['id_categoria'],
                $bloque['icono']
            );
            $bloques[] = $bloque_pasar;
        }
        return $bloques;
    }
    public static function getBloqueById($id_bloque) :Bloque{
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT * FROM bloque WHERE id_bloque = ? ");
        $stmt->execute([$id_bloque]);
        $bloque = $stmt->fetch(PDO::FETCH_ASSOC);
        $bloque_pasar = new Bloque(
            $bloque['id_bloque'],
            $bloque['orden'],
            $bloque['titulo'],
            $bloque['descripcion'],
            $bloque['texto'],
            $bloque['id_madre'],
            $bloque['fecha_actualizacion'],
            $bloque['id_categoria'],
            $bloque['icono']
        );
        return $bloque_pasar;
    }
}