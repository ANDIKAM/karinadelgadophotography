<?php
include_once dirname(__FILE__).'/basic.php';
session_start();
if(isset($_REQUEST["cs"]) && $_REQUEST["cs"]=='1'){
    //Cerrar Sesión
    $_SESSION=array();
    $_SESSION["ADMIN"]="INACTIVO";
    $_SESSION["LASTTIME"]=0;
    if(session_status()==PHP_SESSION_ACTIVE){
        session_destroy();
    }
    
}
if(session_status()!=PHP_SESSION_ACTIVE){
        session_start();
    }
if(isset($_SESSION["LASTIME"]) && ($_SESSION["LASTIME"]-600)>time()){
    $_SESSION=array();
    $_SESSION["LASTTIME"]=0;
    $_SESSION['LOGIN_STATUS'] = "INACTIVO";
    $_SESSION['ADMIN'] = "INACTIVO";
}
$_SESSION["LASTIME"]=time();
if(isset($_REQUEST["USUARIO"]) && isset($_REQUEST["PASSWORD"])){
        $LOGIN = new loginfo();
        $LOGIN->IniciarSesion($_REQUEST["USUARIO"], $_REQUEST["PASSWORD"]);
}
if(!isset($_SESSION["LOGINFO"])){
    $LOGIN = new loginfo();
    $LOGIN->IniciarSesion("guest", "guest");
   
}else{
    //REFRESH SESSION
    $temp=$_SESSION["ADMIN"];
    $LOGIN = new loginfo();
    $LOGIN->IniciarSesion("guest", "guest");
    $_SESSION["ADMIN"]=$temp;
}
$LOGIN = $_SESSION["LOGINFO"];
$SITE = $LOGIN->GetInformacionSistema();
$PERSONALINFO = $LOGIN->GetInformacionPersonal();
$CONTACTINFO = $LOGIN->GetInformacionContacto();
$SERVICIOSINFO = $LOGIN->GetInformacionServicios();
$SLIDERINFO = $LOGIN->GetSliderPrincipal();
$GALERIAINFO = $LOGIN->GetGaleria();
$EMAILCONF = $LOGIN->GetEmailConf();
if($SITE->getTitulo()==""){
    $LOGIN->IniciarSesion("guest", "guest");
    $SITE = $LOGIN->GetInformacionSistema();
}
?>

