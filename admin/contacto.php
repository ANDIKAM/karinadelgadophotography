<?php
    include_once dirname(__FILE__).'/../basics/login.php';
    if($_SESSION["ADMIN"]!="ACTIVO"){
        header('Location: '.$SITE->getURLWeb().$prefix.'/admin/login.php');
    }
    if(isset($_REQUEST["exec-action"])){ //Verifica si hay acciones pendientes
    //Index
        if($_REQUEST["exec-action"]==="update-smtp-configuration"){ //Elimina un servicio
                $EMAILCONF->saveData($_REQUEST);
            }
    }
    //update-contact-information
    if(isset($_REQUEST["exec-action"])){ //Verifica si hay acciones pendientes
    //Index
        if($_REQUEST["exec-action"]==="update-contact-information"){ //Elimina un servicio
                $CONTACTINFO->setNombre($_REQUEST["nombre"]);
                $CONTACTINFO->setDescripcion($_REQUEST["descripcion"]);
                $CONTACTINFO->setPais($_REQUEST["pais"]);
                $CONTACTINFO->setDireccion($_REQUEST["direccion"]);
                $CONTACTINFO->setCelular($_REQUEST["celular"]);
                $CONTACTINFO->setTelefono($_REQUEST["telefono"]);
            }
    }
    
    $EMAILCONF_TEMP = $EMAILCONF->getData()[0];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>ADMINISTRADOR <?php echo $SITE->getTitulo(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $ADK_UTILS->toHTMLEntities($SITE->getDescripcion()); ?>">
    <meta name="author" content="ANDIKAM SAS">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='css/animate.min.css' rel='stylesheet'>
    <link href='css/basic.css' rel='stylesheet'>
    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
    <script src="js/andikam.modal.js"></script>
    <script src="js/jquery.sortable.min.js"></script>
    <script src="js/utilities.js"></script>
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <script>
        function ActualizarContactInformation(){
            $("#contact-data").submit();
        }
        
        function ActualizarSMTP(){
            $("<div>¿Est&aacute; seguro de actualizar esta informaci&oacute;n?, un par&aacute;metro mal configurado podria ocasionar problemas para el env&iacute;o de mensajes desde su p&aacute;gina WEB.</div>").AndikamModalDialog({alto:'250',
                                             ancho:'350',
                                             titulo:"Actualizar datos SMTP",
                                             ok:function(){
                                                  jQuery("#SMTP-data").submit();
                                                 },
                                             buttons:{ok:true}});
        }
    </script>
</head>

<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
                <span><?php echo "Administrador"?></span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"><?php echo $LOGIN->getNombre(); ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Perfil</a></li>
                    <li class="divider"></li>
                    <li><a href="login.php?cs=1"><span style="font-family:'Arial'"><?php echo "Cerrar Sesión"; ?></span></a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->
            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> <?php echo "Lista"; ?> <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $SITE->getURLWeb().$prefix; ?>">Ir a la WEB</a></li>
                    </ul>
                </li>
                <li>
                    <form class="navbar-search pull-left">
                        <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li>
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Menú</li>
                        <li><a class="ajax-link" href="index.php"><i class="glyphicon glyphicon-home"></i><span> Inicio</span></a>
                        </li>
                        <li><a class="ajax-link" href="personal.php"><i class="glyphicon glyphicon-user"></i><span> Sobre mí</span></a>
                        </li>
                        <li><a class="ajax-link" href="ui.html"><i class="glyphicon glyphicon-earphone"></i><span> Contacto</span></a>
                        </li>
                        <li><a class="ajax-link" href="galeria.php"><i class="glyphicon glyphicon-picture"></i><span> Galería</span></a>
                        </li>
                        <li><a class="ajax-link" href="servicios.php"><i class="glyphicon glyphicon-camera"></i><span> Servicios</span></a>
                        </li>
                        <li><a class="ajax-link" href="ui.html"><i class="glyphicon glyphicon-envelope"></i><span> Correo Electrónico</span></a>
                        </li>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Alerta!</h4>

                <p>Debe tener <a href="http://es.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    habilitado para utilizar este sitio.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Home</a>
        </li>
    </ul>
</div>
<!-- Introducción -->
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i>Introduccion</h2>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <h2>Página principal "Home"<br>
                        <small>Sitio premium ofrecido por ANDIKAM SAS, Potenciado por HTML5, JavaScript y SQLite</small>
                    </h2>
                </div>
                <div class="col-lg-12 col-md-12">
                    <p>
                        Puede utilizar esta página para editar todo lo que desea que aparezca en su sitio web referente a las características generales del mismo, desde el título, la descripción y las imágenes del SLIDER principal.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ediciones Generales -->
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i>Parámetros generales</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-8 col-md-8">
                  <h2 style="margin-top:20px;">Edici&oacute;n de datos de contacto:<br>
                        <small>En esa secci&oacute;n podr&aacute; configurar los datos de contacto y servidor de emails.</small>
                  </h2>
                   <h3 style="margin-top:20px;">Datos de contacto<br>
                   </h3>
                   <form id="contact-data" action="#SELF" style="margin-left:40px;">
                       <input type="hidden" name="exec-action" value="update-contact-information"/>
                       <input type="hidden" name="texto" value="---"/>
                       <input type="hidden" name="estado" value="---"/>
                       <input type="hidden" name="ciudad" value="---"/>
                       <input type="hidden" name="longitud" value="---"/>
                       <input type="hidden" name="latitud" value="---"/>
                        <div class="form-group" >
                          <label for="nombre">Nombre:</label>
                          <input type="text" value="<?php echo $CONTACTINFO->getNombre(); ?>" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre">
                        </div>
                       <div class="form-group">
                          <label for="descripcion">Descripci&oacute;n:</label>
                          <input type="text" value="<?php echo $CONTACTINFO->getDescripcion(); ?>" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese descripción o profesión">
                        </div>
                       <div class="form-group">
                          <label for="pais">Pa&iacute;s:</label>
                          <input type="text" value="<?php echo $CONTACTINFO->getPais(); ?>" class="form-control" name="pais" id="pais" placeholder="Ingrese un país">
                       </div>
                       <div class="form-group">
                          <label for="direccion">Direcci&oacute;n:</label>
                          <input type="text" value="<?php echo $CONTACTINFO->getDireccion(); ?>" class="form-control" name="direccion" id="direccion" placeholder="Ingrese una dirección">
                       </div>
                       <div class="form-group">
                          <label for="celular">Celular:</label>
                          <input type="text" value="<?php echo $CONTACTINFO->getCelular(); ?>"  class="form-control" name="celular" id="celular" placeholder="Ingrese un celular">
                       </div>
                       <div class="form-group">
                           <label for=telefono">Tel&eacute;fono:</label>
                          <input type="text" value="<?php echo $CONTACTINFO->getTelefono(); ?>" class="form-control" name="telefono" id="telefono" placeholder="Ingrese un teléfono fijo">
                       </div>
                       <div style="width: 100%; text-align: right"><a class="btn btn-primary" style="width: 130px;" href="#" onClick="ActualizarContactInformation()" role="button">Actualizar</a></div>
                   </form>
                   <h3 style="margin-top:20px;">Datos de servidor de correos<br>
                   </h3>
                   <form id="SMTP-data" action="#SELF" style="margin-left:40px;width:40%">
                       <input type="hidden" name="exec-action" value="update-smtp-configuration"/>
                        <div class="form-group" >
                          <label for="SMTPAuth">SMTPAuth:</label>
                          <select class="form-control" name="SMTPAuth" id="SMTPAuth">
                            <option <?php echo $EMAILCONF_TEMP["SMTPAuth"]=="true"?"selected=true":""; ?> value="true">Si</option>
                            <option <?php echo $EMAILCONF_TEMP["SMTPAuth"]=="false"?"selected=true":"";?> value="false">No</option>
                          </select>
                        </div>
                        <div class="form-group" >
                          <label for="nombre">SMTPSecure:</label>
                          <select class="form-control" name="SMTPSecure" id="SMTPSecure">
                            <option <?php echo $EMAILCONF_TEMP["SMTPSecure"]=="ssl"?"selected=true":"";?>  value="ssl">SSL</option>
                            <option <?php echo $EMAILCONF_TEMP["SMTPSecure"]=="tls"?"selected=true":"";?> value="tls">TLS</option>
                            <option <?php echo $EMAILCONF_TEMP["SMTPSecure"]=="none"?"selected=true":"";?> value="none">Ninguno</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="HOST">HOST - Servidor:</label>
                          <input type="text" value="<?php echo isset($EMAILCONF_TEMP["HOST"])?$EMAILCONF_TEMP["HOST"]:""; ?>" class="form-control" name="HOST" id="HOST" placeholder="IP o Dominio servidor SMTP">
                        </div>
                        <div class="form-group">
                          <label for="Port">Puerto:</label>
                          <input type="text" value="<?php echo isset($EMAILCONF_TEMP["Port"])?$EMAILCONF_TEMP["Port"]:""; ?>" class="form-control" name="Port" id="Port" placeholder="Puerto de conexión con servidor SMTP">
                        </div>
                       <div class="form-group">
                          <label for="Username">Nombre de usuario:</label>
                          <input type="text" value="<?php echo isset($EMAILCONF_TEMP["Username"])?$EMAILCONF_TEMP["Username"]:""; ?>" class="form-control" name="Username" id="Username" placeholder="Nombre de usuario">
                        </div>
                        <div class="form-group">
                          <label for="Pass">Password:</label>
                          <input type="text" value="<?php echo isset($EMAILCONF_TEMP["Pass"])?$EMAILCONF_TEMP["Pass"]:""; ?>" class="form-control" name="Pass" id="Pass" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                          <label for="SetFrom">Enviado por:</label>
                          <input type="text" value="<?php echo isset($EMAILCONF_TEMP["SetFrom"])?$EMAILCONF_TEMP["SetFrom"]:""; ?>" class="form-control" name="SetFrom" id="SetFrom" placeholder="Enviado por (alias)">
                        </div>
                        <div class="form-group">
                          <label for="SetFromName">Nombre de remitente:</label>
                          <input type="text" value="<?php echo isset($EMAILCONF_TEMP["SetFromName"])?$EMAILCONF_TEMP["SetFromName"]:""; ?>" class="form-control" name="SetFromName" id="SetFromName" placeholder="Nombre de remitente">
                        </div>
                        <div class="form-group">
                          <label for="AddReplyTo">Responder a:</label>
                          <input type="text" class="form-control" name="AddReplyTo" id="AddReplyTo" value="<?php echo isset($EMAILCONF_TEMP["AddReplyTo"])?$EMAILCONF_TEMP["AddReplyTo"]:""; ?>" placeholder="Dirección de email de respuesta">
                        </div>
                       <div style="width: 100%; text-align: right"><a class="btn btn-primary" style="width: 130px;" href="#" onClick="ActualizarSMTP()" role="button">Actualizar</a></div>
                   </form>
                  
                </div>
            </div>
        </div>
    </div>
</div>


    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <?php echo $SITE->getTitulo(); ?> 2015</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://www.andikam.com">ANDIKAM SAS</a></p>
    </footer>

</div><!--/.fluid-container-->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/charisma.js"></script>
</body>
</html>
