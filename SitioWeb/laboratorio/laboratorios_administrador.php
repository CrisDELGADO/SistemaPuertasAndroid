<?php

    

			   date_default_timezone_set("America/Bogota");


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


          


          $lab1Pulso = "";
          $lab2Pulso = "";
          $lab3Pulso = "";
          $lab4Pulso = "";
          $lab5Pulso = "";
          $lab6Pulso = "";
          $labTelePulso = "";
          $labMacPulso = "";
          $labElecPulso = "";
          $labProfePulso = "";
          $labDirePulso = "";
          $labAdminPulso = "";



          require('../conexion.php');
          $con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

          $sql3 = 'SELECT * FROM laboratorio';
          $resultado3 = pg_query($con, $sql3);


          while($reg2=pg_fetch_assoc($resultado3)){
              if($reg2['idlaboratorio']==1)$lab1Pulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==2)$lab2Pulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==3)$lab3Pulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==4)$lab4Pulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==5)$lab5Pulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==6)$lab6Pulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==7)$labMacPulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==8)$labElecPulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==9)$labTelePulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==10)$labProfePulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==11)$labDirePulso=$reg2['pulso_laboratorio'];
              if($reg2['idlaboratorio']==12)$labAdminPulso=$reg2['pulso_laboratorio'];
          }


          $lab1Imagen = "img/banner_horizontal_lab1_des.png";
          $lab2Imagen = "img/banner_horizontal_lab2_des.png";
          $lab3Imagen = "img/banner_horizontal_lab3_des.png";
          $lab4Imagen = "img/banner_horizontal_lab4_des.png";
          $lab5Imagen = "img/banner_horizontal_lab5_des.png";
          $lab6Imagen = "img/banner_horizontal_lab6_des.png";
          $labTeleImagen = "img/banner_horizontal_tele_des.png";
          $labMacImagen = "img/banner_horizontal_mac_des.png";
          $labElecImagen = "img/banner_horizontal_elec_des.png";
          $labProfeImagen = "img/banner_horizontal_profe_des.png";
          $labDireImagen = "img/banner_horizontal_dire_des.png";
          $labAdminImagen = "img/banner_horizontal_admin_des.png";


          require('../conexionMalla.php');
          $con2 = pg_connect($cadena2) or die ("Error de Conexion". pg_last_error());
          

          $diaactual=date("N");
          //$diaactual = 1;
          if($diaactual==1)$diaactual="Lunes";
          if($diaactual==2)$diaactual="Martes";
          if($diaactual==3)$diaactual="Miercoles";
          if($diaactual==4)$diaactual="Jueves";
          if($diaactual==5)$diaactual="Viernes";
          if($diaactual==6)$diaactual="Sabado";
          if($diaactual==7)$diaactual="Domingo";


          $horaactual = "".date('H').":".date('i');
          //$horaactual = "07:00";


          $dia=date("d");
          $mes=date("m");
          $anio=date("Y");

          $fecha_actual = $anio.'-'.$mes.'-'.$dia;
          //$fecha_actual = '2016-02-01';



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

              //require('../conexion.php');
              //$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());


              $sql3 = 'SELECT * FROM laboratorio WHERE vinculado_laboratorio='.$lab.'';
              $resultado3 = pg_query($con, $sql3);


              $idLab = '';
              $nombreLab = '';
    
              while($reg2=pg_fetch_assoc($resultado3)){
                  $idLab = $reg2['idlaboratorio'];
                  $nombreLab = $reg2['nombre_laboratorio'];
                  
              }

              
              $sql4 = "SELECT * FROM registro WHERE fecha_registro='".$fecha_actual."' AND idlaboratorio=".$idLab."";
              $resultado4 = pg_query($con, $sql4);

              $imagen = '';
              $ocupado = FALSE;

              while($reg4=pg_fetch_assoc($resultado4)){
                if($reg4['hora_registro']>=$horaInicio && $reg4['hora_registro']<$horaFin){
                   $ocupado = TRUE;
                }
              }


              if($idLab==1 && $ocupado)$lab1Imagen = "img/banner_horizontal_lab1.png";
              if($idLab==2 && $ocupado)$lab2Imagen = "img/banner_horizontal_lab2.png";
              if($idLab==3 && $ocupado)$lab3Imagen = "img/banner_horizontal_lab3.png";
              if($idLab==4 && $ocupado)$lab4Imagen = "img/banner_horizontal_lab4.png";
              if($idLab==5 && $ocupado)$lab5Imagen = "img/banner_horizontal_lab5.png";
              if($idLab==6 && $ocupado)$lab6Imagen = "img/banner_horizontal_lab6.png";
              if($idLab==7 && $ocupado)$labMacImagen = "img/banner_horizontal_mac.png";
              if($idLab==8 && $ocupado)$labElecImagen = "img/banner_horizontal_elec.png";
              if($idLab==9 && $ocupado)$labTeleImagen = "img/banner_horizontal_tele.png";
              if($idLab==10 && $ocupado)$labProfeImagen = "img/banner_horizontal_profe.png";
              if($idLab==11 && $ocupado)$labDireImagen = "img/banner_horizontal_dire.png";
              if($idLab==12 && $ocupado)$labAdminImagen = "img/banner_horizontal_admin.png";

              


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

              /*

              if($idLab==1)$lab1Pulso = 'http://192.168.0.110/pulsos/laboratorio1.php';
              if($idLab==2)$lab2Pulso = $pulso;
              if($idLab==3)$lab3Pulso = $pulso;
              if($idLab==4)$lab4Pulso = $pulso;
              if($idLab==5)$lab5Pulso = $pulso;
              if($idLab==6)$lab6Pulso = $pulso;
              if($idLab==7)$labMacPulso = $pulso;
              if($idLab==8)$labElecPulso = $pulso;
              if($idLab==9)$labTelePulso = $pulso;
              if($idLab==10)$labProfePulso = $pulso;
              if($idLab==11)$labDirePulso = $pulso;
              if($idLab==12)$labAdminPulso = $pulso;

              */

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






          $respuesta = '<div class="col-md-5">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$lab1Pulso."',1);".'" return false;"><img src="'.$lab1Imagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$lab1Horario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$lab1Docente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$lab1Semestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5 col-md-offset-2">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$lab2Pulso."',2);".'" return false;"><img src="'.$lab2Imagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$lab2Horario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$lab2Docente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$lab2Semestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$lab3Pulso."',3);".'" return false;"><img src="'.$lab3Imagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$lab3Horario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$lab3Docente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$lab3Semestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5 col-md-offset-2">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$lab4Pulso."',4);".'" return false;"><img src="'.$lab4Imagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$lab4Horario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$lab4Docente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$lab4Semestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$lab5Pulso."',5);".'" return false;"><img src="'.$lab5Imagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$lab5Horario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$lab5Docente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$lab5Semestre.'"> 
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5 col-md-offset-2">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$lab6Pulso."',6);".'" return false;"><img src="'.$lab6Imagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$lab6Horario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$lab6Docente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$lab6Semestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$labElecPulso."',8);".'" return false;"><img src="'.$labElecImagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$labElecHorario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$labElecDocente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$labElecSemestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5 col-md-offset-2">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$labMacPulso."',7);".'" return false;"><img src="'.$labMacImagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$labMacHorario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$labMacDocente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$labMacSemestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$labTelePulso."',9);".'" return false;"><img src="'.$labTeleImagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$labTeleHorario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$labTeleDocente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$labTeleSemestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5 col-md-offset-2">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$labProfePulso."',10);".'" return false;"><img src="'.$labProfeImagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$labProfeHorario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$labProfeDocente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$labProfeSemestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$labDirePulso."',11);".'" return false;"><img src="'.$labDireImagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$labDireHorario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$labDireDocente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$labDireSemestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-5 col-md-offset-2">
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <img src="img/banner_vertical.png" width="100%" class="img-rounded">
                </div>
                <div class="col-xs-9">
                  <a style="cursor:pointer;" onclick="'."guardarregistro('".$labAdminPulso."',12);".'" return false;"><img src="'.$labAdminImagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Horario" name="horario" type="text" autofocus disabled value="'.$labAdminHorario.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Docente" name="docente" type="text" autofocus disabled value="'.$labAdminDocente.'">
                    </div>
                  </div>

                  <div class="row">
                    <br>
                    <div class="col-md-12">
                      <input class="form-control" placeholder="Semestre" name="semestre" type="text" autofocus disabled value="'.$labAdminSemestre.'">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>';

echo $respuesta;
            


?>