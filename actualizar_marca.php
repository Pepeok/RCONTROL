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


 $id_marca=$_POST["id_marca"];
 $fecha_marca=$_POST["fecha_marca"];

$rut_marca=$_POST["rut_marca"];
$cod_marca=$_POST["cod_marca"];
$in_marca=$_POST["in_marca"];
$horain=$_POST["horain"];

$out_marca=$_POST["out_marca"];
$horaout=$_POST["horaout"];
$comentarioN=$_POST["comentario"];
$hora_col=$_POST["hora_col"];
$user=$_SESSION["id_usuario"];
$nombre=$_POST["nombre"];
$ape1=$_POST["ape1"];
$ape2=$_POST["ape2"];
$opcion=$_POST["opcion"];
$nombrecomp=$nombre." ". $ape1." ".$ape2;
$id_user_mod_marca=$_SESSION["id_usuario"];







mysql_select_db("rcontrol")or die("No se pudo hallar Base de Datos Control !!");



//Primero traigo los datos del usuario que esta realizando la accion.

$query3="Select * from usuario where id_usuario=".$user.";";
 
$result3=mysql_query($query3)or die("error =".mysql_error());
$num3=mysql_num_rows($result3);
$num_filas3=$num3;

	while($fila3=mysql_fetch_array($result3))
	{
		$nombre_usuario=$fila3["nombre"];
		$apellido=$fila3["apellido"];
	}		


//Luego inserto un nuevo registro con los datos que recibi desde el formulario

$query=" INSERT INTO  `rcontrol`.`marcaciones` (`fecha_marca` ,`rut_marca` ,`cod_marca` ,";
$query.=" `in_marca` ,`hora_in_marca` ,`out_marca` ,`hora_colacion_func` ,`hora_out_marca` ,`estado_marca` ,`control_marca`,";
$query.=" `comen_marca` , `reg_marca` , `id_user_mod_marca` )";
$query.=" VALUES ('".$fecha_marca."', '".$rut_marca."',  '".$cod_marca."',  '".$in_marca."', ";
$query.=" '".$horain."',  '".$out_marca."',   '".$hora_col."', '".$horaout."',  'vigente_mod ' ,'1',";
$query.=" '".$comentario."', '".$id_marca."' , '".$id_user_mod_marca."'  );";


$result = mysql_query($query);

 

 if($result>0)

	{ 
	
			$id_insertado=mysql_insert_id();

			$reemplazo=$id_insertado;

			$query2=" UPDATE  `marcaciones` SET  `estado_marca`='anulada_x_nuevo',";
 			$query2.=" `control_marca` =  '3', `reg_marca` =  '".$reemplazo."' , ";  
 			$query2.="`id_user_mod_marca` =  '".$id_user_mod_marca."' ";
			$query2.=" WHERE  `marcaciones`.`id_marca` =".$id_marca." LIMIT 1 ;";
 		
 		
 		$result2 = mysql_query($query2);

 
    	?>

				<SCRIPT LANGUAGE="JAVASCRIPT">
				     alert('Registro modificado!!  Actualice la pagina para ver el cambio!!');
				     //window.opener.recargar_pagina();
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

?>