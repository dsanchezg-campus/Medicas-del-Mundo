<?php
class Categoria{
    //identificador de la categoria
    private int $id_categoria;
    private string $nombre;
    private string $descripcion;
    //orden en la que se muestre la categoria
    private int $orden;
    private string $img_cat;
    //identificador de la categoria a la que pertenece
    private $id_madre;
    private string $fecha_actualizacion;
    private PDO $conn;

    /**
     * @param $id_categoria
     * @param $nombre
     * @param $descripcion
     * @param $orden
     * @param $img_cat
     * @param $id_madre
     * @param $fecha_actualizacion
     */
    public function __construct($id_categoria, $nombre, $descripcion, $orden, $img_cat, $id_madre, $fecha_actualizacion)
    {
        $this->id_categoria = $id_categoria;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->orden = $orden;
        $this->img_cat = $img_cat;
        $this->id_madre = $id_madre;
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    public function setDatos($id_categoria, $nombre, $descripcion, $orden, $img, $id_madre, $fecha_actualizacion)
    {
        $this->id_categoria = $id_categoria;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->orden = $orden;
        $this->img_cat = $img;
        $this->id_madre = $id_madre;
        $this->fecha_actualizacion = date("Y-m-d H:i:s");
    }

    /**
     * Actualiza la categoria en la BD
     * @return void
     */
    public function ActualizarCategoria(){
        $db = DB::conectar();
        $stmt = $db->prepare("UPDATE categorias SET nombre= ?, descripcion= ?, orden= ?, img= ?, fecha_actualizacion= ? WHERE id_categoria= ?");
        $stmt->execute([$this->nombre, $this->descripcion, $this->orden, $this->img_cat, $this->fecha_actualizacion, $this->id_categoria]);
    }
    /**
     * Añade el objeto a la BBDD
     * @return void
     */
    public function InsertarCategoria(){
        try {
            $db = DB::conectar();
            $stmt = $db->prepare("INSERT INTO categoria(nombre, descripcion, orden, img_cat, id_madre, fecha_actualizacion) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->nombre, $this->descripcion, $this->orden, $this->img_cat, $this->id_madre, $this->fecha_actualizacion]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    /**
     * Elimina la categoria en la BD
     * @return void
     */
    public function EliminarCategoria(){
        $db = DB::conectar();
        $stmt = $db->prepare("DELETE FROM categoria WHERE id_categoria = ?");
        $stmt->execute([$this->id_categoria]);
    }
    public function getIdCategoria()
    {
        return $this->id_categoria;
    }
    public function setIdCategoria($id_categoria)
    {
        return $this->id_categoria = $id_categoria;
    }
    public function getOrden()
    {
        return $this->orden;
    }
    public function setOrden($orden)
    {
        return $this->orden = $orden;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        return $this->nombre = $nombre;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        return $this->descripcion = $descripcion;
    }
    public function getImg()
    {
        return $this->img_cat;
    }
    public function setImg($img)
    {
        return $this->img_cat = $img;
    }
    public function getIdMadre()
    {
        return $this->id_madre;
    }
    public function setIdMadre($id_madre)
    {
        return $this->id_madre = $id_madre;
    }
    public function getFechaActualizacion()
    {
        return $this->fecha_actualizacion;
    }
    public function setFechaActualizacion($fecha_actualizacion)
    {
        return $this->fecha_actualizacion = $fecha_actualizacion;
    }
    /*
     * Devuelve cantidad de categorias en la bd
     * @return int
     */
    public function numeroCategorias(): int
    {
        $db = DB::conectar();
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM categoria WHERE id_madre = NULL");
        $stmt->execute();
        return $stmt->fetch();
    }
    /*
     * Devuelve un array con los objetos de categoria que haya en la BD
     *
     * @param Conexion objeto de Conexion, conecta a la BD
     * @return array | string objetos Categoria o un string en caso de error
     */
    public static function getCategorias() :array
    {
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT * FROM categoria WHERE id_madre IS NULL");
        $stmt->execute();
        $categorias = array();
        try {
            while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categoria = new Categoria(
                    $categoria['id_categoria'],
                    $categoria['nombre'],
                    $categoria['descripcion'],
                    $categoria['orden'],
                    $categoria['img_cat'],
                    $categoria['id_madre'],
                    $categoria['fecha_actualizacion']
                    );
                $categorias[] = $categoria;
            }
        }
        catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
        return $categorias;
    }
    /*
     * Devuelve un array con las subcategorias pertenecientes a una categoria
     *
     * @param Conexion objeto de Conexion, conecta a la BD
     * @param int id de la categoria madre a la que pertenece la subcategoria
     * @return array | string objetos Categoria o el error de la consulta
     */
    public static function getSubcategorias($id_madre) :array | string
    {
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT * FROM categoria WHERE id_madre = ?");
        $stmt->execute([$id_madre]);
        $subcategorias = array();
        try {
            while ($subcategoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $subcategoria = new Categoria(
                    $subcategoria['id_categoria'],
                    $subcategoria['nombre'],
                    $subcategoria['descripcion'],
                    $subcategoria['orden'],
                    $subcategoria['img_cat'],
                    $subcategoria['id_madre'],
                    $subcategoria['fecha_actualizacion']
                    );
                $subcategorias[] = $subcategoria;
            }
        }
        catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
        return $subcategorias;
    }
}