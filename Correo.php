<?php 
include_once dirname(__FILE__).'/basics/login.php';
$EMAILCONF_TEMP = $EMAILCONF->getData()[0];
//$SMTPAuth = false;
//$SMTPSecure = "none";
//$HOST =  "zpanel.andikam.com";
//$Port = 2525;
//$Username = "ventas@andikam.com";
//$Password = "balkir2004";
//$SetTo= "ventas@andikam.com";
//$SetFromName= "Contacto Karina Delgado Photography";
$SMTPAuth = $EMAILCONF_TEMP["SMTPAuth"];
$SMTPSecure = $EMAILCONF_TEMP["SMTPSecure"];
$HOST =  $EMAILCONF_TEMP["HOST"];
$Port = $EMAILCONF_TEMP["Port"];
$Username = $EMAILCONF_TEMP["Username"];
$Password = $EMAILCONF_TEMP["Pass"];
$SetTo= $EMAILCONF_TEMP["SetFrom"];
$SetFromName= "Contacto Karina Delgado Photography";
$errorConfi ="Error : Datos de configuración de incompletos";
$errorCliente = "";
$band = false;
$band2 = false;
        
if($HOST == "" || is_null($HOST)){$band =true;}
if($Port == "" || is_null($Port)){$band =true;}
if($Username == "" || is_null($Username)){$band =true;}
if($Password == "" || is_null($Password)){$band =true;}
if($SetTo == "" || is_null($SetTo)){$band =true;}

if($band){
    $_REQUEST["SendMail"]='N';
}else{
    if ($_REQUEST["SendMail"]=='S'){
        if ($_REQUEST["from-email"]=='') {$errorCliente = "- Correo Electrónico Campo Obligatorio \n";}
        if ($_REQUEST["from-nombre"]=='') {$errorCliente = "- Nombre Campo Obligatorio \n";}
        if ($_REQUEST["from-telefono"]=='') {$errorCliente = "- Teléfono Campo Obligatorio \n";}
        if ($_REQUEST["from-asunto"]=='') {$errorCliente = "- Asunto Campo Obligatorio \n";}
        if ($_REQUEST["from-mensaje"]=='') {$errorCliente = "- Mensaje Campo Obligatorio \n";}
        if($errorCliente != ''){$_REQUEST["SendMail"]='N';}
    }
}

header("Content-Type: text/html;charset=utf-8");
if(isset($_REQUEST["SendMail"])&& $_REQUEST["SendMail"]=='S'){

    if (isset($_REQUEST["from-email"])&& $_REQUEST["from-email"]!='') {
        $cuerpo = "Nombre :".$_REQUEST["from-nombre"]."<br>".
                "Teléfono :".$_REQUEST["from-telefono"]."<br>".
                "Correo Electrónico :".$_REQUEST["from-email"]."<br>".
                "Mensaje :".$_REQUEST["from-mensaje"]."<br>";
        require_once 'phpmailer/class.phpmailer.php';

        $mail = new PHPMailer ();
        $mail->SetLanguage('es','language/');
        $mail->IsSMTP();

        $mail -> From = $_REQUEST["from-email"];
        $mail -> FromName = $SetFromName;
        $mail -> SMTPAuth = $SMTPAuth =='true'?true:false;
        if($SMTPSecure!='none') {$mail -> SMTPSecure = $SMTPSecure;}
        $mail -> Port = $Port;
        $mail -> Username = $Username;
        $mail -> Password = $Password;
        $mail -> AddAddress($SetTo);//Direcion Karina
        $mail->CharSet = "utf-8";
        $mail -> Subject = $_REQUEST["from-asunto"];
        $mail -> IsHTML (true);
        $mail -> Body = $cuerpo;
        $mail->Host = $HOST;
        $mail->AddReplyTo($_REQUEST["from-email"], $_REQUEST["from-email"]);
        $mail->Timeout=30;
        if(!$mail->Send()){
//            echo $mail->ErrorInfo;
            echo "<script> alert('".$mail->ErrorInfo."');</script>"; 
        }
    }else{
        echo "<script> alert('No se puede enviar correo electrónico, cliente sin dirección de correo');</script>"; 
    }

?>

<script> location.href='contacto.php'</script> 
<?php } else { ?><script>location.href='contacto.php'</script><?php } ?>


