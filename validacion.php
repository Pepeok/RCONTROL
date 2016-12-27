<? session_start();
	//COMPRUEBA QUE EL USUARIO ESTA AUTENTICADO
	if ($_SESSION['controla'] != "si") {
		
	//si no existe, va a la página de autenticacion
		?>
		<SCRIPT LANGUAGE="JAVASCRIPT">

		window.location="login.html";

		</SCRIPT>
		<?
		//salimos de este script
		exit();
	}


include("../conectabd/conexion_bd.php");
?>

