<?php
include_once dirname(__FILE__).'/../basics/basic.php';

class DataBase{
    private $SQLHandle;
    function DataBase()
    {
        $this->SQLHandle= new SQLite3(dirname(__FILE__)."/../data/SQLLiteDB.db");
    }
    public function ExecQuery($Query){
        $Resultado = $this->SQLHandle->query($Query);
        if($Resultado===true || $Resultado===false){
            return $Resultado;
        }
        $ResultadoAray=array();
        while($Arr=$Resultado->fetchArray(SQLITE3_ASSOC)){
            $ResultadoAray[]=$Arr;
        }
        return $ResultadoAray;
    }
}

class siteinfo extends galeriainfo{
    private $titulo;
    private $creditos;
    private $DataBase;
    private $URLDoc;
    private $URLWeb;
    private $descipcion;
    private $galeria;
    private $URLEmail;
    private $PathToFile;
    function siteinfo($URLDoc,$URLWeb){
        $this->galeria=array();
        $this->PathToFile=$URLDoc.'/data/siteinfo.xml';
        $this->DataBase= new DataBase();
        $RESULTADO= $this->DataBase->ExecQuery("SELECT * FROM siteinfo");
        $this->titulo=$RESULTADO[0]["titulo"];
        $this->URLEmail=$RESULTADO[0]["emailURL"];
        $this->creditos=$RESULTADO[0]["creditos"];
        $this->descipcion = $RESULTADO[0]["descripcion"];
        $this->URLDoc = $URLDoc;
        $this->URLWeb = $URLWeb;
    }
    public function getURLEmail(){
        return $this->URLEmail;
    }
    public function getDescripcion(){
        return $this->descipcion;
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
            $this->creditos=trim($creditos);
            $this->_Update();
        }
        return false;
    }
    public function setDescripcion($descripcion){
        if(trim($descripcion)!=""){
            $this->creditos=trim($descripcion);
            $this->_Update();
        }
        return false;
    }
    private function _Update(){
            $Query = "UPDATE siteinfo SET titulo='$this->titulo',".
                 "creditos='$this->creditos',".
                 "emailURL='$this->emailURL',".
                 "descripcion='$this->descipcion'";
        $this->DataBase->ExecQuery($Query);
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
        //Letras
        $STR = $this->toHTMLEntities_Letras($STR);
        //<
        $STR = str_replace("<", "&lt;", $STR);
        //>
        $STR = str_replace("<", "&gt;", $STR);
        //Espacio
        $STR = str_replace(" ", "&nbsp;", $STR);
        //&
        $STR = str_replace("&", "&amp;", $STR);
        //©
        $STR = str_replace("©", "&copy;", $STR);
        //®
        $STR = str_replace("®", "&reg;", $STR);
        //'
        $STR = str_replace("'", "&#39;", $STR);
        //"
        $STR = str_replace("\"", "&quot;", $STR);
        //.
        $STR = str_replace(".", "&#46;", $STR);
        //;
        $STR = str_replace(";", "&#59;", $STR);
        //:
        $STR = str_replace(":", "&#58;", $STR);
        //,
        $STR = str_replace(",", "&#44;", $STR);
        $STR = $this->LineBreakstoBR($STR);
        return $STR;
    }
    public function fromHTMLEntities($STR){
        $STR = $this->LineBreakstoBR($STR);
        //Letras
        $STR = $this->fromHTMLEntities_Letras($STR);
        //<
        $STR = str_replace("&lt;", "<", $STR);
        //>
        $STR = str_replace("&gt;", "<", $STR);
        //Espacio
        $STR = str_replace("&nbsp;", " ", $STR);
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
        $RESULTADO=$this->DataBase->ExecQuery("SELECT * FROM logininfo");
        $this->usuario=$RESULTADO[0]["user"];
        $this->password=$RESULTADO[0]["password"];
        $this->nombre=$RESULTADO[0]["nombre"];
        $this->correo=$RESULTADO[0]["email"];
        $RESULTADO=$this->DataBase->ExecQuery("SELECT * FROM slider_principal");
        $ver="";
    }
    public function GetSiteFullInternalUrl(){
        return $this->URLFullPath;
    }
    public function GetSiteFullWebUrl(){
        return $this->URLWebPath;
    }
    public function CerrarSesion(){
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
            if (!isset($_SESSION['LOGINFO'])) {
                $_SESSION['LOGINFO'] = $this;
            } 
            //Carga de Informacion del Sistema
            $systeminfo = new siteinfo($this->URLFullPath,$this->URLWebPath);
            $_SESSION['SYSTEMINFO'] = $systeminfo;
            //Carga de informacion Personal
            $personalinfo = new personalinfo($this->URLFullPath,$this->URLWebPath);
            $_SESSION['PERSONALINFO'] = $personalinfo;
            
            $_SESSION['LOGIN_STATUS'] = "ACTIVO";
            $_SESSION['ADMIN'] = "ACTIVO";
            return true;
        }else{
            if ($usuario=='guest' && $password=='guest'){
                if(session_status()!=PHP_SESSION_ACTIVE){
                    session_start();
                    if(count($_SESSION)>0){
                        unset($_SESSION);
                        $_SESSION=array();
                    }
                }
                if (!isset($_SESSION['LOGINFO'])) {
                    $_SESSION['LOGINFO'] = $this;
                } 
                //Carga de Informacion del Sistema
                $systeminfo = new siteinfo($this->URLFullPath,$this->URLWebPath);
                $_SESSION['SYSTEMINFO'] = $systeminfo;
                //Carga de informacion Personal
                $personalinfo = new personalinfo($this->URLFullPath,$this->URLWebPath);
                $_SESSION['PERSONALINFO'] = $personalinfo;
                $_SESSION['LOGIN_STATUS'] = "ACTIVO";
                $_SESSION['ADMIN'] = "INACTIVO";
            }else{
                $this->CerrarSesion();
                $_SESSION['LOGIN_STATUS'] = "INACTIVO";
                $_SESSION['ADMIN'] = "INACTIVO";
            }
            return false;
        }
    }
    public function GetInformacionSistema(){
        if (isset($_SESSION['SYSTEMINFO'])) {
            return $_SESSION['SYSTEMINFO'];
        }
    }
    public function GetInformacionPersonal(){
        if (isset($_SESSION['PERSONALINFO'])) {
            return $_SESSION['PERSONALINFO'];
        }
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
            $this->correo=$corro;
            $this->_Update();
        }
        return false;
    }
    private function _Update(){
        $Query = "UPDATE logininfo SET user='$this->usuario',".
                 "password='$this->password',".
                 "nombre='$this->nombre',".
                 "email='$this->correo'";
        $this->DataBase->ExecQuery($Query);
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
    function contactinfo($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $RESULTADO=$this->DataBase->ExecQuery("SELECT * FROM contactinfo");
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
        $Query = "UPDATE contactinfo SET telefono='',".
                        "celular='$this->celular',".
                        "direccion='$this->direccion',".
                        "ciudad='$this->ciudad',".
                        "estado='$this->estado',".
                        "pais='$this->pais',".
                        "texto='$this->texto',".
                        "longitud='$this->longitud',".
                        "latitud='$this->latitud',".
                        "descripcion='$this->descripcion'";
        $this->DataBase->ExecQuery($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['CONTACTINFO'] = $this;
        }
    }
}

class serviciosinfo extends HTMLUtils{
    private $resumen;
    private $mision;
    private $vision;
    private $firma;
    private $PathToFile;
    private $URLWeb;
    private $URLDoc;
    function contactinfo($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $RESULTADO=$this->DataBase->ExecQuery("SELECT * FROM personalinfo");
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
        $this->DataBase->ExecQuery($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['PERSONALINFO'] = $this;
        }
    }
}

class serviciosinfo extends HTMLUtils{
    private $servicios;
    private $PathToFile;
    private $URLWeb;
    private $URLDoc;
    function contactinfo($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $RESULTADO=$this->DataBase->ExecQuery("SELECT * FROM serviciosinfo");
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
        $this->DataBase->ExecQuery($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['SERVICIOSINFO'] = $this;
        }
    }
    private function UpdateServicio($id,$Text){
        $Query = "UPDATE serviciosinfo SET descripcion='$Text' ".
                 "WHERE id=$id";
        $this->DataBase->ExecQuery($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['SERVICIOSINFO'] = $this;
        }
    }
    //SETS

    public function setServicio($id,$Servicio){
        $this->UpdateServicio($id, $Servicio);
    }
    public function setServicios($array){
        for($i=0;$i<count($array);$i++){
            $this->setServicio($array["id"],$array["descripcion"]);
        }
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
    function contactinfo($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->DataBase = new DataBase();
        $RESULTADO=$this->DataBase->ExecQuery("SELECT * FROM personalinfo");
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
        $this->DataBase->ExecQuery($Query);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['PERSONALINFO'] = $this;
        }
    }
}
class galeriainfo extends HTMLUtils{
    private $galeria;
    private $URLWeb;
    private $URLDoc;
    function galeriainfo($URLDoc,$URLWeb){
        $this->URLWeb=$URLWeb;
        $this->URLDoc=$URLDoc;
        $this->PathToFile = $URLDoc.'/data/galeriainfo.xml';
        $XML=file_get_contents($this->PathToFile);
        $XML = new SimpleXMLElement($XML);
        $this->galeria= array();
        for($i=0;$i<count($XML->imagen);$i++){
            $img = new stdClass();
            $img->id = strval($XML->imagen[$i]->id);
            $img->order = strval($XML->imagen[$i]->order);
            $img->url = strval($XML->imagen[$i]->url);
            $img->alt = strval($XML->imagen[$i]->alt);
            $img->nombre = strval($XML->imagen[$i]->nombre);
            $img->ancho = strval($XML->imagen[$i]->ancho);
            $img->alto = strval($XML->imagen[$i]->alto);
            $this->galeria[$i]=$img;
        }
    }
    public function getImagen($order){
        if($order>-1 && $order<=count($this->galeria) && count($this->galeria)!=0){
            for($i=0;$i<count($this->galeria);$i++){
                if($this->galeria[$i]->order==$order){
                    return $this->galeria[$i];
                }
            }
        }
        return false;
    }
    public function getImagenEnBlanco(){
       $img = new stdClass();
       $maxId=0;
       $maxOrder=0;
       for($i=0;$i<count($this->galeria);$i++){
           if($this->galeria[$i]->id>$maxId){
               $maxId=$this->galeria[$i]->id;
           }
           if($this->galeria[$i]->order>$maxOrder){
               $maxId=$this->galeria[$i]->order;
           }
       }
       $maxId=$maxId+1;
       $maxOrder=$maxOrder+1;
       $img->id = $maxId;
       $img->order = $maxOrder;
       $img->url = $this->URLWeb."/galeria/$maxId.jpg";
       $img->alt = "$maxId.jpg";
       $img->nombre = "nombre";
       $img->ancho = "1px";
       $img->alto = "1px";
       return $img;
    }
    public function newImagen($img){
        if(is_object($img) &&
           property_exists($img,"id") &&
           property_exists($img,"order") &&
           property_exists($img,"url") &&
           property_exists($img,"alt") &&
           property_exists($img,"nombre") &&
           property_exists($img,"ancho") &&
           property_exists($img,"alto")){
        array_push($this->galeria, $img);
            return true;
        }
        return false;
    }
    public function eliminarImagen($Img){
        if(is_object($img) &&
           property_exists($img,"id") &&
           property_exists($img,"order") &&
           property_exists($img,"url") &&
           property_exists($img,"alt") &&
           property_exists($img,"nombre") &&
           property_exists($img,"ancho") &&
           property_exists($img,"alto")){
            //Elimina la imagen
            unlink($this->URLDoc.str_replace($this->URLWeb, "", $img->url));
            //Reordena los Order
            $eliminar=-1;
            for($i=0;$i<count($this->galeria);$i++){
                if($this->galeria[$i]->order>$img->order){
                    $this->galeria[$i]->order=$this->galeria[$i]->order-1;
                }
                if($this->galeria[$i]->id == $img->id){
                    $eliminar=$i;
                }
            }
            //Elimina elemento
            unset($this->galeria[$eliminar]);
            return true;
        }
        return false;
    }
    public function OrdenarImagenes(){
        $n=count($this->galeria);
        for ($i=0; $i<$n-1; $i++)
        {
          for ($j=$i+1; $j<$n; $j++)
          {
            if($this->galeria[$i]->order>$this->galeria[$j]->order)
            {
             $imgAux = $this->galeria[$i];
             $this->galeria[$i] = $this->galeria[$j];
             $this->galeria[$j] = $imgAux;
            }
          }
        }
        $this->_UpdateFile();
    }
    public function editarImagen($img){
        if(is_object($img) &&
           property_exists($img,"id") &&
           property_exists($img,"order") &&
           property_exists($img,"url") &&
           property_exists($img,"alt") &&
           property_exists($img,"nombre") &&
           property_exists($img,"ancho") &&
           property_exists($img,"alto")){
            //Reordena los Order
            for($i=0;$i<count($this->galeria);$i++){
                if($this->galeria[$i]->order>$img->order){
                    $this->galeria[$i]->order=$this->galeria[$i]->order-1;
                }
            }
            return true;
        }
        return false;
    }
    public function getURLDocuments(){
        return $this->URLDoc;
    }
    public function getURLWeb(){
        return $this->URLWeb;
    }
    private function _UpdateFile(){
        $xml="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".
             "<root>\n";
        for($i=0;$i<count($this->galeria);$i++){
            $xml=$xml."    <imagen>\n".
                 "        <id>".$this->galeria[$i]->id."</id>\n".
                 "        <order>".$this->galeria[$i]->order."</order>\n".
                 "        <url>".$this->galeria[$i]->url."</url>\n".
                 "        <alt>".$this->galeria[$i]->alt."</alt>\n".
                 "        <nombre>".$this->galeria[$i]->nombre."</nombre>\n".
                 "        <ancho>".$this->galeria[$i]->ancho."</ancho>\n".
                 "        <alto>".$this->galeria[$i]->alto."</alto>\n".
                 "    </imagen>\n";
        }
        $xml=$xml."</root>";
        $XMLSave = simplexml_load_string($xml);
        $XMLSave->asXml($this->PathToFile);
        if (session_status()==PHP_SESSION_ACTIVE){
            $_SESSION['GAELERIAINFO'] = $this;
        }
    }
}

$ADK_UTILS = new HTMLUtils();
?>
