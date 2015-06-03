<?php
include_once dirname(__FILE__).'/basics/login.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?php echo $SITE->getTitulo();?></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/customcss.css">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jquery.jplayer.js"></script>
        <script src="js/global.js"></script>
        <script src="js/index.js"></script>
    </head>
    <body>
        <div class="hidden">
            <?php echo "caching images... Descargar todas las Imagenes"; ?>
            <img src="img/spiner.gif" />
            <img src="galeria/01.jpg" />
            <img src="galeria/02.jpg" />
            <img src="galeria/03.jpg" />
            <img src="galeria/04.jpg" />
            <img src="galeria/05.jpg" />
            <img src="galeria/06.jpg" />
            <img src="galeria/07.jpg" />
            <img src="galeria/08.jpg" />
            <img src="galeria/09.jpg" />
        </div>

        <div class="arbol-right"></div>
        <div class="arbol-left"></div>
        <div class="background"></div>
        <div class="audioplayer jp-pause">
        </div>
        <div id="flyeffect" class="back-slider visible-lg-block visible-md-block visible-sm-block visible-xs-block">
            <!-- Spinner de carga de fondo-->
            <img id="spinner" class="center-img" src="img/spiner.gif">
            <!-- Menu móvil lateral-->
            <div class="hidden-lg hidden-md menu-mov"></div>
            <div class="logo hidden-lg hidden-md"></div>
        </div>
        
        <div class="container fixClass hidden-sm hidden-xs">
            <div class="logo"></div>
            <a href=""><div class="rs-facebook"></div></a>
            <a href=""><div class="rs-instagram"></div>
            <a href=""><div class="rs-500px"></div>
            
        </div>
        <div class="navbar-dsk hidden-sm hidden-xs">
            <div class="container informacion">
                    <!-- Menú normal superior-->
                    <div class="row">
                        <div id="menu-dsk">
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5"></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a href="index.php">Inicio</a></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a href="galeria.php">Galer&iacute;a</a></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a href="biografia.php">Biograf&iacute;a</a></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a href="servicios.php">Servicios</a></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a href="contacto.php">Contacto</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </body>
</html>