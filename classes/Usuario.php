<?php
class Usuario
{
    private string $nombre;
    private string $email;
    private string $password;
    private int $id_usuario;
    private string $rol;
    public function __construct($nombre, $email, $password, $id_usuario, $rol)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->id_usuario = $id_usuario;
        $this->rol = $rol;
    }
    //GETTERS
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function controlUsuarioAdmin() :bool
    {
        if (isset($_SESSION["usuaria"])) {
            if ($_SESSION["usuaria"]->getRol() == "Admin") {
                return true;
            } else{
                return false;
            }
        } else {
            return false;
        }
    }
    public function controlUsuarioEditora() :bool
    {
        if (isset($_SESSION["usuaria"])) {
            if ($_SESSION["usuaria"]->getRol() == "editora") {
                return true;
            } else{
                return false;
            }
        } else {
            return false;
        }
    }
    public static function InicioSesion($nombre, $password) :bool
    {
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT u.email, u.password, u.nombre, r.nombre_rol AS rol FROM usuario LEFT JOIN rol r ON u.id_rol = r.id_rol WHERE email = ? OR nombre = ?");
        $stmt->execute([$nombre, $nombre]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$usuario) {
            return false;
        }
        if (password_verify($password, $usuario['password'])) {
            $_SESSION["usuaria"] = new Usuario($usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['id_usuario'], $usuario['rol']);
            return true;
        } else {
            return false;
        }
    }
    public function eliminarSesion()
    {
    }
}