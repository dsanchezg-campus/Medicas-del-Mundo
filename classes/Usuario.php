<?php
class Usuario
{
    private $nombre;
    private $email;
    private $password;
    private $id_usuario;
    private $rol;
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
    public function controlUsuario()
    {
        if (isset($_SESSION["rol"])) {
            $rol = $_SESSION["rol"];
            $usuario = $_SESSION["usuario"];

            if ($rol != "admin") {
                session_unset();
                session_destroy();
                header("location: ../login.php");
                exit;
            }

        }
        else {
            session_unset();
            session_destroy();
            header("location: ../login.php");
            exit;
        }
    }
    public function inicioSesion()
    {
        if (isset($_SESSION["usuario"])) {
            $rol = $_SESSION["rol"];
            $usuario = $_SESSION["usuario"];

            if ($rol == "admin") {
                session_unset();
                header("location: ../admin.php");
                exit;
            }
            elseif ($rol == "editora") {
                session_unset();
                header("location: ../editora.php");
                exit;
            }
        }
    }
    public function eliminarSesion()
    {
    }
}