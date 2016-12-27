 <?  include("js.php");?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Informe Semanal Empresas</title>
  <style type="text/css">
  .tabla_bordes {
      border-top-style: none;
      border-right-style: none;
      border-bottom-style: none;
      border-left-style: none;
  }
   table {     font-family: "Lucida Sans Unicode" ;
    font-size: 12px;  }
  </style>
  </head>
  <? include("../conectabd/conexion_bd.php"); 
      mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");



// Datos que recibo de la Consulta //    
  $empresa=$_POST['empresa'];
 
  $fecha_ini=$_POST['fecha_ini'];
  $fecha_fin=$_POST['fecha_fin'];
  $id_user=$_POST['id_usuario'];
  $pgc=$_POST['pgc'];

// invierto las fechas para la query mysql//
  $fecha_consulta_ini=fecha_mysql($fecha_ini); 
  $fecha_consulta_fin=fecha_mysql($fecha_fin);
// pongo comillas a las varibles para el mysql
  $fecha_consulta_ini="'".$fecha_consulta_ini."'";
  $fecha_consulta_fin="'".$fecha_consulta_fin."'";

//+++++++Fin datos de consulta++++++//


//fecha para excel es al fecha final que ingreso el usuario

$fecha_exel=fechaexel($fecha_fin);
 
 
// Datos de fecha y hora actual en el servidor //
  $dia_act=strftime("%d");
  $ano_act=strftime("%Y");
  $hora_act=strftime("%H");
  $minutos_act=strftime("%M");
  $fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
  $hora_actual=$hora_act.":".$minutos_act;

//++++++FIN_ fecha del Servidor*****//

 
$fecha_consulta="'".$ano_act."-".$mes_act."-01'";

// Busco el valor del mes que me esta ingresando el usuario
$sacomes=nombredelmes($fecha_consulta_ini);
$sacoanio=anioconsultado($fecha_consulta_ini);

//Genero la variable para el mes y el año a consultar
$fecha_consulta_mes_ini="".$sacoanio."-".$sacomes."-01'";

 $fecha_consulta_mes_fin="".$sacoanio."-".$sacomes."-31'";
//fin Variables del mes completo

// Geenero el nombre del mes 
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$buscames=$sacomes-1;
$nombre_mes=$mes[$buscames];
// Fin del nombre del mes
  
 ?>

  <body>
  <div id="inf_mensual">
  <table align="center" width="90%" border="1" cellspacing="1" cellpadding="0">
    <tr bgcolor="#999999">
      <th>INFORME SEMANAL DE MARCACIONES</th>
    </tr>
  </table>
  
    <p align="center">Mes de <? echo $nombre_mes; ?> de <? echo $ano_act; ?><br />
      Acumulado al <? echo $fecha_fin; ?>
    </p>
   
    <p>&nbsp;</p>

<div id="parte1">
<? include("parte1.php"); ?>
 </div> 
   <p>&nbsp;</p>

  
<div id="parte3">
<? include("parte3_sem.php"); ?>
 </div>  
<p>&nbsp;</p>

<div id="parte4">
  
<? 
 include("parte4.php"); ?>
 </div>  
  
 </div>
  <p>&nbsp;</p>
  
  <?		
	
	function horafraccion($hora1)
	{
	$hora1=explode(":",$hora1);
	$horas=(int)$hora1[0];	
	$minutos=(int)$hora1[1];	
	$segundos=(int)$hora1[2];
  $minfrac=($minutos/60);
  $suma=$horas+$minfrac;
  $suma2=round($suma,2); 
  $hora_frac=$suma2;
	return $hora_frac;
		
	}
  	 			
  function sumahoras ($hora1,$hora2)
  {
  $hora1=explode(":",$hora1);
  $hora2=explode(":",$hora2);
  $horas=(int)$hora1[0]+(int)$hora2[0];
  $minutos=(int)$hora1[1]+(int)$hora2[1];
  $segundos=(int)$hora1[2]+(int)$hora2[2];
  $horas+=(int)($minutos/60);
  $minutos=(int)($minutos%60)+(int)($segundos/60);
  $segundos=(int)($segundos%60);
  return (intval($horas)<10?'0'.intval($horas):intval($horas)).':'.($minutos<10?'0'.$minutos:$minutos).':'.($segundos<10?'0'.$segundos:$segundos); 
  }
  
  function sumahoras2 ($hora3,$hora4)
  {
  $hora3=explode(":",$hora3);
  $hora4=explode(":",$hora4);
  $horast=(int)$hora3[0]+(int)$hora4[0];
  $minutost=(int)$hora3[1]+(int)$hora4[1];
  $segundost=(int)$hora3[2]+(int)$hora4[2];
  $horast+=(int)($minutost/60);
  $minutost=(int)($minutost%60)+(int)($segundost/60);
  $segundost=(int)($segundost%60);
   return (intval($horast)<10?'0'.intval($horast):intval($horast)).':'.($minutost<10?'0'.$minutost:$minutost).':'.($segundost<10?'0'.$segundost:$segundost); 
 } 
  
  function resta2($inicio, $fin)
  {
    $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
      return $dif;
  }
  
  function almuerzo2($diferencia, $horal)
  {
   $alm=date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal) );
        return $alm;
  }

 function nombredelmes($fecha)
 {
 $fecha=explode("-",$fecha);
 $nom_mes=$fecha[1];
      return $nom_mes;
 }
// funcion que saca el año que ingreso el usuario
function anioconsultado($fecha)
 {
 $fecha=explode("-",$fecha);
 $num_año=$fecha[0];
      return $num_año;
 }

/* Funcion que invierte la fecha que recibe desde el formulario
    Con el fin que sea expresado en el MYSQL*/
function fecha_mysql($Fecha)
{
  $Fecha=explode("-",$Fecha);
  $femysql=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
  
    return $femysql;
}
//*******Fin invierte Fecha***********//

function invertirFecha($Fecha){
    $Fecha=explode("-",$Fecha);
    $fec=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
    return $fec;
     }

  function ajuste_log ($log_marca)
  {
    $fecha = preg_split("/[\s-]/", $log_marca);
    $ano = $fecha[0];
    $mes = $fecha[1];
    $dia = $fecha[2];
    $hora = $fecha[3];
    $log=$dia."-".$mes."-".$ano." a las ".$hora;
    return $log;
 } 
function fechaexel($Fecha){
    $Fecha=explode("-",$Fecha);
    $fecha_exel=$Fecha[2]."".$Fecha[1]."".$Fecha[0];
    return $fecha_exel;
     } 



?>


  </body>



  </html>
