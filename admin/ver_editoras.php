<?php
// Incluir las clases necesarias para acceder a la base de datos y gestionar usuarios
require_once "../classes/Usuario.php";
require_once "../classes/DB.php";
require_once "../classes/Contenido.php";
require_once "../classes/Categoria.php";
require_once "../classes/Faq.php";
require_once "../classes/Bloque.php";
// Iniciar la sesión para acceder a datos de usuario
session_start();
// CONTROL DE ACCESO ADMIN
// Si no tiene permisos, redirige a la página principal
require_once "../controladores/control_admin.php";
?>
<!doctype html>
<html lang="es">
<head>
    <!-- Definir codificación de caracteres UTF-8 -->
    <meta charset="UTF-8">
    <!-- Configuración de viewport para responsividad -->
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Compatibilidad con versiones antiguas de Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Incluir CSS personalizado -->
    <link rel="stylesheet" href="../styles/style.css">
    <title>Bienvenidas</title>
    <!-- Favicon de la página -->
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.medicosdelmundo.org/app/themes/mdm/library/medias/favicon/favicon-32x32.png">
</head>
<body>
<!-- Encabezado con navegación -->
<?php
require_once "../header.php";
?>
<!-- Contenido principal -->
<main>
    <!-- Tabla con lista de editoras registradas -->
    <section class="lista-editoras">
        <table>
            <!-- Encabezados de la tabla -->
            <thead>
            <tr>
                <th>Editora</th>
                <th>Email</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <!-- Cuerpo de la tabla con datos de editoras -->
            <tbody>
            <?php
            // Obtener todas las usuarias/editoras registradas en el sistema
            $usuarias = Usuario::ListarUsuarias();
            // Iterar sobre cada usuaria y mostrar sus datos en una fila de la tabla
            foreach ($usuarias as $usuaria) {
                ?>
                <tr>
                    <!-- Nombre de la editora -->
                    <td><?php echo $usuaria->getNombre(); ?></td>
                    <!-- Email de la editora -->
                    <td><?php echo $usuaria->getEmail(); ?></td>
                    <!-- Botón para eliminar a la editora (por implementar) -->
                    <td><a href="editar_editora.php?page=<?php echo $usuaria->getId(); ?>">Editar</a></td>
                    <!-- Botón para editar datos de la editora (por implementar) -->
                    <td><a href="/controladores/eliminar_editora.php?page=<?php echo $usuaria->getId(); ?>" onclick="return confirm('¿Estás segura de eliminar esta Editora?');">Eliminar</a></td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>
    </section>

    <!-- Botón para agregar una nueva editora -->
    <section class="anadir-editoras">
        <a class="enlace-crear-editora" href="">
            <article class="texto-crear-editora">
                <h1>+</h1>
                <h3>Añadir Editora</h3>
            </article>
        </a>
    </section>
</main>
</body>
