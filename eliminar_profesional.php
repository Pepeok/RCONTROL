<?

$dia_act = strftime("%d");
$mes_act = strftime("%m");
$ano_act = strftime("%Y");
$hora_act = strftime("%H");

$minutos_act = strftime("%M");
$fecha_actual = $dia_act . "-" . $mes_act . "-" . $ano_act;
$hora_actual = $hora_act . ":" . $minutos_act;
$fecha_consulta = $ano_act . "-" . $mes_act . "-" . $dia_act;



 
$id_user = $_GET["idlogin"];
$id_prof = $_GET["id_prof"];


include("../conectabd/conexion_bd.php");
echo"</br>";
mysql_select_db("rcontrol") or die("No se pudo hallar Base de Datos Control !!");

$query = "UPDATE  `rcontrol`.`funcionario` SET ";
$query.= "estado_func = 0 , ";
$query.= " modifica_func =' Modificado el ".$fecha_actual." por ".$id_user."'    ";
$query.= " WHERE  `funcionario`.`id_func` =" . $id_prof . " ; ";

echo $query;


$result = mysql_query($query);
if ($result > 0) {
    
  ?>

    <SCRIPT LANGUAGE="JAVASCRIPT">
        alert('Registro eliminado!!  Actualice la pagina para ver el cambio!!'); 
        recargar_index();
     
    </SCRIPT>

    <?
} else {
    ?>

    <SCRIPT LANGUAGE="JAVASCRIPT">
        alert('Se produjo un error en la actualizacion Intente Nuevamente!!');
        nomina();
    </SCRIPT>
    <?
    mysql_close();
}

?>

