<?
include("../conectabd/conexion_bd.php");
include ("libreria.php");
include ("js.php");

$dia_act = strftime("%d");
$mes_act = strftime("%m");
$ano_act = strftime("%Y");
$hora_act = strftime("%H");

$minutos_act = strftime("%M");
$fecha_actual = $dia_act . "-" . $mes_act . "-" . $ano_act;
$hora_actual = $hora_act . ":" . $minutos_act;
$fecha_consulta = $ano_act . "-" . $mes_act . "-" . $dia_act;


//recibo los valores del formulario de la pagina marcaciones
/*
  echo "id_func=".$id_func=$_POST["id_func"];
  echo "<br>";
  echo "rut=".$rut_func=$_POST["rut_func"];
  echo"</br>";
  echo "dv=".$dv_func=$_POST["dv_func"];
  echo"</br>";
  echo "Nombre=".$nombre_func=trim($_POST["nombre_func"]);
  echo"</br>";
  echo "Apellido =".$ape1_func=trim($_POST["ape1_func"]);
  echo"</br>";
  echo "Fecha de Ingreso".$fech_ing_func=trim($_POST["fecha_in"]);
  $fech_ing_func=fecha_mysql($fech_ing_func);
  echo"</br>";
  echo "Fecha Salida ".$fech_out_func=trim($_POST["fechaout"]);
  $fech_out_func=fecha_mysql($fech_out_func);
  echo"</br>";
  echo "empresa=".$id_emp_func=$_POST["empresa"];
  echo"</br>";
  echo "empresa2=".$id_emp_func2=$_POST["empresa2"];
  echo"</br>";
  echo "tdr=".$tdr=$_POST["tdr"];
  echo"</br>";
  echo "Linea de servicio=".$id_ldserv_func=$_POST["ldserv"];
  echo"</br>";
  echo "tdr2=".$tdr2=$_POST["tdr2"];
  echo"</br>";
  echo "Linea de servicio2=".$id_ldserv_func2=$_POST["ldserv2"];
  echo"</br>";
  //	echo "Proyecto".$id_proyectos_func=$_POST["proyecto"];
  echo"</br>";
  echo "Valor a ingresar ".$modifica_func="Actualizado el ".$fecha_actual." por ID =".$id_usuario." ";
  echo"</br>";
  echo "TDR=".$estado_func=$_POST["estado"];
  echo"</br>";
  echo "VALOR NUEVO=".$valor=$_POST["valor"];
*/
 
$id_usuario = $_POST["id_usuario"];
$id_func = $_POST["id_func"];
$rut_func = $_POST["rut_func"];
$dv_func = $_POST["dv_func"];
$nombre_func = strtoupper(trim($_POST["nombre_func"]));
$ape1_func = strtoupper(trim($_POST["ape1_func"]));
$fech_ing_func = trim($_POST["fecha_in"]);
$fech_ing_func = fecha_mysql($fech_ing_func);
$fech_out_func = trim($_POST["fechaout"]);
$fech_out_func = fecha_mysql($fech_out_func);
$id_emp_func = $_POST["empresa"];
$id_emp_func2 = $_POST["empresa2"];
$tdr = $_POST["tdr"];
$id_ldserv_func = $_POST["ldserv"];
$tdr2 = $_POST["tdr2"];
$id_ldserv_func2 = $_POST["ldserv2"];
$modifica_func = "Actualizado el " . $fecha_actual . " por ID =" . $id_usuario . " ";
$estado_func = $_POST["estado"];
$valor = $_POST["valor"];
$asunto= " Modificacion profesional Externo";

$null = "";

if ($id_ldserv_func == 0) {
    $id_ldserv_func = $id_ldserv_func2;
}
if ($id_emp_func == 0) {
    $id_emp_func = $id_emp_func2;
}
if ($tdr == 0) {
    $tdr = $tdr2;
}

echo"</br>";
mysql_select_db("rcontrol") or die("No se pudo hallar Base de Datos RControl !!");

$query = "UPDATE  `rcontrol`.`funcionario` SET ";
$query.= "nombre_func = '" . $nombre_func . "' , ";
$query.= " ape1_func =  '" . $ape1_func . "', ";
$query.= " rut_func =  " . $rut_func . ", ";
$query.= " dv_func =   '" . $dv_func . "', ";
$query.= " fech_ing_func =  '" . $fech_ing_func . "', ";
$query.= " fech_out_func =  '" . $fech_out_func . "', ";
$query.= " id_emp_func =  " . $id_emp_func . ", ";
$query.= " id_ldserv_func =  " . $id_ldserv_func . ", ";
$query.= " modifica_func =  '" . $modifica_func . "', ";
$query.= " estado_func =  '" . $tdr . "' ";
$query.= " WHERE  `funcionario`.`id_func` =" . $id_func . " ; ";

//echo $query;
$result = mysql_query($query);
if ($result > 0) {
    ?>

    <SCRIPT LANGUAGE="JAVASCRIPT">
        enviarMail (<? echo $id_usuario .", " ; echo $id_func. "," ;  echo " ' " .$asunto." ' " ; ?>); 
        //envia();
        recargar_pagina(<? echo $id_func ?> );
     
    </SCRIPT>

    <?
} else {
    ?>

    <SCRIPT LANGUAGE="JAVASCRIPT">
        alert('Se produjo un error en la actualizacion Intente Nuevamente!!');
        recargar_pagina(<? echo $id_func ?> );
    </SCRIPT>
    <?
    mysql_close();
}
?>

