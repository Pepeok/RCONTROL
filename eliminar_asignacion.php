<?

$dia_act = strftime("%d");
$mes_act = strftime("%m");
$ano_act = strftime("%Y");
$hora_act = strftime("%H");

$minutos_act = strftime("%M");
$fecha_actual = $dia_act . "-" . $mes_act . "-" . $ano_act;
$hora_actual = $hora_act . ":" . $minutos_act;
$fecha_consulta = $ano_act . "-" . $mes_act . "-" . $dia_act;



 
$id_user = $_GET["id_user"];
$id_asignacion = $_GET["id_asig"];


include("../conectabd/conexion_bd.php");
echo"</br>";
mysql_select_db("rcontrol") or die("No se pudo hallar Base de Datos Control !!");

$query = "UPDATE  `rcontrol`.`asignado` SET ";
$query.= "estado_asignado = 0 , ";
$query.= " registro_asignado = CURRENT_TIMESTAMP  ";
$query.= " WHERE  `asignado`.`id_asignado` =" . $id_asignacion . " ; ";

//echo $query;


$result = mysql_query($query);
if ($result > 0) {
    
    $query2="Select * from asignado WHERE  `asignado`.`id_asignado` =" . $id_asignacion . " ; ";
        $result = mysql_query($query2) or die("error =" . mysql_error());
        $num = mysql_num_rows($result);
        $num_filas = $num;
         while ($fila = mysql_fetch_array($result)) {
            $id_user_a=$fila['id_funcionario_asignado'];
          }
        
    ?>

    <SCRIPT LANGUAGE="JAVASCRIPT">
       // alert('Registro modificado!!  Actualice la pagina para ver el cambio!!'); 
        recargar_pagina(<? echo $id_user_a ; ?>);
     
    </SCRIPT>

    <?
} else {
    ?>

    <SCRIPT LANGUAGE="JAVASCRIPT">
        alert('Se produjo un error en la actualizacion Intente Nuevamente!!');
        recargar_pagina(<? echo $id_func_a ?> );
    </SCRIPT>
    <?
    mysql_close();
}
?>

