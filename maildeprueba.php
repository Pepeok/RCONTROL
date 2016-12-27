<?php
$titulo = $_POST["titulo"];
$asunto = $_POST["asunto"];
$mensaje = $_POST["mensaje"];
if (mail("jose.zamora@sii.cl",$titulo,$asunto,$mensaje)) {
    echo "El mail ha sido enviado";
}else{
    echo "Error de envio " . mysql_error();
}
?>