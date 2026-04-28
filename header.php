<!-- Cabecera con logo y barra de búsqueda -->
    <header>
        <ul class="lista-nav">
            <li class="linea-nav">
                <article class="logo">
                    <a href="https://www.medicosdelmundo.org/" class="enlace-medicos">
                        <img src="/Medicas-del-Mundo/styles/img/logo.png" alt="logo">
                    </a>
                </article>
            </li>
            <?php if(isset($_SESSION['usuaria'])) { ?>
            <li class="lista-nav">
                <?php if (($_SESSION['usuaria'])->ControlUsuarioAdmin()):?>
                <a href="/Medicas-del-Mundo/admin/ver_editoras.php">Ver editoras</a>
                <?php elseif(($_SESSION['usuaria'])->ControlUsuarioEditora()):?>
                <a href="/Medicas-del-Mundo/editora/perfil.php">Ver mi perfil</a>
                <?php endif;?>
            </li>
            <?php } ?>
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