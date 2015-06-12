<?php
include_once dirname(__FILE__).'/basics/login.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?php echo $SITE->getTitulo();?> - Contacto</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/customcss.css">
        <link rel="stylesheet" type="text/css" href="css/3d-falling-leaves.css">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/3d-falling-leaves.js"></script>
        <script src="js/rotate3Di.min.js"></script>
        <script type="text/javascript" src="js/jquery.jplayer.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
                            >> Contacto
                    </div>
                    <div class="contenido-contacto">
                        <div class="contacto-informacion">
                            <strong>Karina Delgado</strong><br>
                            Fot&oacute;grafa profesional<br><br>
                            <strong>Direcci&oacute;n:</strong> Calle #1 con carrera 1, frente al edificio 1, Ciudad con nombre en el pais con nombre<br>
                            <div style="overflow:hidden;" class="contacto-gmaps"><div id="gmap_canvas"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="#" id="get-map-data">---</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(7.8890971,-72.49668959999997),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(7.8890971, -72.49668959999997)});infowindow = new google.maps.InfoWindow({content:"<b>Karina Delgado</b><br/>Oficina<br/> Cucuta" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                        </div>
                        <div class="contacto-formulario">
                            <form>
                            <div class="form-group">
                              <label for="from-nombre">Nombre:</label>
                              <input type="text" class="form-control" name="from-nombre" id="from-nombre" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                              <label for="from-telefono">Tel&eacute;fono:</label>
                              <input type="tel" class="form-control" name="from-telefono" id="from-nombre" placeholder="Telefono">
                            </div>
                            <div class="form-group">
                              <label for="from-email">Correo electr&oacute;nico:</label>
                              <input type="email" class="form-control" name="from-email" id="from-email" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                              <label for="from-asunto">Asunto:</label>
                              <input type="text" class="form-control" name="from-asunto" id="from-asunto" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                              <label for="from-mensaje">Mensaje:</label>
                              <textarea class="form-control" id="from-mensaje" name="from-mensaje" rows="3" placeholder="Escriba su mensaje aquí"></textarea>
                            </div>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" name="no-robot"> Acepto enviar el formulario de contacto con mi informaci&oacute;n personal.
                              </label>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>                 
                    </div>
                </div>
            </div>
    </body>
</html>
