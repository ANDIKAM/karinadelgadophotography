<?php
include_once dirname(__FILE__).'/../basics/basic.php';
$prefix="";
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
class DataBase{
    private $SQLHandle;
    function DataBase()
    {
        $this->SQLHandle= new SQLite3(dirname(__FILE__)."/../data/SQLLiteDB.db");
    }
    private function ExecQuery($Query,$Type){
        $Resultado = $this->SQLHandle->query($Query);
        if($Resultado===true || $Resultado===false){
            return $Resultado;
        }
        if($Type===2){
            $ResultadoAray=array();
            while($Arr=$Resultado->fetchArray(SQLITE3_ASSOC)){
                $ResultadoAray[]=$Arr;
            }
            return $ResultadoAray;
        }
        return $Resultado;
    }
    public function ExecSelect($Query){
        return $this->ExecQuery($Query,2);
    }
    public function ExecInsert($Query){
        return $this->ExecQuery($Query,1);
    }
    public function ExecUpdate($Query){
        return $this->ExecQuery($Query,3);
    }
    public function ExecDelete($Query){
        return $this->ExecQuery($Query,4);
    }
}

class siteinfo extends HTMLUtils{
    private $titulo;
    private $creditos;
    private $DataBase;
    private $URLDoc;
    private $URLWeb;
    private $descripcion;
    private $URLEmail;
    private $PathToFile;
    function siteinfo($URLDoc,$URLWeb){
        $this->PathToFile=$URLDoc.'/data/siteinfo.xml';
        $this->DataBase= new DataBase();
        $RESULTADO= $this->DataBase->ExecSelect("SELECT * FROM siteinfo");
        $this->titulo=$RESULTADO[0]["titulo"];
        $this->URLEmail=$RESULTADO[0]["emailURL"];
        $this->creditos=$RESULTADO[0]["creditos"];
        $this->descripcion = $RESULTADO[0]["descripcion"];
        $this->URLDoc = $URLDoc;
        $this->URLWeb = $URLWeb;
    }
    public function getURLEmail(){
        return $this->URLEmail;
    }
    public function getDescripcion(){
        return $this->fromHTMLEntities($this->descripcion);
    }
    public function getDescripcion_Raw(){
        return $this->descripcion;
    }
    public function getURLDocuments(){
        return $this->URLDoc;
    }
    public function getURLWeb(){
        return $this->URLWeb;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function getCreditos(){
        return $this->fromHTMLEntities($this->creditos);
    }
    public function getTitulo_Raw(){
        return $this->titulo;
    }
    public function getCreditos_Raw(){
        return $this->creditos;
    }
    public function setTitulo($titulo){
        if(trim($titulo)!=""){
            $this->titulo=trim($titulo);
            $this->_Update();
        }
        return false;
    }
    public function setCreditos($creditos){
        if(trim($creditos)!=""){
            $this->creditos=$this->toHTMLEntities(trim($creditos));
            $this->_Update();
        }
        return false;
    }
    public function setDescripcion($descripcion){
        if(trim($descripcion)!=""){
            $this->descripcion=$this->toHTMLEntities(trim($descripcion));
            $this->_Update();
        }
        return false;
    }
    private function _Update(){
            $Query = "UPDATE siteinfo SET titulo='$this->titulo',".
                 "creditos='$this->creditos',".
                 "emailURL='$this->URLEmail',".
                 "descripcion='$this->descripcion'";
        $this->DataBase->ExecUpdate($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['SYSTEMINFO'] = $this;
        }
    }
}
class HTMLUtils{
    function HTMLUtils(){
        
    }
    public function toMayusculas($STR){
        $STR = strtoupper($STR);
        $STR = str_replace("á", "Á", $STR);
        $STR = str_replace("é", "É", $STR);
        $STR = str_replace("í", "Í", $STR);
        $STR = str_replace("ó", "Ó", $STR);
        $STR = str_replace("ú", "Ú", $STR);
        $STR = str_replace("ñ", "Ñ", $STR);
        return $STR;
    }
    public function toMinusculas($STR){
        $STR = strtolower($STR);
        $STR = str_replace("Á", $STR);
        $STR = str_replace("É", "é", $STR);
        $STR = str_replace("Í", "í", $STR);
        $STR = str_replace("Ó", "ó", $STR);
        $STR = str_replace("Ú", "ú", $STR);
        $STR = str_replace("Ñ", "ñ", $STR);
        return $STR;
    }
    public function LineBreakstoBR($STR){
        $STR = str_replace("\n\r", "<br>", $STR);
        $STR = str_replace("\n", "<br>", $STR);
        $STR = str_replace("\r", "", $STR);
        return $STR;
    }
    public function BRtoLineBraks($STR){
        $STR=str_replace("<br>","\n",$STR);
        $STR=str_replace("< br>","\n",$STR);
        $STR=str_replace("</br>","\n",$STR);
        $STR=str_replace("</ br>","\n",$STR);
        return $STR;
    }
    public function toHTMLEntities_Letras($STR){
        //Vocales Mayúsculas
        $STR = str_replace("Á", "&Aacute;", $STR);
        $STR = str_replace("É", "&Eacute;", $STR);
        $STR = str_replace("Í", "&Iacute;", $STR);
        $STR = str_replace("Ó", "&Oacute;", $STR);
        $STR = str_replace("Ú", "&Uacute;", $STR);
        //Vocales Minúsculas
        $STR = str_replace("á", "&aacute;", $STR);
        $STR = str_replace("é", "&eacute;", $STR);
        $STR = str_replace("í", "&iacute;", $STR);
        $STR = str_replace("ó", "&oacute;", $STR);
        $STR = str_replace("ú", "&uacute;", $STR);
        //Ñ y ñ
        $STR = str_replace("Ñ", "&Ntilde;", $STR);
        $STR = str_replace("ñ", "&ntilde;", $STR);
        return $STR;
    }
    public function fromHTMLEntities_Letras($STR){
        //Vocales Mayúsculas
        $STR = str_replace("&Aacute;", "Á",$STR);
        $STR = str_replace("&Eacute;", "É", $STR);
        $STR = str_replace("&Iacute;", "Í", $STR);
        $STR = str_replace("&Oacute;", "Ó", $STR);
        $STR = str_replace("&Uacute;", "Ú", $STR);
        //Vocales Minúsculas
        $STR = str_replace("&aacute;", "á", $STR);
        $STR = str_replace("&eacute;", "é", $STR);
        $STR = str_replace("&iacute;", "í", $STR);
        $STR = str_replace("&oacute;", "ó", $STR);
        $STR = str_replace("&uacute;", "ú", $STR);
        //Ñ y ñ
        $STR = str_replace("&Ntilde;", "Ñ", $STR);
        $STR = str_replace("&ntilde;", "ñ", $STR);
        return $STR;
    }
    public function toHTMLEntities($STR){
        //&
        $STR = str_replace("&", "&amp;", $STR);
        //.
        $STR = str_replace(".", "&#46;", $STR);
        //:
        $STR = str_replace(":", "&#58;", $STR);
        //,
        $STR = str_replace(",", "&#44;", $STR);
        //Letras
        $STR = $this->toHTMLEntities_Letras($STR);
        //<
        $STR = str_replace("<", "&lt;", $STR);
        //>
        $STR = str_replace("<", "&gt;", $STR);
        //©
        $STR = str_replace("©", "&copy;", $STR);
        //®
        $STR = str_replace("®", "&reg;", $STR);
        //'
        $STR = str_replace("'", "&#39;", $STR);
        //"
        $STR = str_replace("\"", "&quot;", $STR);
        $STR = $this->LineBreakstoBR($STR);
        return $STR;
    }
    public function fromHTMLEntities($STR){
        $STR = $this->BRtoLineBraks($STR);
        //Letras
        $STR = $this->fromHTMLEntities_Letras($STR);
        //<
        $STR = str_replace("&lt;", "<", $STR);
        //>
        $STR = str_replace("&gt;", "<", $STR);
        //&
        $STR = str_replace("&amp;", "&", $STR);
        //©
        $STR = str_replace("&copy;", "©", $STR);
        //®
        $STR = str_replace("&reg;", "®", $STR);
        //'
        $STR = str_replace( "&#39;","'", $STR);
        //"
        $STR = str_replace("&quot;","\"",  $STR);
        //.
        $STR = str_replace( "&#46;",".", $STR);
        //;
        $STR = str_replace("&#59;",";",  $STR);
        //:
        $STR = str_replace("&#58;",":",  $STR);
        //,
        $STR = str_replace( "&#44;",",", $STR);
        return $STR;
    }
}
class loginfo{
    private $DataBase;
    private $usuario;
    private $password;
    private $nombre;
    private $correo;
    private $URLFullPath;
    private $URLWebPath;
    private $PathToFile;
    function loginfo(){
        $prfx="";
        $this->URLFullPath = $_SERVER["DOCUMENT_ROOT"].$prfx;
        $this->URLWebPath = "http://".$_SERVER['HTTP_HOST'].$prfx;
        $this->DataBase = new DataBase();
        $RESULTADO=$this->DataBase->ExecSelect("SELECT * FROM logininfo");
        $this->usuario=$RESULTADO[0]["user"];
        $this->password=$RESULTADO[0]["password"];
        $this->nombre=$RESULTADO[0]["nombre"];
        $this->correo=$RESULTADO[0]["email"];
    }
    public function GetSiteFullInternalUrl(){
        return $this->URLFullPath;
    }
    public function GetSiteFullWebUrl(){
        return $this->URLWebPath;
    }
    public function CerrarSesion(){
        $_SESSION['LOGIN_STATUS'] = "INACTIVO";
        $_SESSION['ADMIN'] = "INACTIVO";
        session_destroy();
    }
    public function verificarSesion(){
        if(session_status()==PHP_SESSION_NONE){
            $this->IniciarSesion("guest", "guest");
            return "GUEST";
        }else{
            if(!isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"]=='ACTIVO'){
                return "ADMIN";
            }else{
                return "GUEST";
            }
        }
    }
    public function IniciarSesion($usuario,$password){
        if($this->LogIn($usuario, $password)){
            if(session_status()!=PHP_SESSION_ACTIVE){
                session_start();
                if(count($_SESSION)>0){
                        unset($_SESSION);
                        $_SESSION=array();
                }
            }
            $_SESSION['ADMIN'] = "ACTIVO";
        }else{
            if ($usuario=='guest' && $password=='guest'){
                if(session_status()!=PHP_SESSION_ACTIVE){
                    session_start();
                    if(count($_SESSION)>0){
                        unset($_SESSION);
                        $_SESSION=array();
                    }
                }
                $_SESSION['ADMIN'] = "INACTIVO";
            }else{
                $_SESSION['LOGIN_STATUS'] = "INACTIVO";
                $_SESSION['ADMIN'] = "INACTIVO";
                $this->CerrarSesion();
            }
        }
        $_SESSION['LOGINFO'] = $this; 
        //Carga de Informacion del Sistema
        $_SESSION['SYSTEMINFO'] = new siteinfo($this->URLFullPath,$this->URLWebPath);
        //Carga de informacion Personal
        $_SESSION['PERSONALINFO'] = new personalinfo($this->URLFullPath,$this->URLWebPath);
        //Carga de informacion Contacto
        $_SESSION['CONTACTINFO'] = new contactinfo($this->URLFullPath,$this->URLWebPath);
        //Carga de informacion Servicios
        $_SESSION['SERVICIOSINFO'] = new serviciosinfo($this->URLFullPath,$this->URLWebPath);
        //Carga de informacion Servicios
        $_SESSION['EMAILCONF'] = new emailconf($this->URLFullPath,$this->URLWebPath);
        //Carga de informacion Slider principal
        $_SESSION['GALERIA-0'] = new galeriainfo($this->URLFullPath,$this->URLWebPath,"0");
        //Carga de informacion Servicios
        $_SESSION['GALERIA-1'] = new galeriainfo($this->URLFullPath,$this->URLWebPath,"1");
        $_SESSION['LOGIN_STATUS'] = "ACTIVO";
        
    }
    public function GetInformacionSistema(){
        if (isset($_SESSION['SYSTEMINFO'])) {
            return $_SESSION['SYSTEMINFO'];
        }
    }
    public function GetEmailConf(){
        if (isset($_SESSION['EMAILCONF'])) {
            return $_SESSION['EMAILCONF'];
        }
    }
    public function GetSliderPrincipal(){
        if (isset($_SESSION['GALERIA-0'])) {
            return $_SESSION['GALERIA-0'];
        }
    }
    public function GetGaleria(){
        if (isset($_SESSION['GALERIA-1'])) {
            return $_SESSION['GALERIA-1'];
        }
    }
    public function GetInformacionPersonal(){
        if (isset($_SESSION['PERSONALINFO'])) {
            return $_SESSION['PERSONALINFO'];
        }
    }
    public function GetInformacionServicios(){
        if (isset($_SESSION['SERVICIOSINFO'])) {
            return $_SESSION['SERVICIOSINFO'];
        }
        return null;
    }
    public function GetInformacionContacto(){
        if (isset($_SESSION['CONTACTINFO'])) {
            return $_SESSION['CONTACTINFO'];
        }
        return null;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function setUsuario($usuario){
        if(trim($usuario)!=""){
            $this->usuario=$usuario;
            $this->_UpdateFile();
        }
        return false;
    }
    private function isPassword($password){
        if($this->password==  md5($password)){
            return true;
        }
        return false;
    }
    private function isUsuario($usuario){
        if($this->usuario== $usuario){
            return true;
        }
        return false;
    }
    private function LogIn($usuario,$password){
        if($this->isUsuario($usuario) && $this->isPassword($password)){
            return true;
        }else{
            return false;
        }
    }
    public function setPassword($password){
        if(trim($password)!=""){
            $this->password = md5($password);
            $this->_Update();
        }
        return false;
    }
    public function setNombre($nombre){
        if(trim($nombre)!=""){
            $this->nombre=$nombre;
            $this->_Update();
        }
        return false;
    }
    public function setCorreo($correo){
        if(trim($correo)!=""){
            $this->correo=$correo;
            $this->_Update();
        }
        return false;
    }
    private function _Update(){
        $Query = "UPDATE logininfo SET user='$this->usuario',".
                 "password='$this->password',".
                 "nombre='$this->nombre',".
                 "email='$this->correo'";
        $this->DataBase->ExecUpdate($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['LOGINFO'] = $this;
        }
    }
}
class contactinfo extends HTMLUtils{
    private $telefono;
    PRIVATE $descripcion;
    private $celular;
    private $nombre;
    private $direccion;
    private $ciudad;
    private $estado;
    private $pais;
    private $texto;
    private $longitud;
    private $latitud;
    private $PathToFile;
    private $URLWeb;
    private $URLDoc;
    private $correo;
    function contactinfo($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $RESULTADO=$this->DataBase->ExecSelect("SELECT * FROM contactinfo");
        $this->telefono = $RESULTADO[0]["telefono"];
        $this->celular = $RESULTADO[0]["celular"];
        $this->nombre = $RESULTADO[0]["nombre"];
        $this->direccion = $RESULTADO[0]["direccion"];
        $this->ciudad = $RESULTADO[0]["ciudad"];
        $this->estado = $RESULTADO[0]["estado"];
        $this->pais = $RESULTADO[0]["pais"];
        $this->texto = $RESULTADO[0]["texto"];
        $this->longitud = $RESULTADO[0]["longitud"];
        $this->latitud = $RESULTADO[0]["latitud"];
        $this->descripcion=$RESULTADO[0]["descripcion"];
        $this->correo=$RESULTADO[0]["correo"];
    }
    public function getURLDocuments(){
        return $this->URLDoc;
    }
    public function getURLWeb(){
        return $this->URLWeb;
    }
    //GETS
    public function getTelefono(){return $this->fromHTMLEntities($this->telefono);}
    public function getTelefono_Raw(){return $this->telefono;}
    public function getCelular(){return $this->fromHTMLEntities($this->celular);}
    public function getCelular_Raw(){return $this->celular;}
    public function getNombre(){return $this->fromHTMLEntities($this->nombre);}
    public function getNombre_Raw(){return $this->nombre;}
    public function getDireccion(){return $this->fromHTMLEntities($this->direccion);}
    public function getDireccion_Raw(){return $this->fromHTMLEntities($this->direccion);}
    public function getCiudad(){return $this->fromHTMLEntities($this->ciudad);}
    public function getCiudad_Raw(){return $this->ciudad;}
    public function getEstado(){return $this->fromHTMLEntities($this->estado);}
    public function getEstado_Raw(){return $this->estado;}
    public function getPais(){return $this->fromHTMLEntities($this->pais);}
    public function getPais_Raw(){return $this->pais;}
    public function getTexto(){return $this->fromHTMLEntities($this->texto);}
    public function getTexto_Raw(){return $this->texto;}
    public function getDescripcion(){return $this->fromHTMLEntities($this->descripcion);}
    public function getDescripcion_Raw(){return $this->descripcion;}
    public function getCorreo(){return $this->fromHTMLEntities($this->correo);}
    public function getCorreo_Raw(){return $this->correo;}
    public function getLongitud(){return $this->fromHTMLEntities($this->longitud);}
    public function getLongitud_Raw(){return $this->longitud;}
    public function getLatitud(){return $this->fromHTMLEntities($this->latitud);}
    public function getLatitud_Raw(){return $this->getLatitud();}
    public function getTextoFormateado(){
        $TEXTO = $this->getTexto();
        $TEXTO = str_replace("[NOMBRE]", $this->getNombre(), $TEXTO);
        $TEXTO = str_replace("[TELEFONO]", $this->getTelefono(), $TEXTO);
        $TEXTO = str_replace("[CELULAR]", $this->getCelular(), $TEXTO);
        $TEXTO = str_replace("[DIRECCION]", $this->getDireccion(), $TEXTO);
        $TEXTO = str_replace("[CIUDAD]", $this->getCiudad(), $TEXTO);
        $TEXTO = str_replace("[ESTADO]", $this->getEstado(), $TEXTO);
        $TEXTO = str_replace("[PAIS]", $this->getPais(), $TEXTO);
        return $TEXTO;
    }
    //SETS
    public function setTelefono($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->telefono=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setCelular($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->celular=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setNombre($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->nombre=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setDescripcion($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->descripcion=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setDireccion($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->direccion=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setCorreo($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->correo=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setCiudad($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->ciudad=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setEstado($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->estado=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setPais($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->pais=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setTexto($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->texto=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setLongitud($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->longitud=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setLatitud($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->latitud=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    
    private function _Update(){
        $Query = "UPDATE contactinfo SET telefono='$this->telefono',".
                        "celular='$this->celular',".
                        "direccion='$this->direccion',".
                        "ciudad='$this->ciudad',".
                        "estado='$this->estado',".
                        "pais='$this->pais',".
                        "texto='$this->texto',".
                        "longitud='$this->longitud',".
                        "latitud='$this->latitud',".
                        "descripcion='$this->descripcion',".
                        "correo='$this->correo'";
        $this->DataBase->ExecUpdate($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['CONTACTINFO'] = $this;
        }
    }
}
class serviciosinfo extends HTMLUtils{
    private $servicios;
    private $PathToFile;
    private $URLWeb;
    private $URLDoc;
    function serviciosinfo($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $RESULTADO=$this->DataBase->ExecSelect("SELECT * FROM serviciosinfo order by ordenacion");
        $this->servicios= $RESULTADO;
    }
    public function getURLDocuments(){
        return $this->URLDoc;
    }
    public function getURLWeb(){
        return $this->URLWeb;
    }
    //GETS
    public function getServicios(){
        $VectTemp=$this->servicios;
        for($i=0;$i<count($VectTemp);$i++){
            $VectTemp[$i]["descripcion"]=$this->fromHTMLEntities($VectTemp[$i]["descripcion"]);
        }
        return $VectTemp;
    }
    public function getServicios_Raw(){
        return $this->servicios;
    }
    //Delete
    public function deleteServicio($id){
        $Query = "DELETE from serviciosinfo ".
                 "WHERE id=$id";
        $this->DataBase->ExecUpdate($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['SERVICIOSINFO'] = $this;
        }
        $RESULTADO=$this->DataBase->ExecSelect("SELECT * FROM serviciosinfo order by ordenacion");
        $this->servicios= $RESULTADO;
    }
    public function InsertServicio($descripcion){
        $RESULTADO=$this->DataBase->ExecSelect("SELECT MAX(id) maximo FROM serviciosinfo");
        $descripcion=$this->toHTMLEntities($descripcion);
        $orden=($RESULTADO[0]["maximo"]+1);
        $Query = "insert into serviciosinfo (descripcion,ordenacion) values ('$descripcion',".$orden.");";
        $this->DataBase->ExecInsert($Query);     
        $RESULTADO=$this->DataBase->ExecSelect("SELECT * FROM serviciosinfo order by ordenacion");
        $this->servicios= $RESULTADO;
    }
    private function UpdateServicio($id,$Text){
        $Query = "UPDATE serviciosinfo SET descripcion='$Text' ".
                 "WHERE id=$id";
        $this->DataBase->ExecUpdate($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['SERVICIOSINFO'] = $this;
        }
        
    }
    //SETS
    public function ordenarServicios($vector){
        for($i=0;$i<count($vector);$i++){
            $Query = "UPDATE serviciosinfo SET ordenacion=".($i+1).
                 " WHERE id=".$vector[$i][0];
            $this->DataBase->ExecUpdate($Query);
        }
    }
    public function setServicio($id,$Servicio,$noExec=false){
        $this->UpdateServicio($id, $Servicio);
        if($noExec===true){
            return;
        }
        $RESULTADO=$this->DataBase->ExecSelect("SELECT * FROM serviciosinfo order by ordenacion");
        $this->servicios= $RESULTADO;
    }
    public function setServicios($array){
        for($i=0;$i<count($array);$i++){
            $this->setServicio($array["id"],$array["descripcion"],true);
        }
        $RESULTADO=$this->DataBase->ExecSelect("SELECT * FROM serviciosinfo order by ordenacion");
        $this->servicios= $RESULTADO;
    }
    public function printListaServicios(){
        $listaServicios="<ul class=\"servicios-lista\">";
        for($i=0;$i<count($this->servicios);$i++){
            $listaServicios=$listaServicios."<li>".$this->servicios[$i]["descripcion"]."</li>";
        }
        $listaServicios=$listaServicios."</ul>";
        return $listaServicios;
    }
    public function printListaServiciosConID(){
        $listaServicios="<ul class=\"servicios-lista\">";
        for($i=0;$i<count($this->servicios);$i++){
            $listaServicios=$listaServicios."<li id=".$this->servicios[$i]["id"].">".$this->servicios[$i]["descripcion"]."</li>";
        }
        $listaServicios=$listaServicios."</ul>";
        return $listaServicios;
    }
}
class personalinfo extends HTMLUtils{
    private $resumen;
    private $mision;
    private $vision;
    private $firma;
    private $PathToFile;
    private $URLWeb;
    private $URLDoc;
    function personalinfo($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $this->Load();
    }
    private function Load(){
        $RESULTADO=$this->DataBase->ExecSelect("SELECT * FROM personalinfo");
        $this->resumen= $RESULTADO[0]["resumen"];
        $this->mision= $RESULTADO[0]["mision"];
        $this->vision= $RESULTADO[0]["vision"];
        $this->firma= $RESULTADO[0]["firma"];
    }
    public function getURLDocuments(){
        return $this->URLDoc;
    }
    public function getURLWeb(){
        return $this->URLWeb;
    }
    //GETS
    public function getResumen(){return $this->fromHTMLEntities($this->resumen);}
    public function getMision(){return $this->fromHTMLEntities($this->mision);}
    public function getVision(){return $this->fromHTMLEntities($this->vision);}
    public function getFirma(){return $this->fromHTMLEntities($this->firma);}
    public function getFirma_Raw(){return $this->firma;}
    public function getResumen_Raw(){return $this->resumen;}
    public function getMision_Raw(){return $this->mision;}
    public function getVision_Raw(){return $this->vision;}
    //SETS
    public function setResumen($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->resumen=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setMision($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->mision=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    public function setVision($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->vision=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    
    public function setFirma($var){
        $var=trim($var);
        $var=$this->toHTMLEntities($var);
        if($var!=""){
            $this->firma=$var;
            $this->_Update();
            return true;
        }
        return false;
    }
    private function _Update(){
        $Query = "UPDATE personalinfo SET resumen='$this->resumen',".
                 "mision='$this->mision',".
                 "vision='$this->vision',".
                 "firma='$this->firma'";
        $this->DataBase->ExecUpdate($Query);
        $this->Load();
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['PERSONALINFO'] = $this;
        }
    }
}
class emailconf extends HTMLUtils{
    private $data;
    private $URLWeb;
    private $URLDoc;
    private $DataBase;
    function emailconf($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $this->load();
    }
    private function load(){
        $this->data=$this->DataBase->ExecSelect("SELECT * FROM emailconf");
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['EMAILCONF'] = $this;
        }
    }
    public function getData(){
        return $this->data;
    }
    public function saveData($vect){
        $Query="UPDATE emailconf SET ".
               "SMTPAuth='".$vect["SMTPAuth"]."',".
               "SMTPSecure='".$vect["SMTPSecure"]."',".
               "HOST='".$vect["HOST"]."',".
               "Port='".$vect["Port"]."',".
               "Username='".$vect["Username"]."',".
               "Pass='".$vect["Pass"]."',".
               "SetFrom='".$vect["SetFrom"]."',".
               "SetFromName='".$vect["SetFromName"]."',".
               "AddReplyTo='".$vect["AddReplyTo"]."'";
        $this->DataBase->ExecUpdate($Query);
        $this->load();
    }
    
}
class galeriainfo extends HTMLUtils{
    private $galeria;
    private $tipo;
    private $URLWeb;
    private $URLDoc;
    function galeriainfo($URLDoc,$URLWeb,$tipo="0"){
        $this->tipo=$tipo;
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $this->load();
    }
    private function load(){
        $this->galeria=$this->DataBase->ExecSelect("SELECT * FROM galeria WHERE tipo=$this->tipo order by ordenacion");
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['GALERIA-'.$this->tipo] = $this;
        }
    }
    public function getImagen($id){
        for($i=0;$i<count($this->galeria);$i++){
            if($id==$this->galeria[$i][$id]){
                return $this->galeria[$i];
            }
        }
        return false;
    }
    public function newImagen($url, $alt, $nombre){
        $url="galeria/".$url;
        $PATHTOFILE=dirname(__FILE__).'/../'.$url;
        $data = getimagesize($PATHTOFILE);
        $imgancho = $data[0];
        $imgalto = $data[1];
        $RESULTADO=$this->DataBase->ExecSelect("SELECT MAX(id) maximo FROM galeria");
        $orden=($RESULTADO[0]["maximo"]+1);
        $Query = "insert into galeria (ordenacion,url,alt,nombre,ancho,alto,tipo) values ($orden,'$url','$alt','$nombre','$imgancho','$imgalto',$this->tipo);";
        $this->DataBase->ExecInsert($Query);     
        $this->load();
    }
    public function eliminarImagen($id){
        $url="";
        for($i=0;$i<count($this->galeria);$i++){
            if($this->galeria[$i]["id"]==$id){
                $url=$this->galeria[$i]["url"];
                break;
            }
        }
        if($url==""){
            return false;
        }
        $PATHTOFILE=dirname(__FILE__).'/../'.$url;
        unlink($PATHTOFILE);
        $Query = "delete from galeria where id=".$id;
        $this->DataBase->ExecDelete($Query);     
        $this->load();
        return true;
    }
   public function EditarImagen($alt, $nombre,$id,$name_new){
        $element=null;
        for($i=0;$i<count($this->galeria);$i++){
            if($this->galeria[$i]["id"]==$id){
                $element=$this->galeria[$i];
            }
        }
        if(is_null($element)){
            return null;
        }
        $PATHTOFILE=dirname(__FILE__).'/../'.$element["url"];
        $data = getimagesize($PATHTOFILE);
        $imgancho = $data[0];
        $imgalto = $data[1];
        $name_new ="galeria/".$name_new;
        $Query = "UPDATE galeria SET alt='$alt',nombre='$nombre',alto='$imgalto',ancho='$imgancho',url='$name_new' where id=".$id;
        $this->DataBase->ExecUpdate($Query);     
        $this->load();
        return str_replace("galeria/", "", $element["url"]);
    }
    public function ordenarImagenes($vector){
        for($i=0;$i<count($vector);$i++){
            $Query = "UPDATE galeria SET ordenacion=".($i+1).
                 " WHERE id=".$vector[$i][0];
            $this->DataBase->ExecUpdate($Query);
        }
        $this->load();
    }
    public function printListaPlana(){
        $print = "<ul>";
        for($i=0;$i<count($this->galeria);$i++){
            //Item Principal
            $print = $print."<li>";
            $orientation=$this->galeria[$i]["ancho"]>=$this->galeria[$i]["alto"]?"L":"P";
            $print = $print."<div> <img orientation=\"$orientation\" width=\"".$this->galeria[$i]["ancho"]."\" height=\"".$this->galeria[$i]["alto"]."\" src=\"".$this->galeria[$i]["url"]."\"/></div>";
            $print = $print."</li>";
        }
        $print = $print."</ul>";
        return $print;
    }
    
    public function printListaGaleria($ClassPrefix="",$EditFncName,$DeleteFncName){
        $print = "<ul class=\"$ClassPrefix-lista-galeria\">";
        for($i=0;$i<count($this->galeria);$i++){
            //Item Principal
            $print = $print."<li item-id=\"".$this->galeria[$i]["id"]."\" order=\"".$this->galeria[$i]["ordenacion"]."\">";
            //Container de Texto o Imagen
            $print = $print."<div class=\"texto\"> <img width=\"".$this->galeria[$i]["ancho"]."\" height=\"".$this->galeria[$i]["alto"]."\" src=\"../".$this->galeria[$i]["url"]."\"/></div>";
            //Container de Botones
            $print = $print."<div class=\"acciones\">"
                    . "<a id=\"Editar\" class=\"btn-editar btn btn-primary\" onClick=\"$EditFncName('".$this->galeria[$i]["alt"]."','".$this->galeria[$i]["nombre"]."','".$this->galeria[$i]["id"]."','../".$this->galeria[$i]["url"]."')\" role=\"button\" >Editar</a>"
                    . "<a id=\"Eliminar\" class=\"btn-eliminar btn btn-danger\" role=\"button\" onClick=\"$DeleteFncName('".$this->galeria[$i]["id"]."','../".$this->galeria[$i]["url"]."')\">Eliminar</a>"
                    . "</div>";
            $print = $print."</li>";
        }
        $print = $print."</ul>";
        return $print;
    }
    
    public function printImagenesPreCache(){
        $print = "";
        for($i=0;$i<count($this->galeria);$i++){
            $print = $print."<img src=\"".$this->galeria[$i]["url"]."\"/>";
        }
        return $print;
    }
    public function JSONEncode(){
        return json_encode($this->galeria);
    }
    public function getURLDocuments(){
        return $this->URLDoc;
    }
    public function getURLWeb(){
        return $this->URLWeb;
    }
}

$ADK_UTILS = new HTMLUtils();
?>
