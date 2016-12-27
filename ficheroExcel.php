<?php
//echo "id del usuario es = ".
$id_user=$_POST['id_user'];
//echo "<br>";
//echo "contrato es = ".
$contrato=$_POST['contrato'];
//echo "<br>";
//echo "nombre empresa es = ".
$empresanombre="'".$_POST['empresa']."'";
//echo "<br>";
//echo "id empresa es = ".
$empresa=$_POST['empresa'];
//echo "<br>";
//echo "fecha es  = ".
$fecha=$_POST['fecha'];
//echo "<br>";
//echo "PGC es = ".
$pgc=$_POST['pgc'];
//echo "<br>";
//echo "La extencion  es = ".
$extencion="xls"; 
//echo "<br>";



include("../conectabd/conexion_bd.php");
mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");

$rs = mysql_query("SELECT MAX(id_informes) AS id FROM informes");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}
$correlativo=$id;

$nombrearch="'".$pgc."_".$contrato."_".$empresa."_".$fecha."_0".$correlativo.".".$extencion."'";
//echo "<br>";
$query= " INSERT INTO  `rcontrol`.`informes` (`id_informes` ,`nombre_informe` ,`empresa` , ";
$query.="  `id_user_informe` ,`fecha_generacion_informe`) " ;
$query.=" VALUES (NULL ,  ".$nombrearch." ,  ".$empresanombre." ,  ".$id_user.",CURRENT_TIMESTAMP); ";
//echo $query;
//echo "<br>";
$result = mysql_query($query);
if($result>0)
	{ 
$nombrearch=$pgc."_".$contrato."_".$empresa."_".$fecha."_0".$correlativo.".".$extencion;
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename='".$nombrearch."'");
header("Pragma: no-cache");
header("Expires: 0");

 echo $_POST['datos_a_enviar'];
}else{
echo "Error al generar el archivo Verifica la información";
}

?>
