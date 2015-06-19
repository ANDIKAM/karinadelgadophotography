<?php
include_once dirname(__FILE__).'/basics/login.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?php echo $SITE->getTitulo();?> - Servicios</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/customcss.css">
        <link rel="stylesheet" type="text/css" href="css/3d-falling-leaves.css">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/3d-falling-leaves.js"></script>
        <script src="js/rotate3Di.min.js"></script>
        <script type="text/javascript" src="js/jquery.jplayer.js"></script>
        <script src="js/global.js"></script>
        <script src="js/biografia.js"></script>
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
        <div class="leaves-right"></div>
        <div class="leaves-left"></div>
        <div class="arbol-right"></div>
        <div class="arbol-left"></div>
        <div class="arbol-movil"></div>
        <div class="background"></div>
        <div class="audioplayer jp-pause">
        </div>
        <div class="hidden-lg hidden-md menu-mov "></div>
        <div class="logo"></div>
        <a href="https://www.facebook.com/karina.delgado.14473" target="_blank"><div class="rs-facebook"></div></a>
        <a href="https://instagram.com/karinadelgadofotografa/" target="_blank"><div class="rs-instagram"></div></a>
        <a href="https://500px.com/djkarina" target="_blank"><div class="rs-500px"></div></a>
        <div class="menu-movil-container menu-mov-oculto hidden-lg hidden-md">
                <a href="index.php"><div class="menu-item-mov">Inicio</div></a>
                <a href="galeria.php"><div class="menu-item-mov">Galer&iacute;a</div></a>
                <a href="biografia.php"><div class="menu-item-mov">Biograf&iacute;a</div></a>
                <a href="servicios.php"><div class="menu-item-mov">Servicios</div></a>
                <a href="contacto.php"><div class="menu-item-mov">Contacto</div></a>
        </div>
        <div class="navbar-dsk hidden-sm hidden-xs">
            <div class="container informacion">
                    <!-- Menú normal superior-->
                    <div class="row">
                        <div id="menu-dsk">
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5"></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a class="first" href="index.php">Inicio</a></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a class="menu" href="galeria.php">Galer&iacute;a</a></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a class="menu" href="biografia.php">Biograf&iacute;a</a></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a class="menu" href="servicios.php">Servicios</a></div>
                                    <div class="menu-item-dsk col-lg-1 col-md-1"><a class="menu" href="contacto.php">Contacto</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="titulo-pagina">
                        >> Servicios
                </div>
                <div class="contenido">
                    <?php
                        echo $SERVICIOSINFO->printListaServicios();
                    ?>
                </div>
                <div class="visible-lg-block visible-md-block col-lg-1 col-md-1">&nbsp;</div><div class="mosca col-md-10 col-lg-10">Todas las fotograf&iacute;as y derechos reservados por <strong>&copy; Karina Delgado Photography</strong> / Hecho por <a href="http://www.andikam.com" target="_blank">ANDIKAM SAS</a> Colombia 2015</div>
            </div>
        </div>
    </body>
</html>
