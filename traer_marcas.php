
<?php 
include("../conectabd/conexion_bd.php"); 
 $rut=$_POST['rut'];
 $fecha_ini=$_POST['fecha_ini'];
 $fecha_fin=$_POST['fecha_fin'];


?>

    <br><br><br><br>


<table  id="Exportar_a_Excel" align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#999999">
        <th colspan="10" scope="col">DETALLE</th>
    </tr>
    <tr  bgcolor="#999999">
        <th >#</th>
        <th > PROFESIONAL</th>
        <th > RUT</th>
        <th >FECHA</th>
        <th >ENTRADA</th>
        <th >COLACION</th>
        <th >SALIDA</th>
        <th >HH FACTURABLE</th>
        <th >OBSERVACION</th>
    </tr>
    <?
    
    mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");
    $query4 = "  SELECT m .* , f.nombre_func,  f.ape1_func  , f.rut_func , f.dv_func ";
    $query4.= "  FROM  marcaciones m , funcionario f ";
    $query4.= "  WHERE m.rut_marca =".$rut." ";
    $query4.= "  AND f.rut_func=".$rut." ";
    $query4.= "  AND (m.control_marca <=2 OR m.control_marca =5) ";
    $query4.= "  AND m.fecha_marca >='".$fecha_ini."' ";
    $query4.= "  AND m.fecha_marca <='".$fecha_fin."' ;";
    
   
	//echo $query4; 

	$resultcont=mysql_query($query4)or die("error =".mysql_error());
    $num=mysql_num_rows($resultcont);
    $num_filas=$num;
    $horatotal='00:00:00';
    $hhfacturable='00:00:00';
    $reg = 1;
    if($num_filas>0 ){
        
    while($fila=mysql_fetch_array($resultcont))
    {
        $fecha_mostrar=$fila["fecha_marca"];
        $hora_in_marca=$fila["hora_in_marca"];
        $hora_out_marca=$fila["hora_out_marca"];
        $hora_colacion_func=$fila["hora_colacion_func"];
        $comen_marca = $fila["comen_marca"];
        $nombre_func = $fila["nombre_func"]; 
        $ape1_func = $fila["ape1_func"]; 
        $rut_func = $fila["rut_func"]; 
        $dv_func = $fila["dv_func"]; 
        
        $diferencia = resta($hora_in_marca, $hora_out_marca);
        // le resto la hora de colacion
        $hhfacturable = almuerzo($diferencia, $hora_colacion_func);


?>  
    
	<tr align="center">			  
        <td> <? echo $reg ?> </td> 
        <td> <? echo $nombre_func ." ".$ape1_func?></td>
        <td> <? echo $rut_func ."-".$dv_func ?></td>
		<td> <? echo $fecha_mostrar?></td>
		<td> <? echo $hora_in_marca ?></td>
		<td> <? echo $hora_colacion_func ?></td>
        <td> <? echo $hora_out_marca;  ?></td>
        <td> <? echo $hhfacturable;  ?></td>
		<td> <? echo $comen_marca;  ?></td>


    </tr>
      <?php 
                
                
    
      $dias = $num_filas;
      $horatotal = sumahoras($horatotal, $hhfacturable); //llamando a la función.

     $reg ++ ;

          } 
   }


       ?>


      <tr>
        <td  align="center"colspan="10"><h2><strong>Total  <?php  echo  $horatotal ; ?> Horas en este mes </strong></h2></td>
      </tr>  		
</tbody>
</table>  



<? 	function resta($inicio, $fin)
	{	$dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
	  	return $dif;
	   }
	function almuerzo($diferencia, $horal)
	{	$alm=date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal) );
		return $alm;
	   }

       function sumahoras($hora1, $hora2) {
    $hora1 = explode(":", $hora1);
    $hora2 = explode(":", $hora2);
    $horas = (int) $hora1[0] + (int) $hora2[0];
    $minutos = (int) $hora1[1] + (int) $hora2[1];
    $segundos = (int) $hora1[2] + (int) $hora2[2];
    $horas+=(int) ($minutos / 60);
    $minutos = (int) ($minutos % 60) + (int) ($segundos / 60);
    $segundos = (int) ($segundos % 60);
    return (intval($horas) < 10 ? '0' . intval($horas) : intval($horas)) . ':' . ($minutos < 10 ? '0' . $minutos : $minutos) . ':' . ($segundos < 10 ? '0' . $segundos : $segundos);
}
?>	
<script type="text/javascript" src="./js/jquery-1.9.1.min.js"></script>