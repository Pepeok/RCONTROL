

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
<!--<script src="js/custom.js"></script>-->

<script type="text/javascript">
    function ingresar_externo()
    {
        window.open('ingresa_externo.php', 'n_w', 'width=600, height=800, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');
    }
    function ingresar_horas()
    {
        window.open('ingresa_horas.php', 'n_w', 'width=800, height=600, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');
    }
    function objetoAjax() {
        var xmlhttp = false;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                xmlhttp = false;
            }
        }

        if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }


    //_________________________________________________________________________
    function buscar_modificaciones() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';

        //esta es la funcion que envia los datos de manea asincrona
        //div donde  mostrararemos  los datos de la consulta 
        divResultado = document.getElementById('resultado');

        //tomamos el valor enviado del formulario de envio
        clave = document.formulario.clave.value;

        //instanciamos el objetoAjax
        ajax = objetoAjax();
        //usamos el medoto POST
        //archivo que realizará la operacion
        ajax.open("POST", "modifica_rcontrol.php", true);
        // $.getScript('habilitar.js');

        //mostramos una imagen mientras cargamos el resultado de la consulta
        //divResultado.innerHTML= '<img src="images/ajax.gif">';


        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                //visualizamos el resultado correscpondiente
                divResultado.innerHTML = ajax.responseText
            }
        }
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //enviando los valoress
        ajax.send("clave=" + clave)


    }

    function traer_marcas(rut,fecha_ini, fecha_fin){
        var parametros = {
                "rut" : rut,
                "fecha_ini" :fecha_ini,
                "fecha_fin":fecha_fin
        };
        $.ajax({
                data:  parametros,
                url:   'traer_marcas.php',
                type:  'post',
                beforeSend: function () {
                        $("#Detalle").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#Detalle").html(response);
                }
        });
}



    function consultar(form2) {
        if (confirm('Desea ingresar este informe?'))
        {
            form2.submit();
        }
    }

    function modificar(form2) {
        if (confirm('Desea Modificar los datos?'))
        {
            form2.submit();
        }
    }

    function inicio() {
        document.getElementById('inicio').style.display = 'block';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';
      
    }

    function nomina() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'block';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';



    }

    function marcaciones() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'block';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';



    }

    function informes() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'block';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';



    }
    function informe_emp() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'block';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';



    }

    function informe_mod() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'block';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';



    }
    function informe_mensual() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'block';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';


    }

    function proyeccion() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'block';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';


    }

    function total_marcas() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';


    }
    function pendientes() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'block';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';


    }
    function mantenedor() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'block';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'none';

    }
    function historica() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'block';
        document.getElementById('informe_small').style.display = 'none';

    }
     function informe_small() {
        document.getElementById('inicio').style.display = 'none';
        document.getElementById('nomina').style.display = 'none';
        document.getElementById('marcaciones').style.display = 'none';
        document.getElementById('informes').style.display = 'none';
        document.getElementById('informe_emp').style.display = 'none';
        document.getElementById('modificaciones').style.display = 'none';
        document.getElementById('informe_mensual').style.display = 'none';
        document.getElementById('proyeccion').style.display = 'none';
        document.getElementById('pendientes').style.display = 'none';
        document.getElementById('mantenedor').style.display = 'none';
        document.getElementById('historica').style.display = 'none';
        document.getElementById('informe_small').style.display = 'block';

    }



    function nombre_mes($mes_act)
    {
        $mes_act = $mes_act;
        switch ($mes_act) {

            case 1  :
                $res_mes = "Enero";
                break;

            case 2  :
                $res_mes = "Febrero";
                break;

            case 3  :
                $res_mes = "Marzo";
                break;

            case 4 :
                $res_mes = "Abril";
                break;

            case 5 :
                $res_mes = "Mayo";
                break;

            case 6 :
                $res_mes = "Junio";
                break;

            case 7 :
                $res_mes = "Julio";
                break;

            case 8 :
                $res_mes = "Agosto";
                break;

            case 9 :
                $res_mes = "Septiembre";
                break;

            case 10 :
                $res_mes = "Octubre";
                break;

            case 11 :
                $res_mes = "Noviembre";
                break;

            case 12 :
                $res_mes = "Diciembre";
                break;

            default :
                $res_mes = "Codigo error ";

        }

        return ($res_mes);

    }

    function recargar_pagina(id)

    {
        var id_func = id;
        location.href = "mod_externo.php?id_func=" + id_func;

    }
    function recargar_index()

    {

        location.href = "index.php";
        nomina();

    }

    function recargar_pagina_asignacion(id)

    {
        var id_func = id;
        //alert(id_func);
        location.href = "modifica_asignacion.php?id_func=" + id_func;

    }



    function recargar()

    {
        history.back(1);

        location.href = "<? echo $_SERVER['PHP_SELF']; ?>";

    }

    function sin_datos()

    {
        alert("NO existen datos para la consulta");

        window.close();




    }

    function valida_form_asignacion(formulario2) {
        if (formulario2.dpto.value == 0)
        {
            alert("Ingrese Dpto!!");
            formulario2.dpto.focus();
            return false;
        }
        if (formulario2.jdepro.value == "")
        {
            alert("Seleccione un Jefe de Preyecto!!");
            formulario2.jdepro.focus();
            return false;

        }
        if (formulario2.proyecto.value == "")
        {
            alert("Ingrese Nombre de proyecto !!");
            formulario2.proyecto.focus();
            return false;
        }


        var fechain = formulario2.fecha_ina.value
        // alert(fechain);
        var fechaout = formulario2.fechaouta.value;
        // alert (fechaout);
        var fechainpro = formulario2.fecha_in.value

        var fechaoutpro = formulario2.fecha_out.value


        if (validafechaasignacion(fechain, fechaout, fechaoutpro, fechainpro) == false) {


            formulario2.fecha_ina.focus();

        } else {


            formulario2.submit();

        }



    }

    function validar_formulario(formulario)
    {


        if (formulario.rut_func.value == "")
        {
            alert("Ingrese rut !!");
            formulario.rut_func.focus();
            return false;
        }
        if (formulario.dv_func.value == "")
        {
            alert("Ingrese Digito verificador !!");
            formulario.dv_func.focus();
            return false;

        }
        if (formulario.nombre.value == "")
        {
            alert("Ingrese Nombre !!");
            formulario.nombre.focus();
            return false;
        }

        if (formulario.ape1_func.value == "")
        {
            alert("Ingrese Apellido !!");
            formulario.ape1_func.focus();
            return false;
        }
        if (formulario.empresa2.value == 0 && formulario.empresa.value == 0)
        {
            alert("Debe seleccionar una Empresa");
            //formulario.empresa.focus();
            return false;
        }

        if (formulario.ldserv2.value == 0 && formulario.ldserv.value == 0)
        {
            alert("Debe seleccionar una Linea de Servicio");
            // formulario.ldserv.focus();
            return false;
        }
//        alert(formulario.ldserv.value); 

        if (formulario.tdr.value == 0 && formulario.tdr2.value == 0)
        {
            alert("Debe seleccionar tdr");
            //formulario.tdr.focus();
            return false;
        }
        var fechain = formulario.fecha_in.value
        // alert(fechain);
        var fechaout = formulario.fechaout.value;
        // alert (fechaout);

        if (validafechaperfil(fechain, fechaout) == false) {


            formulario.fecha_in.focus();

        } else {


            formulario.submit();

        }



    }
    function validafechaasignacion(fechain, fechaout, fechasalpro, fechainpro)
    {

        var fecha_in = fechain;
        var fecha_out = fechaout;
        var fecha_sal_pro = fechasalpro;
        var fecha_in_pro = fechainpro;


        // alert(fecha_in +'\n' + fecha_out+'\n' +fecha_in_pro+'\n' +fecha_sal_pro);

        var ingreso = new Date();
        var fecha1 = fecha_in.split("-");
        ingreso.setFullYear(fecha1[2], fecha1[1] - 1, fecha1[0]);

        var salida = new Date();
        var fecha2 = fecha_out.split("-");
        salida.setFullYear(fecha2[2], fecha2[1] - 1, fecha2[0]);


        var fechasalprof = new Date();
        var fecha3 = fecha_sal_pro.split("-");
        fechasalprof.setFullYear(fecha3[2], fecha3[1] - 1, fecha3[0]);

        var fechainprof = new Date();
        var fecha4 = fecha_in_pro.split("-");
        fechainprof.setFullYear(fecha4[2], fecha4[1] - 1, fecha4[0]);

        //alert(ingreso+'\n' +salida+'\n' +fechainprof+'\n' +fechasalprof);
        // alert(fechasalprof);   



        if (ingreso == salida) {

            alert("Las Fechas no pueden ser iguales");

            return false;
        }

        if (salida <= ingreso) {
            alert("la fecha de salida no puede ser Menor o igual a la de ingreso ");

            return false
        }
        if (salida > fechasalprof) {
            alert("La fecha de salida no puede ser mayor a la fecha de termino de contrato del Profesional");
            return false
        }

        if (ingreso < fechainprof) {
            alert("La fecha de entrada no puede ser menor a la fecha de ingreso del Profesional");
            return false
        } else {

            return true;

        }
    }

    function validafechaperfil(fechain, fechaout)
    {

        var fecha_in = fechain;
        var fecha_out = fechaout;

        var ingreso = new Date();
        var fecha1 = fecha_in.split("-");
        ingreso.setFullYear(fecha1[2], fecha1[1] - 1, fecha1[0]);

        var salida = new Date();
        var fecha2 = fecha_out.split("-");
        salida.setFullYear(fecha2[2], fecha2[1] - 1, fecha2[0]);

        // alert(salida);
        // alert(ingreso);   



        if (ingreso == salida) {

            alert("Las Fechas no pueden ser iguales");

            return false;
        }

        if (salida <= ingreso) {
            alert("la fecha de salida no puede ser Menor o igual a la de ingreso ");

            return false
        } else {

            return true;

        }
    }


// funciones jquery 

    $(document).ready(function() {

        $("#boton_ventana").css("display", "block");
        $("#boton_cambia").css("display", "none");
        
 

        $("#panelldserv").css("display", "none");
        $("#paneltdr").css("display", "none");
        $("#panelempresa").css("display", "none");
        $("#editaasignacion").css("display", "none");
        $("#asignacionoriginal").css("display", "block");




        $("#empresa").change(function(event)
        {
            var idpadre = $(this).find(':selected').val();
            $("#empresa2").attr('disabled', 'disabled');
            $("#ldserv2").attr('disabled', 'disabled');
            // $("#tdr2").attr('disabled', 'disabled');


            $("#panelldserv").html("<img src='./img/loading.gif' />");
            $("#panelldserv").load('combobox.php?buscar=hijos&idpadre=' + idpadre);
            $("#panelldserv").css("display", "block");

            $("#ldserv").css("display", "none");
            $("#ldserv").attr('disabled', 'disabled');
            // $("#tdr").css("display", "none");
            // $("#tdr").attr('disabled', 'disabled');


            var idhijo = $(this).find(':selected').val();


        });


        $("#ldserv2").live("change", function(event)

        {

            $("#tdr").css("display", "none");
            $("#tdr").attr("disabled", "disabled");

            var idnietos = $(this).find(':selected').val();

            $("#paneltdr").css("display", "block");
            $("#paneltdr").html("<img src='/img/loading.gif' />");
            $("#paneltdr").load('combobox.php?buscar=nietos&idhijo=' + idnietos);

        });


        $("#ldserv").change(function(event)
        {
            $("#empresa").css("display", "none");
            $("#empresa").attr('disabled', 'disabled');
            $("#ldserv2").attr('disabled', 'disabled');
            $("#panelldserv").attr('disabled', 'disabled');
            $("#tdr").css("display", "none");
            $("#tdr").attr('disabled', 'disabled');

            var id = $(this).find(':selected').val();

            $("#paneltdr").css("display", "block");
            $("#paneltdr").html("<img src='/img/loading.gif' />");
            $("#paneltdr").load('combobox.php?buscar=nietos&idhijo=' + id);

            $("#panelempresa").css("display", "block");
            $("#panelempresa").html("<img src='/img/loading.gif' />");
            $("#panelempresa").load('combobox.php?buscar=padreemp&idhijo=' + id);
            //$("#ldserv").attr('disabled', 'disabled');
        });

    });


    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function() {
        $("#fecha_in").datepicker({dateFormat: 'dd-mm-yy'}).val();
        $("#fechaout").datepicker({dateFormat: 'dd-mm-yy'}).val();
        $("#fecha_ina").datepicker({dateFormat: 'dd-mm-yy'}).val();
        $("#fechaouta").datepicker({dateFormat: 'dd-mm-yy'}).val();

    });




    function modifica_asignacion(id)
    {
        window.open('modifica_asignacion.php?id_func=' + id + '', 'n_w', 'width=600, height=800, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');

    }
    function elimina_externo(id_prof)
    {
        // alert(id);
        if (confirm('Desea Eliminar este Profesional?'))
        {

            var id_prof2 = id_prof;
            //alert (id_prof2);
            $("#contenidoOculto").load("eliminar_profesional.php?id_prof=" + id_prof2, function() {

                $("#contenidoOculto").slideUp(12000);
            });

        }


    }
    function envia() {
        document.formu1.submit();
        opener.location.reload();
        close();
    }

    function eliminando(id_asignacion, id_user)
    {
        //$("#alerta").css("display", "block");
        if (confirm('Desea Eliminar esta Asignación?'))
        {

            var id_asig = id_asignacion;
            var id_us = id_user;
            var texto = id_asig + "&id_func=" + id_us;
            //    alert(texto);

            $("#contenidoOculto").load("eliminar_asignacion.php?id_asig=" + texto, function() {

                //$("#alerta").slideUp(1200);
            });

        }
    }

    function modificando_asignacion(id_asignacion)
    {
        var texto = id_asignacion;
        

        window.open('edita_asignacion.php?id_asignacion=' + texto, 'n_w', 'width=200, height=300, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');

    }

    // click
    $("#firstpane p.menu_head").click(function()
    {
        $(this).css({}).next("div.menu_body").slideToggle(800).siblings("div.menu_body").slideUp("slow");
        $(this).siblings().css({});
    });

    function cambia_asignacion()
    {
        $("#editaasignacion").css("display", "block");
        $("#asignacionoriginal").css("display", "none");

    }

    $("#boton_ventana").click(function()
    {
        $("#boton_ventana").css("display", "none");
        $("#boton_cambia").css("display", "block");

        //  $(this).css({}).next("div.menu_body").slideToggle(800).siblings("div.menu_body").slideUp("slow");
        // $(this).siblings().css({});
    });



    function modifica_externo(id)
    {
        window.open('mod_externo.php?id_func=' + id + '', 'n_w', 'width=600, height=800, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');
    }

//<![CDATA[
    function ventanawin(url, mwidth, mheight) {
        if (document.all && window.print)
            eval('window.showModelessDialog(url,"","help:0;dialogTop:200px;dialogLeft:250px;resizable:0;dialogWidth:' + mwidth + 'px;dialogHeight:' + mheight + 'px")')
        else
            eval('window.open(url,"","width=' + mwidth + 'px,height=' + mheight + 'px,resizable=0,scrollbars=0,left=250,top=200")')
    }
//]]>	
    $(document).ready(function() {
        $('#jdepro option:not(:selected)').prop('disabled', true);
        $('#proyecto option:not(:selected)').prop('disabled', true);
      
      
        $("#dpto").change(function(event) {
            var id = $("#dpto").find(':selected').val();
            $("#jdepro").removeAttr('disabled');
            $("#proyecto").removeAttr('disabled');
            $("#jdepro").load('combobox.php?buscar=jefes&id=' + id);
        });

        $("#jdepro").change(function(event) {
            var id = $("#jdepro").find(':selected').val();
            $("#proyecto").load('combobox.php?buscar=proyectos&id2=' + id);
        });



    });


    function enviarMail(usuario,profesional,asunto) {
    var parametros = {
                "usuario" :usuario,
                "profesional" :profesional,
                "asunto" : asunto
        };
        $.ajax({
                data:  parametros,
                url:   'correo_modificaciones.php',
                type:  'post',
                beforeSend: function () {
                        alert("Procesando, espere por favor...");
                },
                success:  function () {
                        alert("ok");
                }
        });
}
  

    function valida_form_mes(formulario)
    {
        if (formulario.anio.value == "")
        {
            alert("Seleccion un año !!");
            formulario.anio.focus();
            return false;
        }
        if (formulario.mes.value == "")
        {
            alert("Seleccione MES !!");
            formulario.mes.focus();
            return false;
        }
        if (formulario.empresa.value == "")
        {
            alert("Seleccione una Empresa!!");
            formulario.empresa.focus();
            return false;
        }

        if (formulario.pgc.value == "")
        {
            alert("Debe identificar el Proceso de Grandes Compras !!");
            formulario.pgc.focus();
            return false;
        } else {


            formulario.submit();

        }
    }
        function valida_form_small(formulario)
    {
        if (formulario.anio.value == "")
        {
            alert("Seleccion un año !!");
            formulario.anio.focus();
            return false;
        }
        if (formulario.mes.value == "")
        {
            alert("Seleccione MES !!");
            formulario.mes.focus();
            return false;
        }
        if (formulario.empresa.value == "")
        {
            alert("Seleccione una Empresa!!");
            formulario.empresa.focus();
            return false;
        }

        if (formulario.pgc.value == "")
        {
            alert("Debe identificar el Proceso de Grandes Compras !!");
            formulario.pgc.focus();
            return false;
        }
        if (formulario.ldserv.value == "")
        {
            alert("Debe Seleccionar una Linea de Servicio !!");
            formulario.pgc.focus();
            return false;

        } else {


            formulario.submit();

        }
    }
</script>

