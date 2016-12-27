<? include("validacion.php"); ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- start: Meta -->
        <meta charset="utf-8">
        <title>Departamento de Informática Gestión</title>
        <meta name="description" content="Departamento de apoyo transversal en la SDI">
        <meta name="author" content="José Zamora">
        <meta name="keyword" content="Sistema , Control, Horas">
        <!-- end: Meta -->

        <!-- start: Mobile Specific  no scalable-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- end: Mobile Specific -->

        <!-- start: CSS-->
        <link href="css/jquery.circliful.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link id="bootstrap" href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
        <!-- end: CSS -->

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
        <link id="ie-style" href="css/ie.css" rel="stylesheet">
        <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    </head>



    <?
    include("js.php");

    $dia_act = strftime("%d");
    $mes_act = strftime("%m");
    $ano_act = strftime("%Y");
    $hora_act = strftime("%H");
    $minutos_act = strftime("%M");
    $mes_act_user = strftime("%m");
    $fecha_actual = $dia_act . "-" . $mes_act . "-" . $ano_act;
    $hora_actual = $hora_act . ":" . $minutos_act;
//$fecha_consulta=$ano_act."-".$mes_act."-".$dia_act;
    error_reporting(E_ALL ^ E_NOTICE);
    if ($dia_act <= 6) {
        $mes_act = $mes_act - 1;
    }

    $fecha_consulta_act = "'" . $ano_act . "-" . $mes_act . "-" . $dia_act . "'";
    $fecha_consulta_user = "'" . $ano_act . "-" . $mes_act_user . "-" . $dia_act . "'";
    $fecha_consulta = "'" . $ano_act . "-" . $mes_act . "-01'";
    $fecha_consulta_inicio = "'" . $ano_act . "-" . $mes_act . "-01'";
    $fecha_consulta_fin = "'" . $ano_act . "-" . $mes_act . "-31'";

    function invertirFecha($Fecha) {
        $Fecha = explode("-", $Fecha);
        $fec = $Fecha[2] . "-" . $Fecha[1] . "-" . $Fecha[0];
        return $fec;
    }

    function Fecha_mysql($Fecha) {
        $Fecha = explode("-", $Fecha);
        $femysql = $Fecha[2] . "-" . $Fecha[1] . "-" . $Fecha[0];
        return $femysql;
    }
    ?> 

    <body>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-6">
                    <h1 class="text-primary text-center">Control Horas Externos</h1>
                    <div class="navbar azulsii" id="barra_administrador" style="display:block;"> 
                        <div class="navbar-inner azulsii">
                            <div class="container-fluid">
                                <!-- start: Header Menu -->
                                <div class="nav-no-collapse header-nav ">
                                    <ul class="nav pull-right naranjosii">
                                        <!-- Inicio Menu Usuario -->
                                        <li class="dropdown">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                                <i class="halflings-icon white user"></i> <? echo $_SESSION["usuario"] ?> 
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-menu-title"><span>Cuenta usuario</span>	</li>
                                                <li><a href="#"><i class="halflings-icon user"></i>Perfil</a></li>
                                                <li><a href="salir.php"><i class="halflings-icon off"></i>Salir</a></li>
                                            </ul>
                                        </li>
                                        <!-- FIn Menu Usuario -->
                                    </ul>
                                </div>
                                <!-- end: Header Menu -->
                                <div class="btn-group" style="margin=0">
                                    <?
                                    //MENU PARA ADMINISTRADOR
                                    if ((($_SESSION["id_perfil"]) == 1)) {
                                        ?> 
                                        <button type="button" onClick="inicio()" class="btn btn-default">Inicio</button>
                                        <button type="button" onClick="nomina()"class="btn btn-default">Nomina</button>
                                        <button type="button" onClick="historica()"class="btn btn-default">N.Historica</button>
                                        <button type="button" onClick="marcaciones()"class="btn btn-default">Marcaciones</button>
                                        <button type="button" onClick="informes()"class="btn btn-default">Inf. Total HH</button>
                                        <button type="button" onClick="informe_small()"class="btn btn-default">Inf. Detalle HH</button>
                                        <button type="button" onClick="informe_emp()"class="btn btn-default">Inf. Semanal</button>
                                        <button type="button" onClick="informe_mensual()"class="btn btn-default">Inf. Mensual</button>
                                        <button type="button" onClick="pendientes()"class="btn btn-default">Pendientes</button>
                                        <button type="button" onClick="mantenedor()"class="btn btn-default">Mantenedor</button>
                                    <? } ?>
                                    <?
                                    //MENU PARA JEFE DE DEPARTAMENTO
                                    if ((($_SESSION["id_perfil"]) == 4)) {
                                        ?> 
                                        <button type="button" onClick="inicio()" class="btn btn-default">Inicio</button>
                                        <button type="button" onClick="nomina()"class="btn btn-default">Nomina</button>
                                        <button type="button" onClick="marcaciones()"class="btn btn-default">Marcaciones</button>
                                        <button type="button" onClick="informes()"class="btn btn-default">Inf. Total HH</button>
                                        <button type="button" onClick="informe_small())"class="btn btn-default">Inf. Detalle HH</button>
                                        <button type="button" onClick="informe_emp()"class="btn btn-default">Informe Semanal</button>
                                        <button type="button" onClick="informe_mensual()"class="btn btn-default">Informe Mensual</button>
                                    <? } ?>
                                    <?
                                    //MENU PARA JEFE DE proyecto
                                    if ((($_SESSION["id_perfil"]) == 2)) {
                                        ?> 
                                        <button type="button" onClick="inicio()" class="btn btn-default">Inicio</button>
                                        <button type="button" onClick="nomina()"class="btn btn-default">Nomina</button>
                                        <button type="button" onClick="marcaciones()"class="btn btn-default">Marcaciones</button>
                                        <button type="button" onClick="informes()"class="btn btn-default">Inf. Total HH</button>
                                        <button type="button" onClick="mantenedor()"class="btn btn-default">Mantenedor</button>
                                    <? } ?>
<?
//MENU PARA Administrador HH
if ((($_SESSION["id_perfil"]) == 3)) {
    ?> 
                                        <button type="button" onClick="inicio()" class="btn btn-default">Inicio</button>
                                        <button type="button" onClick="nomina()"class="btn btn-default">Nomina</button>
                                        <button type="button" onClick="historica()"class="btn btn-default">N.Historica</button>
                                        <button type="button" onClick="marcaciones()"class="btn btn-default">Marcaciones</button>
                                        <button type="button" onClick="informes()"class="btn btn-default">Inf. Total HH</button>
                                        <button type="button" onClick="informe_emp()"class="btn btn-default">Inf. Semanal</button>
                                        <button type="button" onClick="informe_mensual()"class="btn btn-default">Inf. Mensual</button>
                                        <button type="button" onClick="informe_small()"class="btn btn-default">Inf. Especial</button>
                                        <button type="button" onClick="pendientes()"class="btn btn-default">Pendientes</button>
                                        <button type="button" onClick="mantenedor()"class="btn btn-default">Mantenedor</button>
<? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                </div>

                <div class="panel" >
                    <div class="panel-body" id="inicio" style='display:block;'>INICIO
                        <div class="box-content"><? include("inicio.php"); ?></div>
                    </div>
                    
                    <!--fin  boton Inicio-->

                    <div class="panel-body" id="nomina" style='display:none;'>
                        <div class="box-content">Listado externos 
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) == 3)) {
                                include("listado_externos.php");
                            }
                            if (($_SESSION["id_perfil"]) == 4) {
                                include("externos_por_perfil_jdpto.php");
                            }
                            if (($_SESSION["id_perfil"]) == 2) {
                                include("externos_por_perfil.php");
                            }
                            ?>
                        </div>
                    </div>
                    <!--fin  boton nomina historica-->

                    <div class="panel-body" id="historica" style='display:none;'>
                        <div class="box-content">Listado historico de Profesionales Externos
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) == 3)) {
                                include("listado_externos_historica.php");
                            }
                            ?>
                        </div>
                    </div>
                    <!--fin  boton nomina-->

                    <div class="panel-body" id="marcaciones" style='display:none;'>Listado de Marcas Profesionales Externos.
                        <div class="box-content">
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) == 3)) {
                                include("marcaciones_admin.php");
                            }
                            if (($_SESSION["id_perfil"]) == 4) {
                                include("marcaciones_dpto.php");
                            }
                            if (($_SESSION["id_perfil"]) == 2) {
                                include("marcaciones_jdpro.php");
                            }
                            ?>
                        </div>
                    </div>
                    <!--fin  boton marcas-->

                    <div class="panel-body" id="informes" style='display:none;'>Informes completo de todas las horas cargadas en el sistema
                        <div class="box-content">
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) == 3)) {
                                include("informe_admin.php");
                            }
                            if (($_SESSION["id_perfil"]) == 4) {
                                include("informe_jdpto.php");
                            }
                            if (($_SESSION["id_perfil"]) == 2) {
                                include("informe_jdpro.php");
                            }
                            ?>
                        </div>
                    </div>
                    <!--fin  boton total horas-->

                    <div class="panel" id="modificaciones" style='display:none;'>INICIO
                        <div class="box-content">
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) ) {
                                include("modifica_rcontrol.php");
                            }
                            ?>
                        </div>
                    </div> 
                    <!--fin  boton modificaciones-->

                    <div class="panel-body" id="informe_emp" style='display:none;'>
                        <div class="box-content">
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) > 2)) {
                                include("formulario_inf_sem.php");
                            }
                            ?>
                        </div>
                    </div> 
                    <!--fin boton informe_mensual-->

                    <div class="panel-body" id="informe_mensual" style='display:none;'>
                        <div class="box-content">
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) > 2)) {
                                include("formulario_inf_mensual.php");
                            }
                            ?>
                        </div>
                    </div> 
                    <div class="panel-body" id="informe_small" style='display:none;'>
                        <div class="box-content">
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) > 2)) {
                                include("formulario_inf_mensual_small.php");
                            }
                            ?>
                        </div>
                    </div> 
                    <!--fin boton informe_mensual_small-->

                    <div class="panel-body" id="proyeccion" style='display:none;'>
                        <div class="box-content">
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) > 2)) {
                                include("informe_proyeccion_horas.php");
                            }
                            ?>
                        </div>
                    </div> 
                    <!--fin boton informe_mensual-->

                    <div class="panel-body" id="mantenedor" style='display:none;'>
                        <div class="box-content">
                            <?
                            if (($_SESSION["id_perfil"]) == 1) {
                                include("mantenedor.php");
                            } elseif ((($_SESSION["id_perfil"]) == 2) or (($_SESSION["id_perfil"]) == 3)) {
                                echo '<strong>Opción en mantenimiento.</strong> <br /><br />
Por cambios de asignaciones, vigencias o carga de nuevos profesionales, enviar mail a <b>inf_gestion.externo@sii.cl</b> en los formatos requeridos para cada caso: <a href="./Solicitud cambio profesional.msg" class="a2"><b>Modificaci&oacute;n profesional</b></a> o <a href="./Solicitud ingreso profesional.msg" class="a2"><b>Ingreso profesional</b>.</a> </p>';
                            }
                            ?>
                        </div>
                    </div> 
                    <!--fin boton total marcas-->

                    <div class="panel-body" id="pendientes" style='display:none;'>
                        <div class="box-content">
                            <?
                            if ((($_SESSION["id_perfil"]) == 1) or (($_SESSION["id_perfil"]) == 3)) {
                                include("marcas_pendientes.php");
                            }
                            ?>
                        </div>

                    </div> 
                    <!--fin boton pendientes-->
                </div>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-migrate-1.0.0.min.js"></script>
        <script src="js/jquery-ui-1.10.0.custom.min.js"></script>
        <script src="js/jquery.ui.touch-punch.js"></script>
        <script src="js/modernizr.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.cookie.js"></script>
        <!--<script src='js/fullcalendar.min.js'></script>-->
        <script src='js/jquery.dataTables.min.js'></script>
        <script src="js/excanvas.js"></script>
        <script src="js/jquery.flot.js"></script>
        <script src="js/jquery.flot.pie.js"></script>
        <script src="js/jquery.flot.stack.js"></script>
        <script src="js/jquery.flot.resize.min.js"></script>
        <script src="js/jquery.chosen.min.js"></script>
        <script src="js/jquery.uniform.min.js"></script>
        <script src="js/jquery.cleditor.min.js"></script>
        <script src="js/jquery.noty.js"></script>
        <script src="js/jquery.elfinder.min.js"></script>
        <script src="js/jquery.raty.min.js"></script>
        <script src="js/jquery.iphone.toggle.js"></script>
        <script src="js/jquery.uploadify-3.1.min.js"></script>
        <script src="js/jquery.gritter.min.js"></script>
        <script src="js/jquery.imagesloaded.js"></script>
        <script src="js/jquery.masonry.min.js"></script>
        <script src="js/jquery.knob.modified.js"></script>
        <script src="js/jquery.sparkline.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/retina.js"></script>
        <script src="js/custom.js"></script>

        <script language="javascript">

        </script>
        <!-- start:  pie de pagina -->
<? include("footer.php"); ?>
        <!-- End:  pie de pagina -->
    </body>
</html>
