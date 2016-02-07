<?php

include('cabecera.php');

if(isset($_SESSION['IDUSUARIO'])==''){
  header('Location: login.php');
}else{
  
}


?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Inicio
            <small>Control de Acceso Remoto para Laboratorios y Oficinas</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

          
          <div class="row" id="contenidoLaboratorios">

            <?php
              if($_SESSION['IDROL']==1){

                /*
                  $lab1Horario = "";
                  $lab2Horario = "";
                  $lab3Horario = "";
                  $lab4Horario = "";
                  $lab5Horario = "";
                  $lab6Horario = "";
                  $labTeleHorario = "";
                  $labMacHorario = "";
                  $labElecHorario = "";
                  $labProfeHorario = "";
                  $labDireHorario = "";
                  $labAdminHorario = "";


                  $lab1Docente = "";
                  $lab2Docente = "";
                  $lab3Docente = "";
                  $lab4Docente = "";
                  $lab5Docente = "";
                  $lab6Docente = "";
                  $labTeleDocente = "";
                  $labMacDocente = "";
                  $labElecDocente = "";
                  $labProfeDocente = "";
                  $labDireDocente = "";
                  $labAdminDocente = "";

                  $lab1Semestre = "";
                  $lab2Semestre = "";
                  $lab3Semestre = "";
                  $lab4Semestre = "";
                  $lab5Semestre = "";
                  $lab6Semestre = "";
                  $labTeleSemestre = "";
                  $labMacSemestre = "";
                  $labElecSemestre = "";
                  $labProfeSemestre = "";
                  $labDireSemestre = "";
                  $labAdminSemestre = "";


                  require('conexionMalla.php');
                  $con2 = pg_connect($cadena2) or die ("Error de Conexion". pg_last_error());
                  

                  //$diaactual=date("N");
                  $diaactual = 1;
                  if($diaactual==1)$diaactual="Lunes";
                  if($diaactual==2)$diaactual="Martes";
                  if($diaactual==3)$diaactual="Miercoles";
                  if($diaactual==4)$diaactual="Jueves";
                  if($diaactual==5)$diaactual="Viernes";
                  if($diaactual==6)$diaactual="Sabado";
                  if($diaactual==7)$diaactual="Domingo";


                  //$horaactual = "".date('H').":".date('i');
                  $horaactual = "07:00";

                  //Obtengo ultimo periodo
                  $sql = "SELECT * FROM control_lectivo WHERE estado=TRUE ORDER BY id DESC LIMIT 1";

                  $resultado = pg_query($con2, $sql);

                  $idLectivo = 0;

                  while($reg=pg_fetch_assoc($resultado)){
                    $idLectivo = $reg['id'];
                  }

                  $sql2 = 'SELECT * FROM control_distributivo D, control_asignaturas A, control_semestre S, auth_user U 
                  WHERE D."idLectivo_id"='.$idLectivo.' '."AND D.dia='".$diaactual."'".' AND D."idAsignatura_id"=A.id AND A."idSemestre_id"=S.id AND U.id=D."idDocente_id"';

                  $resultado2 = pg_query($con2, $sql2);


                  $respuesta = '';

                  while($reg=pg_fetch_assoc($resultado2)){
                    $hora = $reg['horario'];
                    $horaInicio = '';
                    $horaFin = '';
                    for($i=0;$i<strlen($hora)-6;$i++){
                       $horaInicio .= substr($hora, $i, 1);
                    }
                    for($i=6;$i<strlen($hora);$i++){
                       $horaFin .= substr($hora, $i, 1);
                    }




                    if($horaactual>=$horaInicio && $horaactual<$horaFin){

                      $lab = $reg['idLab_id'];

                      require('conexion.php');
                      $con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

                      $sql3 = 'SELECT * FROM laboratorio WHERE vinculado_laboratorio='.$lab.'';
                      $resultado3 = pg_query($con, $sql3);


                      $idLab = '';
                      $nombreLab = '';
                      while($reg2=pg_fetch_assoc($resultado3)){
                          $idLab = $reg2['idlaboratorio'];
                          $nombreLab = $reg2['nombre_laboratorio'];
                      }

                      $respuesta .= "<hr>".$nombreLab." --- ".$reg['horario'];

                      if($idLab==1)$lab1Horario = $reg['horario'];
                      if($idLab==2)$lab2Horario = $reg['horario'];
                      if($idLab==3)$lab3Horario = $reg['horario'];
                      if($idLab==4)$lab4Horario = $reg['horario'];
                      if($idLab==5)$lab5Horario = $reg['horario'];
                      if($idLab==6)$lab6Horario = $reg['horario'];
                      if($idLab==7)$labMacHorario = $reg['horario'];
                      if($idLab==8)$labElecHorario = $reg['horario'];
                      if($idLab==9)$labTeleHorario = $reg['horario'];
                      if($idLab==10)$labProfeHorario = $reg['horario'];
                      if($idLab==11)$labDireHorario = $reg['horario'];
                      if($idLab==12)$labAdminHorario = $reg['horario'];

                      if($idLab==1)$lab1Docente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==2)$lab2Docente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==3)$lab3Docente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==4)$lab4Docente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==5)$lab5Docente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==6)$lab6Docente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==7)$labMacDocente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==8)$labElecDocente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==9)$labTeleDocente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==10)$labProfeDocente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==11)$labDireDocente = $reg['first_name'].' '.$reg['last_name'];
                      if($idLab==12)$labAdminDocente = $reg['first_name'].' '.$reg['last_name'];

                      if($idLab==1)$lab1Semestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==2)$lab2Semestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==3)$lab3Semestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==4)$lab4Semestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==5)$lab5Semestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==6)$lab6Semestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==7)$labMacSemestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==8)$labElecSemestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==9)$labTeleSemestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==10)$labProfeSemestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==11)$labDireSemestre = $reg['nombre'].' '.$reg['paralelo'];
                      if($idLab==12)$labAdminSemestre = $reg['nombre'].' '.$reg['paralelo'];

                    
                       
                    }


                   
                  }




                  
                */



                ?>

       
            

          


                <?php
              }else{


            }
            
            
        ?>



          </div>

          



        

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<script type="text/javascript">

  function objetoAjax(){
    var xmlhttp=false;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }

  function mostrarLaboratorios(){
    var rol = $('#rolOculto').val();
    
    if(rol==1){
        laboratoriosAdministrador();
    }else{
      laboratoriosUsuario();
    }
  }

  function laboratoriosUsuario(){

    
    ajax = objetoAjax();

    ajax.open("POST", "laboratorio/laboratorios_usuario.php", true);

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          document.getElementById("contenidoLaboratorios").innerHTML = mensajeRespuesta;
          
        }
      }
      ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      ajax.send();
      

    }

     function laboratoriosAdministrador(){
    
      ajax = objetoAjax();

      ajax.open("POST", "laboratorio/laboratorios_administrador.php", true);

      ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
            var mensajeRespuesta = ajax.responseText;

            document.getElementById("contenidoLaboratorios").innerHTML = mensajeRespuesta;
            
          }
        }
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        ajax.send();
        

      }



</script>


<?php
include('pie.php');
?>  