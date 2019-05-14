<!DOCTYPE html>
<html lang="pt-br">
    <head>

        <title>Área Administrativa</title>
        <meta charset=UTF-8> 
        <meta name=viewport content="width=device-width, initial-scale=1.0">
        <meta name=description content="<?php echo $metaTag ?>">
        <meta name=keywords content="Modelo PHP HTML5 CSS3"> 
        <meta name=author content='Giovani Wingter'>
        <meta name=modelo-plao content="integracao php mysql poo html5 css3"> 

        <!-- favicon, arquivo de imagem podendo ser 8x8 - 16x16 - 32x32px com extensão .ico -->
        <link rel="shortcut icon" href="" type="image/x-icon">

        <!-- CSS PADRÃO -->
        <link rel="stylesheet" href="<?php echo _URLBASE_ . "public/css/estilo.css" ?>">

        <!-- Telas Responsivas -->
        <link rel=stylesheet media="screen and (max-width:480px)" href="<?php echo _URLBASE_ ?>css/estilo480.css"> <!-- ate 5.5" smart -->
        <link rel=stylesheet media="screen and (min-width:481px) and (max-width:768px)" href="<?php echo _URLBASE_ ?>css/estilo768.css"> <!-- de 5.5" a 6.7" fablet -->
        <link rel=stylesheet media="screen and (min-width:769px) and (max-width:1024px)" href="<?php echo _URLBASE_ ?>css/estilo1024.css"> <!-- tablet -->
        <link rel=stylesheet media="screen and (min-width:1025px)" href="<?php echo _URLBASE_ ?>css/estilo1025.css"> 

        <!-- Auxiliares -->
        <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">

        <!-- Endereço -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="<?php echo _URLBASE_; ?>/public/js/LocationManager.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0jIDGCxroPfUVdJzAGqKgnSGzy55jleg"
        async defer></script>
        
        <!-- Toast -->
        <link rel="stylesheet"  href="<?php echo _URLBASE_; ?>public/css/jquery.toast.min.css">
        <script src="<?php echo _URLBASE_; ?>public/js/jquery.toast.min.js"></script>
        <script src="<?php echo _URLBASE_; ?>public/js/toast.js"></script>
        
        <!-- Ajax -->
        <script src="<?php echo _URLBASE_; ?>public/js/funcoes.js"></script>
    </head>
    <body>

        <div id=container>
            <header>
                <section>
                    <h1>Games<sub>4</sub>All</h1>
                    <h2>Área Administrativa </h2>
                </section>
                <section>                    
                </section>
            </header>
            <main>            
                <aside>
                    <?php require_once './src/view/adm/menu.php'; ?>
                </aside>

                <article>
                    <?php
                    if (isset($_GET['page']) && $_GET['page'] != "") {
                        $page = $_GET['page'];
                        if (isset($_GET['folder']) && $_GET['folder'] != "") {
                            $folder = $_GET['folder'];
                            require_once "./src/view/adm/$folder/$page.php";
                        }
                    }
                    ?>
                </article>
            </main>
            <footer>
                <ul class="icons">
                    <li><a href="#"><img src="public/img/icon1.jpg" alt="">Facebook</a></li>
                    <li><a href="#"><img src="public/img/icon2.jpg" alt="">Twitter</a></li>
                    <li><a href="#"><img src="public/img/icon3.jpg" alt="">LinkedIn</a></li>
                </ul>
            </footer>
        </div>


</html>
