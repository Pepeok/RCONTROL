<?
include("../conectabd/conexion_bd.php");
include ("libreria.php");
include ("js.php");





$dia_act=strftime("%d");
$mes_act=strftime("%m");
$ano_act=strftime("%Y");
$hora_act=strftime("%H");

$minutos_act=strftime("%M");
$fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
$hora_actual=$hora_act.":".$minutos_act;
$fecha_consulta=$ano_act."-".$mes_act."-".$dia_act;
$fecha_out=$_POST["fecha_out"];
$fecha_in=$_POST["fecha_in"];
//$id_func=$_GET["id_func"];
$dpto = $_POST["dpto"];
$fech_ing_func=trim($_POST["fecha_ina"]);
$fech_out_func=trim($_POST["fechaouta"]);
$id_usuario=$_POST["id_usuario"];
$proyecto = $_POST["proyecto"];
$id_func = $_POST["id_func"];
$jdpto = jdpto($dpto);
$jdepro = $_POST["jdepro"];
$fecha_ina = fecha_mysql($fech_ing_func);
$estado_func = $_POST["estado_asignado"];
$registro_asignado = $_POST["registro_asignado"];
$nota_asignado = getRealIP();
$fechaouta = fecha_mysql($fech_out_func);
$asunto = "Nueva Asignación a Profesional Externo";



$queryasignado= " INSERT INTO  `rcontrol`.`asignado` ( ";
$queryasignado.=" `id_dpto_asignado` , ";
$queryasignado.=" `id_proyecto_asignado` , ";
$queryasignado.=" `id_funcionario_asignado` , ";
$queryasignado.=" `id_jefedpto_asignado` , ";
$queryasignado.=" `id_jefepro_asignado` , ";
$queryasignado.=" `fecha_asignado` , ";
$queryasignado.=" `estado_asignado` , ";
$queryasignado.=" `registro_asignado` , ";
$queryasignado.=" `nota_asignado` , ";
$queryasignado.=" `id_user_asignado` , ";
$queryasignado.=" `fecha_fin_asignado`)";
$queryasignado.="  VALUES ('$dpto',  '$proyecto',  '$id_func',  '$jdpto',";
$queryasignado.=" '$jdepro',  '$fecha_ina',  '$estado_func', ";
$queryasignado.=" CURRENT_TIMESTAMP ,  '$nota_asignado',  '$id_usuario', ";
$queryasignado.=" '$fechaouta'); ";


//

$result=mysql_query($queryasignado)or die("error =".mysql_error());


if ($result>0){ 
$id_func=$id_func;?>
  <SCRIPT LANGUAGE="JAVASCRIPT">
           alert('Asignacion Realizada !!');
         
           enviarMail (<? echo $id_usuario .", " ; echo $id_func. "," ;  echo " ' " .$asunto." ' " ; ?>); 
           
           recargar_pagina_asignacion(<? echo $id_func ?> );
     
    </SCRIPT>
	<?						
}else{  
    ?>

  <SCRIPT LANGUAGE="JAVASCRIPT">
           alert('Error en la asignacion !!');
   
          </SCRIPT>
	<?	
}

?>
