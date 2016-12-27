<? include("validacion.php");

function invertirFecha($Fecha){
    $Fecha=explode("-",$Fecha);
    $fec=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
    return $fec;
     }

  include("../conectabd/conexion_bd.php");


$id_marca=$_GET['id_marca'];
$dia_act=strftime("%d");
$mes_act=strftime("%m");
$ano_act=strftime("%Y");
$hora_act=strftime("%H");

$minutos_act=strftime("%M");
$fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
$hora_actual=$hora_act.":".$minutos_act;
$fecha_consulta=$ano_act."-".$mes_act."-".$dia_act;

//recibo los valores del formulario de la pagina marcaciones


echo"ID Marca=". $id_marca=$_POST["id_marca"];
echo "</br>";
echo" Fecha Marca=". $fecha_marca=$_POST["fecha_marca"];
echo "</br>";
echo"Rut Marca=". $rut_marca=$_POST["rut_marca"];
echo "</br>";
echo"Cod Marca=". $cod_marca=$_POST["cod_marca"];
echo "</br>";
echo"In Marca=". $in_marca=$_POST["in_marca"];
echo "</br>";
echo "Hora in".$horain=$_POST["horain"];
echo "</br>";
echo"out Marca=". $out_marca=$_POST["out_marca"];
echo "</br>";
echo "Hor OUT=".$horaout=$_POST["horaout"];
echo "</br>";
echo "comentario=".$comentarioN=$_POST["comentario"];
echo "</br>";
echo "Hor COLacion=".$hora_col=$_POST["hora_col"];
echo "</br>";
echo "ID de usuario ". $user=$_SESSION["id_usuario"];
echo "</br>";
echo "nombre=".$nombre=$_POST["nombre"];
echo "</br>";
echo "ape1=".$ape1=$_POST["ape1"];
echo "</br>";
echo "ape2=".$ape2=$_POST["ape2"];
echo "</br>";
echo "opcion=".$opcion=$_POST["opcion"];
echo "</br>";
echo "nombre comp=".$nombrecomp=$nombre ," ",$ape1," ",$ape2;







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
$query.=" `comen_marca` , `reg_marca`  )";
$query.=" VALUES ('".$fecha_marca."', '".$rut_marca."',  '".$cod_marca."',  '".$in_marca."', ";
$query.=" '".$horain."',  '".$out_marca."',   '".$hora_col."', '".$horaout."',  'informada ' ,'4', '".$comentario."', '".$id_marca."' );";


$result = mysql_query($query);

 

 if($result>0)

	{ 
	
			$id_insertado=mysql_insert_id();

			$reemplazo=$id_insertado;

			$query2=" UPDATE  `marcaciones` SET  `estado_marca`='informada',";
 			$query2.=" `control_marca` =  '4', `reg_marca` =  '".$reemplazo."' ";  
			$query2.=" WHERE  `marcaciones`.`id_marca` =".$id_marca." LIMIT 1 ;";
 
      	     $result2 = mysql_query($query2);

      if ($resul2>0){
 			

           $para = "josezamora11@gmail.com ,jose.zamora@sii.cl";
	  	   $asunto = "EXTERNOS - Regularización de marcas faltantes";
	      	$mensaje = <<<EOT
			<html>
	  <body>
	  <p>Estimada</p>
      <p>Favor ingresar la marcación de personal externo que se  detalla a continuación</p>
      <p>&nbsp;</p>
      <ul>
        <li>Rut&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :15681913-1 </li>
        <li>Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :Sergio  Bustos</li>
        <li>Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;:08-04-2015</li>
        <li>Entrada o  Salida: Salida&nbsp; </li>
        <li>Hora a  registrar&nbsp;  :20:57</li>
      </ul>
</body>
</html>

    
     
EOT;

			$cabeceras  = 'From: inf_gestion.externos@sii.cl' . "\r\n";
	  		$cabeceras .= 'Reply-To: inf_gestion.externos@sii.cl' . "\r\n";
  			$cabeceras .= "MIME-Version: 1.0\r\n";
  			$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";


 }else{
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