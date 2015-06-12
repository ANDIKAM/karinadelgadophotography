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
        <div class="container fixClass hidden-sm hidden-xs">
            <div class="logo"></div>
            <a href=""><div class="rs-facebook"></div></a>
            <a href=""><div class="rs-instagram"></div>
            <a href=""><div class="rs-500px"></div>
            
        </div>
        <div class="menu-movil-container menu-mov-oculto hidden-lg hidden-md">
                <div class="menu-item-mov"><a href="index.php">Inicio</a></div>
                <div class="menu-item-mov"><a href="galeria.php">Galer&iacute;a</a></div>
                <div class="menu-item-mov"><a href="biografia.php">Biograf&iacute;a</a></div>
                <div class="menu-item-mov"><a href="servicios.php">Servicios</a></div>
                <div class="menu-item-mov"><a href="contacto.php">Contacto</a></div>
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
        <div class="container">
                <div class="row">
                    <div class="titulo-pagina">
                            >> Servicios
                    </div>
                    <div class="contenido">
                        <ul class="servicios-lista">
                            <li>
                                Somos una empresa con años de experiencia en fotografía y video profesional combinada con un entusiasmo excepcional, nuestro estilo visual único y contemporáneo junto con los mejores equipos nos permite ofrecerle un estilo natural y creativo.
                            </li>
                            <li>
                                Nos caracteriza una profunda dedicación en cuanto a tiempo y producción de cada sesión fotográfica, por lo cual tomamos un número limitado de clientes para poder brindarle una experiencia verdaderamente personalizada, reserva con tiempo!
                            </li>
                            <li>
                                Contamos con vestuario adecuado para maternidad y el mejor asesoramiento de imagen para eventos: niños, familiares, quinceañeras, pre-bodas, bodas, post-bodas o cualquier tipo de fotografía que necesite. 
                            </li>
                            <li>
                                Tenemos disponible varios paquetes de sesión fotográfica, contáctenos directamente para aclarar sus inquietudes a través de las redes sociales o de la página contacto.
                            </li>
                            <li>
                                El trabajo se entrega solo en digital, las fotos son retocadas y personalizadas.
                            </li>
                            <li>
                                Visítanos en nuestras oficinas para conocer nuestro material de impresiones, álbumes y mosaicos.
                            </li>
                        </ul>                        
                    </div>
                </div>
            </div>
    </body>
</html>
