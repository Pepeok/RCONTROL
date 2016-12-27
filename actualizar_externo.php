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
echo "rut=".$rut_func=$_POST["rut_func"];
echo"</br>";
echo "dv=".$dv_func=$_POST["dv_func"];
echo"</br>";
echo "Nombre=".$nombre_func=$_POST["nombre_func"];
echo"</br>";
echo "Apellido =".$ape1_func=$_POST["ape1_func"];
echo"</br>";
echo "Fecha de Ingreso".$fech_ing_func=$_POST["fecha_in"];
echo"</br>";
echo "Fecha Salida ".$fech_out_func=$_POST["fechaout"];
echo"</br>";
echo "empresa=".$id_emp_func=$_POST["empresa"];
echo"</br>";
echo "Departamento=".$id_dpto_func=$_POST["dpto"];
echo"</br>";
echo "Linea de servicio=".$id_ldserv_func=$_POST["ldserv"];
echo"</br>";
echo "Proyecto".$id_proyectos_func=$_POST["proyecto"];
echo"</br>";
echo "Valor a ingresar ".$modifica_func="ingresado el ".$fecha_actual."";
echo"</br>";
echo "TDR=".$estado_func=$_POST["tdr"];
$null="";
echo"</br>";


mysql_select_db("rcontrol")or die("No se pudo hallar Base de Datos Control !!");


$query= "  UPDATE  `rcontrol`.`funcionario` SET "; 
$query.= " nombre2_func =  's', ";
$query.= " ape1_func =  'lazos', ";
$query.= " ape2_func =  's', ";
$query.= " rut_func =  '154313', ";
$query.= " dv_func =  '8', ";
$query.= " fech_ing_func =  '2015-10-3', ";
$query.= " fech_out_func =  '2016-01-11', ";
$query.= " email_func =  'ee', ";
$query.= " id_emp_func =  '5', ";
$query.= " id_dpto_func =  '6', ";
$query.= " id_ldserv_func =  '8', ";
$query.= " id_proyectos_func =  '5', ";
$query.= " modifica_func =  'ingresado el', ";
$query.= " estado_func =  '1' WHERE  `funcionario`.`id_func` =119 ; ";


echo $query;

//Luego inserto un nuevo registro con los datos que recibi desde el formulario

/* $result = mysql_query($query);

 

 if($result>0)

	{ 
	
		?>

				<SCRIPT LANGUAGE="JAVASCRIPT">
				     alert('Registro modificado!!  Actualice la pagina para ver el cambio!!');
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