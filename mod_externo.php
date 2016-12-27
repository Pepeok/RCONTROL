<?
include("validacion.php");
include ("libreria.php");
include ("js.php");
error_reporting(E_ALL ^ E_NOTICE);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
    <html>




        <!-- start: Meta -->
        <meta charset="utf-8">


        <title>Departamento de Gestion</title>
        <meta name="description" content="">
        <meta name="author" content="Jose Zamora">
        <meta name="keyword" content="">
        <!-- end: Meta -->

        <!-- start: Mobile Specific  no scalable-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- end: Mobile Specific -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <link href="css/jquery.circliful.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link id="bootstrap" href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="./css/acordeon.css">
	<!-- end: CSS -->

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <link id="ie-style" href="css/ie.css" rel="stylesheet">
                <![endif]-->

        <!--[if IE 9]>
                <link id="ie9style" href="css/ie9.css" rel="stylesheet">
                <![endif]-->



    </head>



    <?
    $id_func = $_GET['id_func'];
    $id_login = $_GET['idlogin'];
    $dia_act = strftime("%d");
    $mes_act = strftime("%m");
    $ano_act = strftime("%Y");
    $hora_act = strftime("%H");
    $minutos_act = strftime("%M");
    $fecha_actual = $dia_act . "-" . $mes_act . "-" . $ano_act;
    $hora_actual = $hora_act . ":" . $minutos_act;

    $fecha_consulta = $ano_act . "-" . $mes_act . "-" . $dia_act;



    mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");


    $query = " SELECT  DISTINCT f.id_func,f.rut_func , f.dv_func, f.nombre_func, f.fech_ing_func ,f.fech_out_func, ";
    $query.="  f.nombre2_func, f.ape1_func, f.ape2_func, f.id_ldserv_func, e.nombre_empresa, e.id_empresa ,l.perfil_ldserv, f.id_dpto_func ,";
    $query.= " f.estado_func  , c.* , d.nombre_dpto  ";
    $query.= " FROM funcionario f,  empresa e, asignado a, ldserv l ,inter1 i , contrato c ,pgcompras p , dpto d ";
    $query.= " WHERE  f.id_func=" . $id_func . "";
    $query.= " and f.id_emp_func=e.id_empresa ";
    $query.= " and i.id_empresa_inter1=e.id_empresa";
    $query.= " and f.id_emp_func=i.id_empresa_inter1";
    $query.= " and i.id_ldserv_inter1=l.id_ldserv ";
    $query.= " and f.id_ldserv_func=l.id_ldserv ";
    $query.= " and f.id_ldserv_func=i.id_ldserv_inter1";
    $query.= " AND c.id_pgc_contrato = f.estado_func ";
    $query.= " and p.id_pgcompras=c.id_pgc_contrato";
    $query.= " and f.estado_func = p.id_pgcompras";
    $query.= " AND d.id_dpto=f.id_dpto_func ";
    $query.= " and a.id_dpto_asignado=d.id_dpto";
    $query.= " and f.id_dpto_func = d.id_dpto";
    $query.= " GROUP BY c.id_pgc_contrato ; ";

  //  echo $query; 


    $result = mysql_query($query) or die("error =" . mysql_error());
    $num = mysql_num_rows($result);
    $num_filas = $num;


    while ($fila = mysql_fetch_array($result)) {

        $nombre_func = $fila["nombre_func"];
        $ape1_func = $fila["ape1_func"];
        $rut_func = $fila["rut_func"];
        $dv_func = $fila["dv_func"];
        $nombre_empresa = $fila["nombre_empresa"];
        $id_empresa = $fila["id_empresa"];
        $id_dpto = $fila["id_dpto_func"];
        $id_ldserv_func = $fila["id_ldserv_func"];
        $perfil_ldserv = $fila["perfil_ldserv"];
        $id_pgc_contrato=$fila["id_pgc_contrato"];
        $estado_func = $fila["pro_gc_contrato"];
        $nombre_contrato = $fila["nombre_contrato"];
        $oc_contrato = $fila["oc_contrato"];
        $fech_ing_func = $fila["fech_ing_func"];
        $fecha_ingreso_mostrar = invertirFecha($fech_ing_func);
        $fech_out_func = $fila["fech_out_func"];
        $nombre_dpto = $fila["nombre_dpto"];
        $pro_gc_contrato = $fila["pro_gc_contrato"];
        ?>

        <body>

            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-xs-12">
                        <h1 class="text-primary text-center">Formulario Modificacion Datos Profesional Externo</h1>
                        <div class="row">
                            <div class="box-header row-fluid" data-original-title>
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Modificación</h2>

                            </div>

                            <div class="box span12">
                                <div class="box-content">
                                        <form class="form-horizontal" id="form2" name="form2"  method="post" action="modificar_externos.php" >

                                        <input name="id_func"  type="hidden" value="<? echo $id_func ?>" />
                                        <input name="id_usuario"  type="hidden" value="<? echo $id_usuario = $_SESSION["id_usuario"] ?>" />

                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Rut:</label>
                                            <div class="controls">
                                                <input type="text"  SIZE="11"  onFocus="vaciar(this)" class="input-small focused" MAXLENGTH="8" id="rut_func" name="rut_func" onchange="esrut(document.form2.rut_func.value)"   value="<? echo $rut_func ?>">
                                                <input type="text" SIZE="1"  class="input-mini focused" readonly MAXLENGTH="0" id="dv_func" name="dv_func" value="<? echo $dv_func ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nombre</label>
                                            <div class="controls">
                                                <input class="input-xlarge" id="nombre" name="nombre_func" type="text" value="<? echo $nombre_func; ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Apellidos </label>
                                            <div class="controls">
                                                <input class="input-xlarge" id="ape1_func" name="ape1_func" type="text" value="<? echo $ape1_func ?>"></span>
                                            </div>
                                        </div>
                                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                            <div class="control-group">
                                                <label class="control-label">Empresa </label>
                                                <div class="controls">
                                                    <?
                                                    $consulta_mysql = 'select * from empresa';
                                                    $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                                                    $num = mysql_num_rows($result);
                                                    $num_filas = $num;

                                                    echo "<select id='empresa' class='form-control' name='empresa' >";
                                                    echo "<option value='$id_empresa'>$nombre_empresa</option>";
                                                    while ($fila = mysql_fetch_array($result)) {
                                                        echo "<option value='" . $fila['id_empresa'] . "'>" . $fila['nombre_empresa'] . "</option>";
                                                    }
                                                    echo "</select>";
                                                    ?>
                                                    <p id="panelempresa"><?php empresa("empresa2", "1"); ?></p>	
                                                </div>
                                            </div>

                                            <!--	//QUERY COMBO 2 -->

                                            <div class="control-group">
                                                <label class="control-label">Perfil Cargo (Linea) </label>
                                                <div class="controls">
                                                    <?
                                                    $consulta_mysql = 'select * from ldserv';
                                                    $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                                                    $num = mysql_num_rows($result);
                                                    $num_filas = $num;
                                                    echo "<select id='ldserv'class='form-control' name='ldserv'  '>";
                                                    echo "<option value='$id_ldserv_func'>$perfil_ldserv</option>";
                                                    while ($fila = mysql_fetch_array($result)) {
                                                        echo "<option value='" . $fila['id_ldserv'] . "'>" . $fila['perfil_ldserv'] . "</option>";
                                                    }
                                                    echo "</select>";
                                                    ?>
                                                    <p id="panelldserv"><?php ldserv("ldserv2", "2"); ?></p>	

                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Proceso Grandes Compras </label>
                                                <div class="controls">
                                                    <?
                                                    echo "<select id='tdr'class='form-control' name='tdr'>";
                                                    echo "<option value='$id_pgc_contrato'>$pro_gc_contrato</option>";
                                                    echo "</select>";
                                                    ?>
                                                    <p id='paneltdr'><?php pgc("tdr2", "3"); ?></p>
                                                </div>
                                            </div>

                                            <div class="control-group">

                                                <label class="control-label" for="focusedInput">Fecha Ingreso</label>
                                                <div class="controls">
                                                   
                                                    <input class="input-xlarge focused cursor" id="fecha_in" name="fecha_in" type="text"  value="<? echo $fecha_ingreso_mostrar; ?>" readonly="readonly" required>

                                                </div>

                                            </div>

                                            <div class="control-group ">
                                                <label class="control-label" for="focusedInput">Fecha Termino</label>
                                                <div class="controls">
                                                    <input class="input-xlarge focused cursor" id="fechaout" name="fechaout" type="text" value="<? echo invertirFecha($fech_out_func) ?>" required readonly="readonly">

                                                </div>

                                            </div>


                                            <div id="botones" class="form-actions">
                                                <button type="button" class="btn btn-primary" name="boton1" id="boton1" onclick="javascript:validar_formulario(this.form);"id="boton1">Actualizar</button>
                                                <button type="button" class="btn" name="boton2"  id="boton2"onclick="javascript:window.close();">Cancelar</button>
                                                        
                                            </div>

                                        </form>

                                    
                                <? } ?>
                            </div>
                        </div><!--/span-->

                    </div>
                        <?php include 'asignacion_corto.php'; ?>
                        
                        <br>
                        
                    </div>
                    </div>
                    </div>
                        


                    <script type="text/javascript" src="validaRut.js"></script>    
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
                    <script src="js/jquery.uploadify-3.1.min.js"></script>
                    <script src="js/jquery.gritter.min.js"></script>
                    <script src="js/jquery.imagesloaded.js"></script>
                    <script src="js/jquery.masonry.min.js"></script>
                    <script src="js/jquery.knob.modified.js"></script>
                    <script src="js/jquery.sparkline.min.js"></script>
                    <script src="js/counter.js"></script>
                    <script src="js/retina.js"></script>
                    <!--<script src="js/custom.js"></script>	-->




                    <!-- start:  pie de pagina -->



                    <? include("footer.php"); ?>
                    </body>
                    </html>
