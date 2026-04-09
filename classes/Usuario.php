<?php
// Clase Usuario: Maneja la autenticación y control de acceso de usuarios en el sistema.
// Incluye métodos para verificar roles y gestionar sesiones.
class Usuario
{
    // Propiedades privadas del usuario
    private string $nombre;
    private string $email;
    private string $password;
    private int $id_usuario;
    private string $rol;

    /**
     * @param $nombre
     * Nombre del usuario
     *
     * @param $email
     * Correo electrónico del usuario
     *
     * @param $password
     * Contraseña hasheada del usuario
     *
     * @param $id_usuario
     * Identificador único del usuario
     *
     * @param $rol
     * Rol del usuario (Admin, Editora, etc.)
     */

    // Constructor: Inicializa un objeto Usuario con los datos proporcionados
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

    // Metodo para verificar si el usuario actual es Administrador
    // Retorna true si el rol es "Admin", false en caso contrario
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

    // Metodo para verificar si el usuario actual es Editora
    // Retorna true si el rol es "editora", false en caso contrario
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

    // Metodo estático para iniciar sesión de un usuario
    // Verifica credenciales contra la base de datos y crea sesión si es válido
    // Parámetros: $nombre (puede ser email o nombre), $password
    // Retorna: true si login exitoso, false si falla
    public static function InicioSesion($nombre, $password) :bool
    {
        $db = DB::conectar();
        // Consulta para obtener usuario por email o nombre, uniendo con tabla rol
        $stmt = $db->prepare("SELECT u.email, u.password, u.nombre, r.nombre_rol AS rol FROM usuario LEFT JOIN rol r ON u.id_rol = r.id_rol WHERE email = ? OR nombre = ?");
        $stmt->execute([$nombre, $nombre]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$usuario) {
            return false; // Usuario no encontrado
        }
        // Verificar contraseña hasheada
        if (password_verify($password, $usuario['password'])) {
            // Crear sesión con objeto Usuario
            $_SESSION["usuaria"] = new Usuario($usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['id_usuario'], $usuario['rol']);
            return true;
        } else {
            return false; // Contraseña incorrecta
        }
    }

    // Metodo para eliminar la sesión (no implementado)
    public static function CerrarSesion() :void{
        if (isset($_SESSION["usuaria"])) {
            unset($_SESSION["usuaria"]);
        }
    }
}