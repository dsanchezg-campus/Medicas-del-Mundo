<?php
// Incluir las clases necesarias para manejar categorías, base de datos y bloques de contenido

require_once "../classes/Categoria.php";
require_once "../classes/DB.php";
require_once "../classes/Bloque.php";
require_once "../classes/Faq.php";

// OBLIGATORIO: Iniciar la sesión antes de hacer nada con $_SESSION
session_start();

// Opcional pero necesario si no usas autoloader:
// require_once 'tus_clases.php'; // Asegúrate de cargar las clases Categoria, Bloque y la de la usuaria.

// CRÍTICO: Primero comprobamos que la sesión 'usuaria' existe (isset).
// Si no lo haces y alguien entra sin loguearse, el código "peta" al intentar llamar a un metodo de algo que no existe.
if (!isset($_SESSION['usuaria']) || (!$_SESSION['usuaria']->controlUsuarioEditora() && !$_SESSION['usuaria']->controlUsuarioAdmin())) {
    // Si no hay sesión iniciada o no es editora/admin, redirigimos al inicio
    header("Location: /Medicas-del-Mundo/login.php");
    exit();
}


?>
<!doctype html>
<!-- Página principal del sitio web de Médicos del Mundo, muestra categorías y contenido -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/style.css">
    <title>Bienvenidas</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.medicosdelmundo.org/app/themes/mdm/library/medias/favicon/favicon-32x32.png">
</head>
<body>
<?php
include_once "header.php";
?>
<main>
    <section class="faq-container">

        <?php
        // Verificar si se ha pasado un parámetro 'categoria'
        if (isset($_GET['categoria'])) {
            $faqs = Faq::ListarFAQPorCategoria($_GET['categoria']);
        } else {
            // Si no hay categoría, mostrar todos los FAQs (opcional)
            $faqs = Faq::ListarFAQ();
        }

        if (count($faqs) > 0) {
            foreach ($faqs as $faq) {
                ?>
                <details class="faq-item">
                    <summary class="faq-question"><?php echo htmlspecialchars($faq->getPregunta()); ?></summary>
                    <p class="faq-answer"><?php echo nl2br(htmlspecialchars($faq->getRespuesta())); ?></p>
                </details>
                <?php
            }
        } else {
            echo "<p style='text-align: center;'>No hay preguntas frecuentes disponibles para esta categoría en este momento.</p>";
        }
        ?>

    </section>
</main>
<a href='index.php' class='volver-inicio'><img src='styles/img/casita.png' alt='regresa a inicio'></a>
<!-- Pie de página con información de contacto de Médicos del Mundo -->
<footer>
    <section class="footer-section">
        <h2>Médicos del Mundo España</h2>
        <p>Conde de Vilches, 15 · 28028, Madrid</p>
        <p>Lunes a viernes: 8:00 - 20:00</p>
        <p>
            Tel: <a href="tel:+34915436033">91 543 60 33</a> ·
            Email: <a href="mailto:informacion@medicosdelmundo.org">informacion@medicosdelmundo.org</a>
        </p>
        <p><a href="login.php">Iniciar Sesion</a></p>
    </section>
</footer>
</body>
</html>