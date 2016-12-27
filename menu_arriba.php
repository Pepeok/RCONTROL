
<? 
include("js.php"); 
?>

<div class="navbar azulsii" id="barra_administrador" style="display:block;"> 
	
	<script type="text/javascript">

		
		</script>  

	<div class="navbar-inner azulsii">
		<div class="container-fluid">


			<!-- start: Header Menu -->
			<div class="nav-no-collapse header-nav ">

				<ul class="nav pull-right naranjosii">

					<!-- Inicio Menu Usuario -->

					<li class="dropdown">Fecha:<? echo $fecha_actual ,"",$_SESSION["id_tipouser"] ?>
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="halflings-icon white user"></i> <? echo  $_SESSION["usuario"] ?> 
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-menu-title">
								<span>Cuenta usuario</span>
							</li>
							<li><a href="#"><i class="halflings-icon user"></i> Perfil</a></li>
							<li><a href="salir.php"><i class="halflings-icon off"></i> Salir</a></li>
						</ul>
					</li>
					<!-- FIn Menu Usuario -->
				</ul>

			</div>
			<!-- end: Header Menu -->
			<div class="btn-group" style="margin=0;">
				<button type="button" onclick="inicio()" class="btn btn-default">Inicio</button>
				<button type="button" onclick="nomina()"class="btn btn-default">Nomina</button>
				<button type="button" onclick="marcaciones()"class="btn btn-default">Marcaciones</button>
				<button type="button" onclick="informes()"class="btn btn-default">Informes</button>
				<button type="button" onclick="informe_emp()"class="btn btn-default">Informes Empresas</button>

			</div>
		</div>
	</div>
</div>
			