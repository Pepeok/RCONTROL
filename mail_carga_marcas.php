<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//Es" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Control HH externos</title>
  

  <link rel="stylesheet" type="text/css" href="./css/style_sdi.css" />
   </head>
<body>
<h2 align="left"> Enviar Mail con las Marcas Pendientes.</h2>

<?php

include("js.php"); 
	
	$dia_act=strftime("%d");
	$mes_act=strftime("%m");
	$ano_act=strftime("%Y");
	$hora_act=strftime("%H");
	$minutos_act=strftime("%M");
	
	$fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
	$hora_actual=$hora_act.":".$minutos_act;
	
	//$fecha_consulta=$ano_act."-".$mes_act."-".$dia_act;
 //  $mes_act=9;
	
	$fecha_consulta_act="'".$ano_act."-".$mes_act."-".$dia_act."'";
	$fecha_consulta="'".$ano_act."-".$mes_act."-01'";
	$fecha_consulta_inicio="'".$ano_act."-".$mes_act."-01'";
	$fecha_consulta_fin="'".$ano_act."-".$mes_act."-31'";


	

  include("../conectabd/conexion_bd.php");


$para= "   jose.zamora@sii.cl ,  jmora@sii.cl , johann.renck@sii.cl , miguel.palma@sii.cl , obaez@sii.cl , ";
$para.= "  lrodrigu@sii.cl , gerardo.ureta@sii.cl , hcabrera@sii.cl , obaez@sii.cl , andres.loyola@sii.cl , ";
$para.= "  juan.olmedo@sii.cl , cristian.navarro@sii.cl , graciela.saud@sii.cl , pfzamora@sii.cl , jlabbe@sii.cl , ";
$para.= "  jmatus@sii.cl , mlacoste@sii.cl , mvnunez@sii.cl , andres.loyola@sii.cl , catherine.figueroa@sii.cl , ";
$para.= "  jlabbe@sii.cl , sandra.cifuentes@sii.cl , ruth.gordillo@sii.cl , kissy.rubilar@sii.cl , cguardia@sii.cl , ";
$para.= "  imontgomery@sii.cl , ricardo.villarroel@sii.cl , jmora@sii.cl , mcarrasc@sii.cl , ccabezas@sii.cl , ";
$para.= "  pedro.urrutia@sii.cl , nbravo@sii.cl , mcarrasc@sii.cl , dnfigueroa@sii.cl , lorena.ruiz@sii.cl , ";
$para.= "  descobar@sii.cl , cristobal.fernandez@sii.cl , ahervias@sii.cl  , csantana@sii.cl , me.valladares@sii.cl , ";
$para.= "  lnavia@sii.cl , walter.sandoval@sii.cl , andrea.lagos@sii.cl , mcornejo@sii.cl , jacrojas@sii.cl , ";
$para.= "  mcadenasso@sii.cl , alejandro.glesias@sii.cl , eduardo.jaunez@sii.cl , cortiz@sii.cl , cescobar@sii.cl , ";
$para.= "  hsanmartin@sii.cl , David.pacheco@sii.cl , jmori@sii.cl , asotomayor@sii.cl , cortiz@sii.cl, graciela.saud@sii.cl ";



    $asunto = "Revisar y regularizar Marcas externos.";

    $mensaje  = "<html>\n";
    $mensaje .= "<body>\n";
    $mensaje .="Estimados Jefes de Proyecto:\n";
    $mensaje .="</br>";
    $mensaje .=" Se realiza la carga de las marcaciones correspondientes a la  semana recién vencida en el \n";
    $mensaje .=" Sistema de Control de Horas Externos (SCHE)\n";
    $mensaje .= "</br>";	
    $mensaje .=" Por lo cual se  pide verificar las marcaciones y asignaciones correspondientes. \n";
    $mensaje .= "</br>";
    $mensaje .=" Cualquier duda, consulta o cambios  dirigirlas a inf_gestion.externos@sii.cl.\n";
    $mensaje .= "</br>";
    $mensaje .= "</br>";
    $mensaje .= " Link: <a href='http://lime/rcontrol'>http://lime/rcontrol</a>.\n";
	  $mensaje .= "</br>";	
	  $mensaje .= "</br>";
	  $mensaje .=" Departamento de Informática Gestión.";
	  $mensaje .= "	<html>\n";
	  $mensaje .= "	<body>\n";
	
	 				$cabeceras  = 'From: inf_gestion.externos@sii.cl' . "\r\n";
  					$cabeceras .= 'Reply-To: inf_gestion.externos@sii.cl' . "\r\n";
  					$cabeceras .= "MIME-Version: 1.0\r\n";
  					$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
 echo $mensaje;
 echo $para;
 

  if(mail($para, $asunto, $mensaje, $cabeceras))
    {

           
      ?>
         <script language="javascript">
             alert("Se ha enviado el Mail  Correctamente !!");
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

	
function resta5($inicio, $fin)
  	{
  	  $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
  	  return $dif;
    }
function almuerzo5($diferencia, $horal)
    {
  	  $alm=date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal) );
  	  return $alm;
  	}
function invertirFecha($Fecha){
    $Fecha=explode("-",$Fecha);
    $fec=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
    return $fec;
     }

function Fecha_mysql($Fecha){
    $Fecha=explode("-",$Fecha);
    $femysql=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
    return $femysql;
     }  
?>
</body>
</html>
