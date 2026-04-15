<?php
require_once "../classes/DB.php";
require_once "../classes/Usuario.php" ;
session_start();
// if (!$_SESSION["usuaria"]->controlUsuarioAdmin) {
//     header("location: ../index.php");
//     exit();
// }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Bienvenidas</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.medicosdelmundo.org/app/themes/mdm/library/medias/favicon/favicon-32x32.png">
</head>
<body>
    <header>
        <ul class="lista-nav">
            <li class="linea-nav">
                <article class="logo">
                    <a href="https://www.medicosdelmundo.org/" class="enlace-medicos">
                        <img src="../styles/img/logo.png" alt="logo">
                    </a>
                </article>
            </li>
            <li class="linea-nav">
                <h1>Bienvenida</h1>
            </li>
            <li class="linea-nav">
                <form method="POST" action="" class="form-cabecera">
                    <input type="text" class="input-nav" placeholder="Buscar">
                    <input type="submit" class="boton-invisible" value="Buscar">
                </form>
            </li>
        </ul>
    </header>
    <main>
        <section class="lista-editoras">
            <table>
                <thead>
                    <tr>
                        <th>Editora</th>
                        <th>Email</th>
                        <th>Eliminar</th>
                        <th>Editar</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                //Obtenemos todas usuarias
                $usuarias = Usuario::ListarUsuarias();
                //mostramos cada usuaria en la tabla
                foreach ($usuarias as $usuaria) {
                ?>
                        <tr>
                            <td><?php echo $usuaria->getNombre(); ?></td>
                            <td><?php echo $usuaria->getEmail(); ?></td>
                            <td>Aqui poner boton eliminar</td>
                            <td>Aqui poner boton editar</td>
                        </tr>

                <?php
                }
                ?>
                </tbody>
            </table>
        </section>

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
