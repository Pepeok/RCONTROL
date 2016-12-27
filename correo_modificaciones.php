  
  <?php
    //variables que recibo de la funcion jquery
  
  	$usuario     = $_POST['usuario'];
    $profesional = $_POST['profesional'];
    $asunto      = $_POST['asunto'];
    


    include("../conectabd/conexion_bd.php");
     mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");

      $queryUsuario= "SELECT nombre , apellido , email_usuario from usuario where id_usuario=".$usuario. ";";
        
        $result = mysql_query($queryUsuario) or die("error =" . mysql_error());
    
       while ($fila = mysql_fetch_array($result)) {

            $nombre = $fila["nombre"];  
            $apellido = $fila["apellido"]; 
            $mail = $fila["email_usuario"]; 
            } 
            
    
      $queryProfesional= "SELECT nombre_func , ape1_func  , rut_func , dv_func from funcionario  where id_func=".$profesional.";";
      $result2 = mysql_query($queryProfesional) or die("error =" . mysql_error());
    
       while ($fila2 = mysql_fetch_array($result2)) {

            $nombre_func = $fila2["nombre_func"];  
            $apellido_func = $fila2["ape1_func"]; 
            $rut = $fila2["rut_func"];
            $dv = $fila2["dv_func"];
            } 
           
    
      $para= "jose.zamora@sii.cl,smartine@sii.cl,inf_gestion.externos@sii.cl";
    
      $mensaje  = "<html>\n";
      $mensaje .= "<body>\n";
      $mensaje .= " Se informa que ".$nombre ."  ". $apellido."  realizo una modificación en SCHE  ";
      $mensaje .= "</br>";
      $mensaje .= " Profesional :  ".$nombre_func  ."  ".  $apellido_func."\n";
      $mensaje .= "</br>";
      $mensaje .= " Rut : " .$rut . "-" . $dv   ;
      $mensaje .= "</br>";
      $mensaje .=" Cualquier duda o consulta  dirigirlas a inf_gestion.externos@sii.cl.\n";
      $mensaje .= "</br>";
      $mensaje .= " Link: <a href='http://lime/rcontrol'>http://lime/rcontrol</a>.\n";
  	  $mensaje .= "</br>";	
  	  $mensaje .= "</br>";
  	  $mensaje .=" Departamento de Informática Calidad y  Gestión.";
  	  $mensaje .= "	<html>\n";
  	  $mensaje .= "	<body>\n";
  	
  	 		

        	 	  $cabeceras  = 'From: inf_gestion.externos@sii.cl' . "\r\n";
    					$cabeceras .= 'Reply-To: inf_gestion.externos@sii.cl' . "\r\n";
    					$cabeceras .= "MIME-Version: 1.0\r\n";
    					$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

   mail($para, $asunto, $mensaje, $cabeceras)


   
    
  ?>
