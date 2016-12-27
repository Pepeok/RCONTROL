<?php  session_start();

      $nom_user=$_POST['username'];
      $pass_recib=$_POST['password'];
      echo $nom_user;
      echo "</br>";
      echo $pass_recib;			


    $password_aux=md5($pass_recib);

    include("../conectabd/conexion_bd.php");

    mysql_select_db("rcontrol")or die("No se pudo hallar Base de Datos RCONTROL !!");

    $query ="SELECT * FROM usuario WHERE (nombre_usuario='".trim($nom_user)."') ";
    $query.=" AND (pass_usuario='".trim($password_aux)."');";

     //echo $query;
   
    $result=mysql_query($query)or die("No se pudo realizar Consulta !!");

    $fila=mysql_fetch_array($result);
   

   $id_usuario=$fila['id_usuario'];      
   $tipo_user=$fila['id_perfil_usuario'];
   $nombrep=$fila['nombre'];
   $apellidop=$fila['apellido'];
   $email==$fila['email_usuario'];

     


    mysql_close();

    $n=0; 
    $paso="";
    $n=mysql_num_rows($result);

    if($n == 0){
     
    $_SESSION['usuario']=$usr;
    $_SESSION['controla']="no";


   ?>

      <SCRIPT LANGUAGE="JAVASCRIPT">
         alert('Usuario  NO Resgistrado o contraseña No corresponde!!');

         window.location="login.html";

      </SCRIPT>-->
      <?

    }else{
    $_SESSION['controla']="si";
    $_SESSION['usuario']=$nom_user;
    $_SESSION['id_usuario']=$id_usuario;
    $_SESSION['id_perfil']=$tipo_user;
    $_SESSION['nombrep']=$nombrep;
    $_SESSION['apellidop']=$apellidop;
    $_SESSION['email']=$email;

    
   
    ?>
       <SCRIPT LANGUAGE="JAVASCRIPT">
         
         window.location="index.php";

        </SCRIPT>
      <?
    }


  
?>
