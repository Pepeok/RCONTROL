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
$modifica_func = "Ingresado el " . $fecha_actual . " por ID =" . $id_usuario . " ";
$estado_func = $_POST["estado"];
$valor = $_POST["valor"];
$asunto="Nuevo Profesional Externo.";

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


if ($rut_func==""){

	echo "No se puede ingresar el Profesional externo por falta de informacíón!";
        history.back(1);

}else{

mysql_select_db("rcontrol")or die("No se pudo hallar Base de Datos Control !!");

 $queryfunc= " SELECT * from funcionario  where rut_func=".$rut_func."";
 $queryfunc.=" and id_emp_func=".$id_emp_func." ";
 $queryfunc.=" and id_ldserv_func=".$id_ldserv_func." ";
 $queryfunc.=" and estado_func=".$tdr."; ";


$result=mysql_query($queryfunc)or die("error =".mysql_error());
$num=mysql_num_rows($result);
$num_filas=$num;

if ($num>0){ ?>

  <SCRIPT LANGUAGE="JAVASCRIPT">
           alert('Ya existe un Profesional con estos datos!!');
           history.back(1);
          </SCRIPT>
	<?						
}else{  

$query= " INSERT INTO  `rcontrol`.`funcionario` ( ";
$query.= " `id_func` , `nombre_func` , `nombre2_func` , `ape1_func` ,`ape2_func` , ";
$query.= " `rut_func` , `dv_func` , `fech_ing_func` , `fech_out_func` ,`email_func` ,";
$query.= " `id_emp_func` , `id_dpto_func` , `id_ldserv_func` , `id_proyectos_func` ,";
$query.= " `modifica_func` ,`estado_func`) ";
$query.= " VALUES ( NULL ,  '".$nombre_func."', '".$null."', '".$ape1_func."', '".$null."', ";
$query.= "  '".$rut_func."', '".$dv_func."', '".$fech_ing_func."', '".$fech_out_func."', '".$null."',  ";
$query.= "   '".$id_emp_func."',  '".$null."',  '".$id_ldserv_func."',  '".$null."',  '".$modifica_func."',  '".$tdr."'   ); ";

$result = mysql_query($query);

 if($result>0)

  {  
   $id_insertado = mysql_query("SELECT MAX(id_func) AS id_insertado FROM funcionario");
    if ($row = mysql_fetch_row($id_insertado)) {
  $id_insertado = trim($row[0]);
      }
      ?> 
<script languaje="javascript"> 
    alert ("Profesional ingresado ");
     enviarMail (<? echo $id_usuario .", " ; echo $id_insertado. "," ;  echo " ' " .$asunto." ' " ; ?>); 

     recargar_pagina(<? echo $id_insertado ?> );

</script> 
<? 
       
 }
}
}



//Luego inserto un nuevo registro con los datos que recibi desde el formulario

/* $result = mysql_query($query);

 

 if($result>0)

	{ 

	$id_insertado = mysql_query("SELECT MAX(id_func) AS id_insertado FROM funcionario");
	if ($row = mysql_fetch_row($id_insertado)) {
	$id_insertado = trim($row[0]);


	$id_jefedpto_asignado = mysql_query("SELECT jdpro_dpto  FROM dpto  where id_dpto=".$id_dpto_func." ");
	if ($row = mysql_fetch_row($id_insertado)) {
	$id_insertado = trim($row[0]);
	}



	}

$insertado=$id_insertado;

//echo $insertado;

$query_asignado=   "  INSERT INTO  `rcontrol`.`asignado` (`id_asignado` ,`id_dpto_asignado` ,`id_proyecto_asignado` , ";
$query_asignado.=  "  `id_funcionario_asignado` , `id_jefedpto_asignado` , `id_jefepro_asignado` , `fecha_asignado` , ";
$query_asignado.=  "  `estado_asignado` , `registro_asignado` , `nota_asignado` , `id_user_asignado` , `fecha_fin_asignado`) ";
$query_asignado.=  "  VALUES ( NULL ,  '".$id_dpto_func."',  '".$id_proyectos_func."',  '".$insertado."',  '".$id_jefedpto_asignado."',  '".$id_jefepro_proyectos."',  '".$fech_ing_func."' , '".$estado_func."' ,  ";
$query_asignado.=  "  CURRENT_TIMESTAMP ,  'asignado_online',  '".$id_usuario."',  '".$fech_out_func."' );  ";

//echo  $query_asignado;

$result2 = mysql_query($query_asignado);

if($result2>0)

	{ 


*/	?>

				<SCRIPT LANGUAGE="JAVASCRIPT">
				//     alert('Registro modificado!!  Actualice la pagina para ver el cambio!!');
      				// window.opener.recargar_pagina();
      				// window.close();


     			</SCRIPT>

		<?

/*	}
	else
	{*/
		?>
			<SCRIPT LANGUAGE="JAVASCRIPT">
			//     alert('Se produjo un error en la actualizacion Intente Nuevamente!!');
      			// window.reload();
     			</SCRIPT>
     	<?		
/*
  
     mysql_close();

	}
}
*/


?>
