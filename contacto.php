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
        <script src="js/global.js"></script>
        <script src="js/biografia.js"></script>
    </head>
    <script type="text/javascript">
        function ValidarForm(){
            var Msg ="";
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            $( ":input" ).css('border-color','#CCC');
            if ($('#from-nombre').val()=="" || $('#from-nombre').val().length < 3) {
                $('#from-nombre').css('border-color','#FF0000');
                Msg += "- Nombre Campo Obligatorio \n";
            }
            if ($('#from-telefono').val().length < 6  || isNaN($('#from-telefono').val()) || $('#from-telefono').val()=="") {
                $('#from-telefono').css('border-color','#FF0000');
                Msg += "- Debe Introducir un número teléfono valido \n";
            }
            if (!regex.test($('#from-email').val().trim())) {
                $('#from-email').css('border-color','#FF0000');
                Msg += "- La dirección de correo no es valida \n";
            }
            if ($('#from-asunto').val()=="") {
                $('#from-asunto').css('border-color','#FF0000');
                Msg += "- Asunto Campo Obligatorio \n";
            }
            if ($('#from-mensaje').val()=="") {
                $('#from-mensaje').css('border-color','#FF0000');
                Msg += "- Mensaje Campo Obligatorio \n";
            }
            return Msg;
        }
        function EnviarContacto(){
            
            if($("#condiciones").is(':checked')) {
                var ErrorMsg = ValidarForm();
                if(ErrorMsg==""){
                    var url='Correo.php?'+
                    '&from-nombre='+$('#from-nombre').val()+
                    '&from-telefono='+$('#from-telefono').val()+
                    '&from-email='+$('#from-email').val()+
                    '&from-asunto='+$('#from-asunto').val()+
                    '&from-mensaje='+$('#from-mensaje').val()+
                    '&SendMail=S';
                    document.location.href = url;
                }else{
                    alert(ErrorMsg);
                }
            } else {
                    alert("Debe aceptar las condiciones para enviar su información de contacto");
            }
        }
    </script>
    <body>
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
                            >> Contacto
                    </div>
                    <div class="contenido-contacto">
                        <div class="contacto-informacion">
                            <strong style="font-size: x-large" ><?php echo $CONTACTINFO->getNombre(); ?></strong><br>
                            <?php echo $CONTACTINFO->getDescripcion(); ?><br><br>
                            <?php echo $CONTACTINFO->getDireccion()!=""?"<strong>Direcci&oacute;n:&nbsp;</strong>".$CONTACTINFO->getDireccion().", ".$CONTACTINFO->getPais()."<br>":""; ?>
                            <?php echo $CONTACTINFO->getTelefono()!=""?"<strong>Tel&eacute;fono:&nbsp;</strong>".$CONTACTINFO->getTelefono()."<br>":""; ?>
                            <?php echo $CONTACTINFO->getCelular()!=""?"<strong>Celular:&nbsp;</strong>".$CONTACTINFO->getCelular()."<br>":""; ?>
                            <?php echo $CONTACTINFO->getCorreo()!=""?"<strong>Correo Electr&oacute;nico:&nbsp;</strong>".$CONTACTINFO->getCorreo()."<br>":""; ?>
                        </div>
                        <div class="contacto-formulario">
                            <form action="Correo.php" method="post" >
                            <div class="form-group">
                              <label for="from-nombre">Nombre:</label>
                              <input type="text" class="form-control" name="from-nombre" id="from-nombre" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                              <label for="from-telefono">Tel&eacute;fono:</label>
                              <input type="tel" class="form-control" name="from-telefono" id="from-telefono" placeholder="Telefono">
                            </div>
                            <div class="form-group">
                              <label for="from-email">Correo electr&oacute;nico:</label>
                              <input type="email" class="form-control" name="from-email" id="from-email" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                              <label for="from-asunto">Asunto:</label>
                              <input type="text" class="form-control" name="from-asunto" id="from-asunto" placeholder="Asunto">
                            </div>
                            <div class="form-group">
                              <label for="from-mensaje">Mensaje:</label>
                              <textarea class="form-control" id="from-mensaje" name="from-mensaje" rows="3" placeholder="Escriba su mensaje aquí" maxlength="300"></textarea>
                            </div>
                            <div class="checkbox">
                              <label>
                                <input name="condiciones" id="condiciones" type="checkbox" name="no-robot"> Acepto enviar el formulario de contacto con mi informaci&oacute;n personal.
                                <input type="hidden" class="form-control" name="SendMail" id="SendMail" value="S">
                              </label>
                            </div>
<!--                            <button  onclick="EnviarContacto()" style="font-size: large" class="btn btn-primary">Enviar Mensaje</button>-->
                                <input style="font-size: large" class="btn btn-primary" type="button" name="actualizar" id="button" value="Enviar Mensaje" onclick="EnviarContacto()" />
                            </form>
                        </div>                 
                    </div>
                    <div class="visible-lg-block visible-md-block col-lg-1 col-md-1">&nbsp;</div><div class="mosca col-md-10 col-lg-10">Todas las fotograf&iacute;as y derechos reservados por <strong>&copy; Karina Delgado Photography</strong> / Hecho por <a href="http://www.andikam.com" target="_blank">ANDIKAM SAS</a> Colombia 2015</div>
                </div>
            </div>
    </body>
					<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64261247-1', 'auto');
  ga('send', 'pageview');

</script>
</html>
