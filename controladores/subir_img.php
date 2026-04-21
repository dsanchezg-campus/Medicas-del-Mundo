<?php
require_once "../classes/DB.php";
$conn = DB::getConexion();
$error = ""; // Inicializamos variable de error
$exito = ""; // Inicializamos variable de éxito

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bloque = $_POST['id_bloque'];
    $updates = [];

    // Recoger datos
    if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
        $updates[] = "'" . mysqli_real_escape_string($conn, $_POST['titulo']) . "'";
    }

    // Manejo de la Imagen
    $target_dir = "../styles/img/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    if (!is_writable($target_dir)) {
        $error = "El directorio de imágenes no tiene permisos de escritura.";
    } elseif (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
        $nombre = $_FILES['portada']['name'];
        $temporal = $_FILES['portada']['tmp_name'];
        $carpeta = "imagenes/";
        $ruta = $carpeta . uniqid() . "_" . basename($nombre);

        if (move_uploaded_file($temporal, "../" . $ruta)) {
            $updates[] = "'" . mysqli_real_escape_string($conn, $ruta) . "'";
        } else {
            $error = "Error al mover el archivo de imagen.";
        }
    } elseif (isset($_FILES['portada']) && $_FILES['portada']['error'] !== UPLOAD_ERR_NO_FILE) {
        $error = "Error en la subida del archivo de imagen:(comprueba tamaño) " . $_FILES['portada']['error'];
    } else {
        // Si no suben foto, ponemos la predefinida (opcional, si quieres que tenga una por defecto)
        // $updates[] = "'imagenes/predefinido.png'";
        // Si prefieres dejarlo NULL o no incluirlo, déjalo como está tu código original:
        // (Tu código original solo añade la imagen si se sube una, lo mantengo así).
    }