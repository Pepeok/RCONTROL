<? include("validacion.php");
include("../conectabd/conexion_bd.php");
include ("js.php");
include("libreria.php")
?>
<html>


    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">





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

    <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
    <link id="bootstrap" href="css/bootstrap.css" rel="stylesheet">
    <link id="base-style" href="css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
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
$id_asignacion = $_GET['id_asignacion'];
$id_user = $_GET['idlogin'];

mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");


$query = " SELECT a.* ,d.id_dpto, d.nombre_dpto, d.jdpto_dpto, p.nombre_proyectos ";
$query.=" ,u.nombre, u.apellido, pg.nombre_pgcompras, u.id_usuario, f.* ";
$query.=" FROM funcionario f,asignado a, proyectos p, dpto d, usuario u , pgcompras pg ";
$query.=" WHERE a.id_asignado =$id_asignacion ";
$query.=" AND a.id_funcionario_asignado = f.id_func";
$query.=" AND a.id_dpto_asignado = d.id_dpto ";
$query.=" AND a.id_proyecto_asignado = p.id_proyectos ";
$query.=" AND a.id_jefepro_asignado = u.id_usuario ";
$query.=" AND a.estado_asignado = pg.id_pgcompras ";


//echo $query;


$result = mysql_query($query) or die("error =" . mysql_error());
$num = mysql_num_rows($result);
$num_filas = $num;

if ($num_filas > 0) {

    while ($fila = mysql_fetch_array($result)) {
        $id_asignado = $fila["id_funcionario_asignado"];
        $id_proyectos = $fila["id_proyecto_asignado"];
        $id_funcionario_asignado = $fila["id_funcionario_asignado"];
        $nombre_proyectos = $fila["nombre_proyectos"];
        $nombre_dpto = $fila["nombre_dpto"];
        $id_dpto = $fila["id_dpto"];
        $jdpto_dpto=$fila["jdpto_dpto"];
        $id_usuario = $fila["id_usuario"];
        $nombre_prof = $fila["nombre_func"];
        $apellido_prof = $fila["ape1_func"];
        $estado_asignado=$fila["estado_asignado"];
        $nombre = $fila["nombre"];
        $apellido = $fila["apellido"];
        $nombre_jdpro = $nombre . "&nbsp;" . $apellido;
        
        $fech_ing_func = invertirFecha($fila["fech_ing_func"]);
        $fech_out_func = invertirFecha($fila["fech_out_func"]);
        $fecha_asignado = invertirFecha($fila["fecha_asignado"]);
        $fecha_fin_asignado = invertirFecha($fila["fecha_fin_asignado"]);
        $nombre_pgcompras = $fila["nombre_pgcompras"];
        $nota_asignado = $fila["nota_asignado"];
        $id_jefepro_asignado= $fila["id_jefepro_asignado"];
    }
}
?>

<body>
    
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-6">
                <h1 class="text-primary text-center">Formulario  Edicion De Asignación</h1>

                <div class="row-fluid">
                    <div class="box span12">
                        <div class="box-header" data-original-title>
                            <h2 align="center"><strong><? echo " " . $nombre_prof . "   " . $apellido_prof . " &nbsp; &nbsp; "; ?></strong></h2>
                            <h2><span class="break"></span>Datos Asignación</h2>
                            <div class="box-icon">
                                <i class="halflings-icon edit"></i>
                            </div>
                        </div>
                        <div class="box-content">
                            <form class="form-horizontal" id="form2" name="form2"  method="post" action="cambiar_asigancion.php" >


                                <input name="estado_asignado" type="hidden" value="<? echo $estado_func ?>" />
                                <input name="id_asignacion"  type="hidden" value="<? echo $id_asignacion ?>" />
                                <input name="id_func"  type="hidden" value="<? echo $id_funcionario_asignado ?>" />
                                <input name="id_login"  type="hidden" value="<? echo $id_user  ?>" />
                                <input name="fecha_in"  type="hidden" value="<? echo $fech_ing_func ?>" />
                                <input name="fecha_out"  type="hidden" value="<? echo $fech_out_func ?>" />
                                <!--<input name="jdepro"  type="hidden" value="<? echo $id_jefepro_asignado ?>" />-->
                                
                                <input name="estado_asignado"  type="hidden" value="<? echo $estado_asignado ?>" />

                                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <div class="control-group">
                                        <label class="control-label">Departamento</label>
                                        <div class="controls">
                                            <?
                                            mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");
                                            $consulta_mysql = 'select * from dpto';
                                            $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                                            $num = mysql_num_rows($result);
                                            $num_filas = $num;

                                            echo "<select id='dpto' class='form-control' name='dpto'>";
                                            echo "<option value=$id_dpto>$nombre_dpto</option>";
                                            while ($fila = mysql_fetch_array($result)) {
                                         
                                             echo "<option value='" . $fila['id_dpto'] . "'>" . $fila['nombre_dpto'] . "</option>";
                                            }
                                            echo "</select>";
                                            ?>
                                             
                                           <!--<p id="dptos"><?php empresa("dptos", "1"); ?></p>-->	
                                        </div>
                                    </div>

                                    <!--	//QUERY COMBO 2 -->

                                    <div class="control-group">
                                        <label class="control-label">Jefe de Proyecto</label>
                                        <div class="controls">
                                            <?
                                            $consulta_mysql = 'select * from usuario';
                                            $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                                            $num = mysql_num_rows($result);
                                            $num_filas = $num;
                                            echo "<select id='jdepro'class='form-control' name='jdepro'>";
                                            echo "<option value='$id_jefepro_asignado'>$nombre_jdpro</option>";
                                            while ($fila = mysql_fetch_array($result)) {
                                                echo $nombre_jdpro = $fila['nombre'] . "&nbsp; " . $fila['apellido'];
                                                echo "<option value='" . $fila['id_usuario'] . "'>" . $nombre_jdpro . "</option>";
                                            }
                                            echo "</select>";
                                            ?>

        <!--<p id="panelldserv"><?php // ldserv("ldserv2", "2"); ?></p>-->

                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Proyecto </label>
                                        <div class="controls">
                                            <?
                                            mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");
                                            $consulta_mysql = 'select * from proyectos';
                                            $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                                            $num = mysql_num_rows($result);
                                            $num_filas = $num;
                                            echo "<select id='proyecto'class='form-control' name='proyecto'>";
                                            echo "<option value='$id_proyectos'>$nombre_proyectos</option>";
                                            while ($fila = mysql_fetch_array($result)) {
                                                echo "<option value='" . $fila['id_proyectos'] . "'>" . $fila['nombre_proyectos'] . "</option>";
                                            }
                                            echo "</select>";
                                            ?>
                                           
                                        </div>
                                    </div>

                                    <div class="control-group">

                                        <label class="control-label" for="focusedInput">Fecha Asignado</label>
                                        <div class="controls">
                                            <input class="input-xlarge focused cursor" id="fecha_ina" name="fecha_ina" type="text"  value="<? echo $fecha_asignado ?>" readonly 	required>

                                        </div>

                                    </div>

                                    <div class="control-group ">
                                        <label class="control-label" for="focusedInput">Fecha Fin Asignado</label>
                                        <div class="controls">
                                            <input class="input-xlarge focused cursor" id="fechaouta" name="fechaouta" type="text"   value="<? echo $fecha_fin_asignado ?>" required readonly>

                                        </div>

                                    </div>

                                    <div id="botones" class="form-actions">
                                        <button type="button" class="btn btn-primary" name="boton1" id="boton1" onclick="javascript:valida_form_asignacion(this.form);"id="boton1">Actualizar</button>
                                        <button type="button" class="btn" name="boton2"  id="boton2"onclick="javascript:window.history.back();">Cancelar</button>
                                    </div>


                                </form>

                            </form>

                        </div>
                    </div><!--/span-->

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
               	


                <!-- start:  pie de pagina -->



<? include("footer.php"); ?>
                </body>
                </html>
