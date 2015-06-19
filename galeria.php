<?php
include_once dirname(__FILE__).'/basics/login.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?php echo $SITE->getTitulo();?> - Galeria</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/customcss.css">
        <link rel="stylesheet" type="text/css" href="css/3d-falling-leaves.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/3d-falling-leaves.js"></script>
        <script src="js/rotate3Di.min.js"></script>
        <script type="text/javascript" src="js/jquery.jplayer.js"></script>
        <script>
            var GALERIAINFO=<?php echo $GALERIAINFO->JSONEncode(); ?>;
            var fotoact=0;
        </script>
        <script src="js/global.js"></script>
        <script src="js/biografia.js"></script>
        <script src="js/galeria.js"></script>
    </head>
    <body>
        <div class="center-img-container"><img id="spinner" class="center-img" src="img/spiner.gif"/></div>
        <div class="hidden">
            <?php echo "caching images... Descargar todas las Imagenes"; ?>
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
                        >> Galeria
                </div>
                <div class="contenido">
                    <div class="galeria-principal">
                    <span class="left-arrow fa fa-arrow-circle-left"></span>
                    <span class="right-arrow fa fa-arrow-circle-right"></span>
                    <?php
                        echo $GALERIAINFO->printListaPlana();
                    ?>    
                    </div>
                    <div class="miniaturas hidden-xs hidden-sm">
                    <?php
                        echo $GALERIAINFO->printListaPlana();
                    ?>    
                    </div>
                </div>
        </div>
            </div>
        </div>
    </body>
</html>
