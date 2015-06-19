<?php
    include_once dirname(__FILE__).'/../basics/login.php';
    if($_SESSION["ADMIN"]!="ACTIVO"){
        header('Location: '.$SITE->getURLWeb().$prefix.'/admin/login.php');
    }

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
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
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
        function AgregarServicio(){
            $("<form id=\"new-service\" action=\"#\">"+
               "<div class=\"form-group\">"+
                  "<label for=\"servicio-nuevo\">Servicio Nuevo:</label>"+
                  "<textarea class=\"form-control\" rows=\"3\" id=\"servicio-nuevo\" name=\"servicio-nuevo\" placeholder=\"Ingrese descripción de servicio\"></textarea>"+
                  "<input type=\"hidden\" name=\"exec-action\" value=\"new-service\">"+
                "</div>"+
              "</form>").AndikamModalDialog({alto:'250',
                                             ancho:'500',
                                             titulo:"Agregar Servicio",
                                             ok:function(){
                                                 jQuery("#andikam-modal-window .panel-footer #Aceptar").attr("disabled","disabled");
                                                 $.post("helper_servicios.php", $("#new-service").serialize()).done(function(data) {
                                                        location.reload();
                                                });},
                                             buttons:{ok:true}});
        }
        function EditarServicio(id, text){
            text=replaceAll("<br>", "\n", text);
            $("<form id=\"edit-service\" action\"#\">"+
               "<div class=\"form-group\">"+
                  "<label for=\"servicio-edit\">Editar Servicio:</label>"+
                  "<textarea class=\"form-control\" rows=\"8\" id=\"servicio-edit\" name=\"servicio-edit\" placeholder=\"Ingrese descripción de servicio\">"+text+"</textarea>"+
                  "<input type=\"hidden\" name=\"exec-action\" value=\"edit-service\">"+
                  "<input type=\"hidden\" name=\"service-id\" value=\""+id+"\">"+
                "</div>"+
              "</form>").AndikamModalDialog({alto:'350',
                                             ancho:'500',
                                             titulo:"Editar Servicio",
                                             ok:function(){
                                                 jQuery("#andikam-modal-window .panel-footer #Aceptar").attr("disabled","disabled");
                                                 $.post("helper_servicios.php", $("#edit-service").serialize()).done(function(data) {
                                                        location.reload();
                                                });},
                                             buttons:{ok:true}});
        }
        function EliminarServicio(id){
            $("<div>¿Est&aacute seguro que desea eliminar este elemento de forma permanente?</div><form id=\"delete-service\" action=\"#\">"+
                  "<input type=\"hidden\" name=\"exec-action\" value=\"del-service\">"+
                  "<input type=\"hidden\" name=\"service-id\" value=\""+id+"\">"+
              "</form>").AndikamModalDialog({alto:'170',
                                             ancho:'500',
                                             titulo:"Eliminar Servicio",
                                             ok:function(){
                                                 jQuery("#andikam-modal-window .panel-footer #Aceptar").attr("disabled","disabled");
                                                 $.post("helper_servicios.php", $("#delete-service").serialize()).done(function(data) {
                                                        location.reload();
                                                });},
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
                        <li><a class="ajax-link" href="contacto.php"><i class="glyphicon glyphicon-earphone"></i><span> Contacto</span></a>
                        </li>
                        <li><a class="ajax-link" href="galeria.php"><i class="glyphicon glyphicon-picture"></i><span> Galería</span></a>
                        </li>
                        <li><a class="ajax-link" href="servicios.php"><i class="glyphicon glyphicon-camera"></i><span> Servicios</span></a>
                        </li>
                        <li><a class="ajax-link" href="#"><i class="glyphicon glyphicon-envelope"></i><span> Correo Electrónico</span></a>
                        </li>
                    </ul>
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

<!-- Ediciones Generales -->
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i>Servicios</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <h2>Edición de servicios ofrecidos en el sitio<br>
                        <small>A continuación edite, agregue o elimine servicios</small>
                    </h2>
                </div>
                <div class="col-lg-10 col-md-12" style="margin-top:50px">
                    <a class="btn btn-default" href="#" onClick="AgregarServicio()" role="button">Agregar Servicio</a>
                    <?php
                            $servicios= $SERVICIOSINFO->getServicios();
                            $cant=count($servicios);
                            if($cant>0){
                                echo "<ul class=\"servicios-editar\">";
                                for($i=0;$i<count($servicios);$i++){
                                    echo "<li class=\"servicio-item\" item-id=\"".$servicios[$i]["id"]."\"  order=\"".$servicios[$i]["ordenacion"]."\"><div class=\"texto\">".$servicios[$i]["descripcion"]."</div><div class=\"acciones\"><input id=\"Editar\" class=\"btn btn-default\" style=\"width:100px;margin-right:5px;\" onClick=\"EditarServicio('".$servicios[$i]["id"]."','".$servicios[$i]["descripcion"]."')\" type=\"button\" value=\"Editar\"><input id=\"Cancelar\" class=\"btn btn-default\" style=\"width:100px;\" type=\"button\" onClick=\"EliminarServicio('".$servicios[$i]["id"]."')\" value=\"Eliminar\"></div></li>";
                                }
                                echo "</ul>";
                            }
                            
                    ?>
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

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>


</body>
</html>
