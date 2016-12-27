<? include("validacion.php");


  include("../conectabd/conexion_bd.php");


//recibo los valores del formulario de la pagina marcaciones

$fecha_muestra=$_POST["fecha_muestra"];

$id_marca=$_POST["id_marca"];
$fecha_marca=$_POST["fecha_marca"];
$rut_marca=$_POST["rut_marca"];
$cod_marca=$_POST["cod_marca"];
$in_marca=$_POST["in_marca"];
$out_marca=$_POST["out_marca"];
$hora_col=$_POST["hora_col"];
$user=$_SESSION["id_usuario"];
$nombre=$_POST["nombre"];
$ape1=$_POST["ape1"];
$ape2=$_POST["ape2"];
$nombrecomp=$nombre." ". $ape1." ".$ape2;
$horaout=$_POST["horaout"];
$horain=$_POST["horain"];
$comentarioN=$_POST["comentario"];
$id_user_mod_marca=$_SESSION["id_usuario"];

$opcion=$_POST["opcion"];

if ($opcion=="E"){

 $msjemail="Entrada";
 $horamsje=$horain;
 $hora_col="01:00:00";
 $in_marca="E";
 $estado_marca="Corregida_E";
 $control_marca="1";

}

if ($opcion=="S"){
 $msjemail="Salida";
 $horamsje=$horaout;
 $hora_col="01:00:00";
 $out_marca="S";
 $estado_marca="Corregida_S";
 $control_marca="1";
}

if ($opcion=="ambas"){

 $msjemail="Entrada y Salida";
 $horamsje= "E".$horain." S ".$horaout;
 $hora_col="01:00:00";
 $in_marca="E";
 $out_marca="S";
 $estado_marca="Corregida_ES";
 $control_marca="1";
 }

if ($opcion=="j"){

 $msjemail="Falta Justificada";
 $horamsje= "E".$horain." S ".$horaout;
 $hora_col="00:00:00";
 $in_marca="E";
 $horain="00:00:00";
 $horaout="00:00:00";
 $out_marca="S";
 $estado_marca="JUSTIFICADA";
 $control_marca="5";
 }


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
		$mail_user=$fila3["email_usuario"];
	}		


//Luego inserto un nuevo registro con los datos que recibi desde el formulario

$query=" INSERT INTO  `rcontrol`.`marcaciones` (`fecha_marca` ,`rut_marca` ,`cod_marca` ,";
$query.=" `in_marca` ,`hora_in_marca` ,`out_marca` ,`hora_colacion_func` ,`hora_out_marca` ,`estado_marca` ,`control_marca`,";
$query.=" `comen_marca` , `reg_marca` , `id_user_mod_marca`  )";
$query.=" VALUES ('".$fecha_marca."', '".$rut_marca."',  '".$cod_marca."',  '".$in_marca."', ";
$query.=" '".$horain."',  '".$out_marca."',   '".$hora_col."', '".$horaout."',  '".$estado_marca."' ,'".$control_marca."', ";
$query.=" '".$comentarioN."', '".$id_marca."' , '".$id_user_mod_marca."'  );";

//echo $query;

	$result = mysql_query($query);

 
//si se inerta el registro modifico el actual pasandole el id del nuevo  y dejando marcado el registro pendiente
 if($result>0)

	{ 
	
			$id_insertado=mysql_insert_id();

			$reemplazo=$id_insertado;

			$query2=" UPDATE  `marcaciones` SET  `estado_marca`='anulada_x_nuevo',";
 			$query2.=" `control_marca` =  '3', `reg_marca` =  '".$reemplazo."' , ";  
 			$query2.=" `id_user_mod_marca` =  '".$id_user_mod_marca."' ";
			$query2.=" WHERE  `marcaciones`.`id_marca` =".$id_marca." LIMIT 1 ;";
 

 	    	$result2 = mysql_query($query2);

 		

 	
//  Ingresamos los destinatarios de correo

   
	   $para="inf_gestion.externos@sii.cl  ,";
	  echo $para.="".$mail_user."";
	   $asunto = "EXTERNOS - Regularización de marcas faltantes";
	   $asunto= utf8_encode("=?UTF-8?B?" . base64_encode("$asunto") .  "?=");

	  $mensaje = <<<EOT
<html>
	  <body>
					
		<p>&nbsp;</p>
		<p>Estimada </p>
		
		Favor ingresar la marcación de personal externo que se detalla a continuación.</p>
		<table width="41%" border="0" cellspacing="1" cellpadding="0">
        <ul>
		  <tr>
		    <td width="41%"><li>&nbsp;Rut</li></td>
		    <td width="59%">:$rut_marca </td>
	      </tr>
		  <tr>
		    <td><li>&nbsp;Nombre</li></td>
		    <td>:$nombrecomp </td>
	      </tr>
		  <tr>
		   <td><li>&nbsp;Fecha</li></td>
		    <td>:$fecha_muestra </td>
	      </tr>
		  <tr>
		    <td><li>&nbsp;Entrada o Salida</li></td>
		    <td>:$msjemail </td>
	      </tr>
          <tr>
		    <td><li>&nbsp;Hora a Registrar</li></td>
		    <td>:$horamsje </td>
	      </tr>
          </ul>
 </table>
		<p>Mensaje generado Automaticamente desde Sistema de control Horas Externas.<br />
		Realizado por: $nombre_usuario" "$apellido</p>
	<h5 style='color:green'>Cuidemos el medio ambiente. No imprima este correo si no es necesario.</h5>
</body>
</html>


    
     
EOT;
  
  $cabeceras  = 'From: inf_gestion.externos@sii.cl' . "\r\n";
  $cabeceras .= 'Reply-To: inf_gestion.externos@sii.cl' . "\r\n";
  $cabeceras .= "MIME-Version: 1.0\r\n";
 // $cabeceras .= "Cco:$con_copia\r\n";  
  $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";


  if(mail($para, $asunto, $mensaje, $cabeceras))
    {

           
      ?>
         <script language="javascript">
             alert("Se ha enviado el Mail  con la información  Correctamente !!");
             window.close();
           </script>
       
      <?

    }else{
		
		?>
         <script language="javascript">
             alert("No se pudo Enviar el Mail!!");
             window.close();
           </script>
      <?
		
		
		
		
		}
			

  
     mysql_close();

	}

?>
