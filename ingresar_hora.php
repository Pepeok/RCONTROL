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
echo $rut_func=$_POST["rut_func"];
echo"</br>";
echo "dv=".$dv_func=$_POST["dv_func"];
echo"</br>";
echo $fecha=$_POST["fecha"];
echo"</br>";
echo $hora_in=$_POST["hora_in"];
echo"</br>";
echo $hora_col=$_POST["hora_col"];
echo"</br>";
echo $hora_out=$_POST["hora_out"];
echo"</br>";
$null="";
echo"</br>";

if ($rut_func==""){

	echo "No se puede ingresar la hora por falta de informacíón!";

}else{

mysql_select_db("rcontrol")or die("No se pudo hallar Base de Datos Control !!");



$query= " INSERT INTO `rcontrol`.`marcaciones` ";
$query.= " (`id_marca`, `fecha_marca`, `rut_marca`, `cod_marca`, `in_marca`, ";
$query.= "  `hora_in_marca`, `out_marca`, `hora_out_marca`, `hora_colacion_func`, ";
$query.= "  `hora_n_marca`, `estado_marca`, `control_marca`, `comen_marca`, `reg_marca`, ";
$query.= "  `id_user_mod_marca`, `log_marca`, `informada_marca`) ";
$query.= "  VALUES  ";
$query.= "  (NULL, '".$fecha."', '".$rut_func."', '0', 'E', '".$hora_in."', 'S', ";
$query.= "  '".$hora_out."', '".$hora_col."', '00:00:00', 'Cargada', '0', 'cargada_de_libro', '', '".$_SESSION["id_usuario"]."', CURRENT_TIMESTAMP, '0'); ";

//echo $query;


//Luego inserto un nuevo registro con los datos que recibi desde el formulario

 $result = mysql_query($query);

 

 if($result>0)

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

}
?>