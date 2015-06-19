<?
class Usuariosenlinea
{
/*
     * @param string $servidor el host para conectar, usualmente localhost
     * @param string $basededatos el nombre de la base de datos
     * @param string $nombredb el nombre de la tabla, preferentemente no editar
     * @param string $usuario usuario de la base de datos
     * @param string $pass la contraseña de la base de datos
*/

   var $servidor = 'localhost' ;
   var $basededatos = 'agendoo_base' ;
   var $nombredb = 'usuariosenlinea' ;
   var $usuario = 'root' ;
   var $pass = 'clareopapyrossygma';
## Fin de Conexion ##
var $e_rror ;
//Segundos para borrar de la base de datos a los usuarios inactivos
var $segundos = 60;
   var $ahora = 0; 
//CONSTRUCTOR
function Usuariosenlinea () {
$this -> recargar ();

     }   
function cuantos () {

     return $this -> ahora ;

     }

     function enlinea () {

         if( $this -> ahora == 1 ) {
     echo $this -> ahora . " Usuarios en linea" ;
         }
         else
         {
     echo $this -> ahora . " Usuarios en linea" ;
         }

     }

         function ipreal (){

             if ( $real_ip = getenv ( 'HTTP_X_FORWARDED_FOR' )){

$explode_real_ip = explode ( "," , $real_ip );
                 return trim ( $explode_real_ip [ 0 ]);
             }
             else
             {
             return getenv ( 'REMOTE_ADDR' );
             }
         }
         function error (){

         return $this -> e_rror = mysql_error ();
         }
         function recargar () {

$tiempo_actual = time ();
$tiempo_final = $tiempo_actual - $this -> segundos ;
$ip = $this -> ipreal ();

         @ mysql_connect ( $this -> servidor , $this -> usuario , $this -> pass )

         or die( 'Error al Intentar Conectar con la base de datos ' . $this -> error (). '' );
         @ mysql_select_db ( $this -> basededatos )

         or die( 'Error Seleccionando la base de datos ' . $this -> error (). '' );

$result = mysql_query ( "SELECT ip FROM $this->nombredb WHERE ip='$ip'" )
         or die( 'Error de lectura en la base de datos ' . $this -> error (). '' );

         if( mysql_num_rows ( $result ) == 0 ){

mysql_query ( "INSERT INTO $this->nombredb VALUES ('$tiempo_actual','$ip','$_SERVER[REQUEST_URI]')" )
         or die( 'Error al Insertar en la base de datos ' . $this -> error (). '' );
        }
         else

         {         
mysql_query ( "UPDATE $this->nombredb SET timestamp='$tiempo_actual' where ip='$ip'" )
         or die( 'Error al Insertar en la base de datos ' . $this -> error (). '' );
         }

mysql_query ( "DELETE FROM $this->nombredb WHERE timestamp < $tiempo_final" )
         or die( 'Error al intentar borrar en la base de datos ' . $this -> error (). '' );

$result = mysql_query ( "SELECT ip FROM $this->nombredb" )
         or die( 'Error de lectura en la base de datos ' . $this -> error (). '' );

$this -> ahora = mysql_num_rows ( $result );
mysql_close ();
         }
} ?>