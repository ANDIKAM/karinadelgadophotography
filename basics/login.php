<?php
include_once dirname(__FILE__).'/basic.php';
if(isset($_REQUEST["cs"]) && $_REQUEST["cs"]=='1'){
    //Cerrar Sesión
    $_SESSION=array();
    if(session_status()==PHP_SESSION_ACTIVE){
        session_destroy();
    }
    
}
session_start();
if(isset($_REQUEST["USUARIO"]) && isset($_REQUEST["PASSWORD"])){
        $LOGIN = new loginfo();
        $LOGIN->IniciarSesion($_REQUEST["USUARIO"], $_REQUEST["PASSWORD"]);
}
if(!isset($_SESSION["LOGINFO"])){
    $LOGIN = new loginfo();
    $LOGIN->IniciarSesion("guest", "guest");
   
}
$LOGIN = $_SESSION["LOGINFO"];
$SITE = $LOGIN->GetInformacionSistema();
$PERSONALINFO = $LOGIN->GetInformacionPersonal();
if($SITE->getTitulo()==""){
    $LOGIN->IniciarSesion("guest", "guest");
    $SITE = $LOGIN->GetInformacionSistema();
}
?>

