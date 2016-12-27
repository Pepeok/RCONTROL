<?
include("../conectabd/conexion_bd.php");
include ("libreria.php");
include ("js.php");
?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">
        <title>Departamento de Gestion</title>
        <meta name="description" content="">
        <meta name="author" content="Jose Zamora">
        <meta name="keyword" content="">
        <!-- end: Meta -->

        <!-- start: Mobile Specific  no scalable-->
        <meta name="viewport" content="width=device-width, initial-scale=0, maximum-scale=0, user-scalable=no">
        <!-- end: Mobile Specific -->

        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link id="bootstrap" href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
       <style type="text/css">
     
                #alerta{
                background-color: #fff;
                color: #AE0512;
                width: 240px;
                z-index: 3;
                visibility: visible;
                height: auto;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: 2px solid #F2F2F2;
                right: 40%;
                top: 10%;
                padding-top: 18px;
                padding-bottom: 18px;
                text-align: center;
                display: inline;
                font-weight:bold;
                }
     
    </style>

        <!-- end: CSS -->


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <link id="ie-style" href="css/ie.css" rel="stylesheet">
                <![endif]-->

        <!--[if IE 9]>-->
        <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    </head>

    <?
    $id_func = $_GET['id_func'];
    $idlogin = $_GET['idlogin'];
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
    $query.= " and e.id_empresa=i.id_empresa_inter1 ";
    $query.= " and i.id_ldserv_inter1=l.id_ldserv ";
    $query.= " AND c.id_pgc_contrato = f.estado_func ";
    $query.= " AND p.tdr_pgcompras=f.estado_func ";
    $query.= " AND d.id_dpto=f.id_dpto_func ";
    $query.= " GROUP BY c.id_pgc_contrato ; ";

    //echo $query;


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
        $nombre_empresa = $fila["nombre_empresa"];
        $id_dpto = $fila["id_dpto_func"];
        $id_ldserv_func = $fila["id_ldserv_func"];
        $perfil_ldserv = $fila["perfil_ldserv"];
        $estado_func = $fila["estado_func"];
        $nombre_contrato = $fila["nombre_contrato"];
        $oc_contrato = $fila["oc_contrato"];
        $fech_ing_func = $fila["fech_ing_func"];
        $fech_ing_func_mostrar = invertirFecha($fila["fech_ing_func"]);
        $fech_out_func = $fila["fech_out_func"];
        $fech_out_func_mostrar = invertirFecha($fila["fech_out_func"]);
        $nombre_dpto = $fila["nombre_dpto"];
        ?>

        <body>
            <div class="container">

                <div class="col-md-12">
                    <h1 class="text-primary text-center">
                        Formulario Modificacion Asignaciones 		
                    </h1>
                </div>


                <div class="row-fluid ">
                    <div class="box span12">
                        <div class="box-header" data-original-title>
                            <h2 align="center"><strong><? echo " " . $nombre_func . "   " . $ape1_func . " &nbsp; &nbsp; " . $nombre_empresa . " &nbsp; &nbsp;     " . $perfil_ldserv  . " &nbsp; &nbsp;" ?></strong></h2>
                            <div class="box-icon">

                            </div>
                        </div>
                        <div class="box-content">

                           <!-- <input name="id_func" type="hidden" value="<? echo $id_asignado ?>" />-->
                            <table align="center" border=1 whidth="100%" cellspacing=0 cellpadding=2 bordercolor="666633">

                                <thead style="font-size:10 ">
                                    <tr>
                                        <th colspan="8" style="background-color: #a1a1a1">ASIGNACIONES DEL PROFESIONAL</th>
                                    </tr>
                                    <tr >
                                        <th>DPTO</th>
                                        <th>PROYECTO</th>
                                        <th>JEFE PROYECTO</th>
                                        <th>DESDE</th>
                                        <th>HASTA</th>
                                        <th>TDR</th>
                                        <th>EDITAR</th>
                                        <th>ELIMINAR</th>
                                    </tr>
                                </thead>   
                                <tbody>

                                    <?
                                    mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");


                                    $query = " SELECT a. * , d.nombre_dpto, d.jdpto_dpto, p.nombre_proyectos ";
                                    $query.=" ,u.nombre, u.apellido, pg.nombre_pgcompras";
                                    $query.=" FROM asignado a, proyectos p, dpto d, usuario u , pgcompras pg ";
                                    $query.=" WHERE a.id_funcionario_asignado =  '$id_func' ";
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
                                            $id_asignacion=$fila["id_asignado"];
                                            $id_asignado = $fila["id_funcionario_asignado"];
                                            $id_proyectos = $fila["id_proyectos"];
                                            $nombre_proyectos = $fila["nombre_proyectos"];
                                            $nombre_dpto = $fila["nombre_dpto"];
                                            $nombre = $fila["nombre"];
                                            $apellido = $fila["apellido"];
                                            $fecha_asignado = invertirFecha($fila["fecha_asignado"]);
                                            $fecha_fin_asignado = invertirFecha($fila["fecha_fin_asignado"]);
                                            $nombre_pgcompras = $fila["nombre_pgcompras"];
                                            $estado_asignado = $fila["id_pgc_contrato"];
                                            $nota_asignado = $fila["nota_asignado"];
                                            ?>		


                                            <tr style="font-size:14"> 


                                                
                                                <td><? echo $nombre_dpto; ?></td>
                                                <td><? echo $nombre_proyectos; ?></td>
                                                <td><? echo $nombre . " " . $apellido; ?></td>
                                                <td style="width:12%"><? echo $fecha_asignado; ?></td>
                                                <td style="width:12%"><? echo $fecha_fin_asignado; ?></td>
                                                <td style="width:8%"><? echo $nombre_pgcompras; ?></td>
                                                <td id="boton1"style="text-align:center; width:5%" >
                                                    <a  href="javascript:modificando_asignacion('<?  echo $id_asignacion . '&idlogin=' . $idlogin; ?>') " class="btn btn-mini btn-success" id="boton_ventana" title="Modificar">
                                                    <i class="halflings-icon edit white"></i></a>
                                                </td>
                                                <td id="boton1"style="text-align:center; width:5%;  " >
                                                    <a  href="javascript:eliminando(<? echo$id_asignacion .",". $idlogin;  ?>) " class="btn btn-mini btn-warning" id="boton_eliminar" title="Eliminar">
                                                                                
                                                        <i class="halflings-icon remove white"></i></a>
                                                </td>



                                            </tr>
                                            <?
                                        }
                                    } else {
                                        ?>

                                        <tr style="font-size:12">
                                            <td align="center" colspan="8" >ESTE PROFESIONAL NO TIENE ASIGNACIONES</td>

                                        </tr>                    
                                    <? }
                                    ?> 
                                </tbody>
                            </table>
                            <div id="alerta" style='display:none;'> alerta</div>
                            <div id="contenidoOculto" style='display:none;'>pepe</div>
                            <p id="ingresa_asignacion"><?php include('ingresa_asignacion.php'); ?></p>

                        </div>
                    <? } ?>
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
        <script src="js/jquery.knob.modified.js"></script>
        <script src="js/jquery.sparkline.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/retina.js"></script>
        <!--<script src="js/custom.js"></script>-->




        <!-- start:  pie de pagina -->



        <? include("footer.php"); ?>
    </body>
</html>