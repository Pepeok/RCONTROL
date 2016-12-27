<?
include("validacion.php");
include("../conectabd/conexion_bd.php");
include ("js.php");
include("libreria.php");


$dia_act = strftime("%d");
$mes_act = strftime("%m");
$ano_act = strftime("%Y");
$hora_act = strftime("%H");

$minutos_act = strftime("%M");
$fecha_actual = $dia_act . "-" . $mes_act . "-" . $ano_act;
$hora_actual = $hora_act . ":" . $minutos_act;
$fecha_consulta = $ano_act . "-" . $mes_act . "-" . $dia_act;






$id_asignacion = $_POST["id_asignacion"];
$id_login = $_POST["id_login"];
if ($id_login==""){

    $id_login=$_SESSION['id_usuario'];
}
$id_func = $_POST["id_func"];
$fecha_in = $_POST["fecha_in"];
$fecha_out = $_POST["fecha_out"];
$jdepro = $_POST["jdepro"];
$dpto = $_POST["dpto"];

mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");
$consulta_mysql = 'select * from dpto where id_dpto='.$dpto.'';
$result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
$num = mysql_num_rows($result);
$num_filas = $num;
while ($fila = mysql_fetch_array($result)) {
   $jdpto_dpto=$fila['jdpto_dpto'];
}

$proyecto = $_POST["proyecto"];
$fecha_ina = $_POST["fecha_ina"];
$fechaouta = $_POST["fechaouta"];
$estado_asignado = $_POST["estado_asignado"];
$registro_asignado = "registro_asignado";
$nota_asignado = "ingresado desde=" . getRealIP();
$nota_asignado2 = "modificado desde=" . getRealIP() . "por id=" . $id_login;
$asunto="Modificacion a Asignacion en SCHE";


$fecha_ina = invertirFecha($_POST["fecha_ina"]);
$fechaouta = invertirFecha($_POST["fechaouta"]);
mysql_select_db("rcontrol") or die("No se pudo hallar Base de Datos Control !!");

//echo $query1;
$query = " INSERT INTO  `rcontrol`.`asignado` (id_asignado , id_dpto_asignado , ";
$query.= "id_proyecto_asignado , ";
$query.= " id_funcionario_asignado , ";
$query.= " id_jefedpto_asignado , ";
$query.= " id_jefepro_asignado , ";
$query.= " fecha_asignado , ";
$query.= " estado_asignado , ";
$query.= " registro_asignado , ";
$query.= " nota_asignado , ";
$query.= " id_user_asignado , ";
$query.= " fecha_fin_asignado) ";
$query.= " VALUES ( NULL ,   ";
$query.= " " . $dpto . " ,";
$query.= " " . $proyecto . " ,";
$query.= " " . $id_func . " ,";
$query.= " " . $jdpto_dpto . " ,";
$query.= " " . $jdepro . " ,";
$query.= " '" . $fecha_ina . " ' ,";
$query.= " " . $estado_asignado . " ,";
$query.= " CURRENT_TIMESTAMP , ";
$query.= " '" . $nota_asignado . "' ,";
$query.= " " . $id_login . " ,";
$query.= "  ' " . $fechaouta . "') ";

//echo $query;

$result = mysql_query($query);



if ($result > 0) {

$query1 = "UPDATE  `rcontrol`.`asignado` SET ";
$query1.= "estado_asignado = 0 ,";
$query1.= "nota_asignado =" . "'" . $nota_asignado2 . "' ";
$query1.= " WHERE  `asignado`.`id_asignado` = " . $id_asignacion . " ; ";

    $result2 = mysql_query($query1) or die("error =" . mysql_error());


    if ($result2 > 0) {
        ?>

        <SCRIPT LANGUAGE="JAVASCRIPT">
            alert('Registro modificado!!  Actualice la pagina para ver el cambio!!');
              enviarMail(<? echo $id_login .", " ; echo $id_func. "," ;  echo " ' " .$asunto." ' " ; ?>); 

            window.close();
        </SCRIPT>

        <?
    } else {
        ?>

        <SCRIPT LANGUAGE="JAVASCRIPT">
            alert('Se produjo un error en la actualizacion Intente Nuevamente!!');
             window.close();
        </SCRIPT>
        <?
        mysql_close();
    }


    echo"</br>";
} else {
    ?>

    <SCRIPT LANGUAGE="JAVASCRIPT">
        alert('Se produjo un error en la actualizacion Intente Nuevamente!!');

        window.close();

    </SCRIPT>
    <?
}
?>

