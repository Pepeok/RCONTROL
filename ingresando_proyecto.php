<? include("validacion.php");


  include("../conectabd/conexion_bd.php");


$dia_act=strftime("%d");
$mes_act=strftime("%m");
$ano_act=strftime("%Y");
$hora_act=strftime("%H");

$minutos_act=strftime("%M");
$fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
$hora_actual=$hora_act.":".$minutos_act;
$fecha_consulta=$ano_act."-".$mes_act."-".$dia_act;


//recibo los valores del formulario de la pagina marcaciones

$nombre_pro=$_POST["nombre_pro"];
$sigla_pro=$_POST["sigla_pro"];
$horas_pro=$_POST["horas_pro"];
$dpto=$_POST["dpto"];
$jdepro=$_POST["jdepro"];

if ($nombre_pro==""){

	echo "No se puede ingresar por falta de informacíón!";

}else{

mysql_select_db("rcontrol")or die("No se pudo hallar Base de Datos Control !!");


$qbuscar= " SELECT *  FROM  `proyectos` WHERE  `nombre_proyectos` LIKE  '%".$nombre_pro."%' ";
$qbuscar.= " or sigla_proyectos LIKE '%".$sigla_pro."%' "; 

$res = mysql_query($qbuscar)or die("error =" . mysql_error());
$num = mysql_num_rows($res);

if ($num>0){

	?>
			<SCRIPT LANGUAGE="JAVASCRIPT">
			     alert('Este nombre de proyecto ya existe!!');
      			 window.reload();
     			</SCRIPT>
     	<?		
    }else{

$query= " INSERT INTO  `rcontrol`.`proyectos` ( ";
$query.= " `id_proyectos` , ";
$query.= " `nombre_proyectos` , ";
$query.= " `sigla_proyectos` , ";
$query.= " `cant_hh_proyectos` , ";
$query.= " `id_dpto_proyectos` , ";
$query.= "`id_jefepro_proyectos` )";

VALUES (
NULL ,  '$nombre_proyecto',  '$sigla_proyecto',  '$horas',  '$dpto',  'Jefe_de_pro'
); ";



    }
}




//echo $query;


//Luego inserto un nuevo registro con los datos que recibi desde el formulario

 //$result = mysql_query($query);

 

 /*if($result>0)

	{ 

	?>

				<SCRIPT LANGUAGE="JAVASCRIPT">
				     alert('Registro insertado!!  Actualice la pagina para ver el cambio!!');

				     	  enviarMail (<? echo $id_usuario .", " ; echo $id_insertado. "," ;  echo " ' " .$asunto." ' " ; ?>); 

      				  window.opener.recargar_pagina();
      				 window.close();


     			</SCRIPT>

		<?

	}
	else
	{
		?>
			<SCRIPT LANGUAGE="JAVASCRIPT">
			     alert('Se produjo un error en la actualizacion Intente Nuevamente!!');
      			 window.reload();
     			</SCRIPT>
     	<?		

  
     mysql_close();

	}

}*/
?>