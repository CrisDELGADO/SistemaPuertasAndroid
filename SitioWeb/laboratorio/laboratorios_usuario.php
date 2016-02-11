<?php

    

			date_default_timezone_set("America/Bogota");

			     require('../conexionMalla.php');
            $con2 = pg_connect($cadena2) or die ("Error de Conexion". pg_last_error());

            session_start();
            $idusuariovinculado = $_SESSION['IDUSUARIOVINCULADO'];
            //$idusuariovinculado = 12;
            

            $diaactual=date("N");
            //$diaactual = 5;
            if($diaactual==1)$diaactual="Lunes";
            if($diaactual==2)$diaactual="Martes";
            if($diaactual==3)$diaactual="Miercoles";
            if($diaactual==4)$diaactual="Jueves";
            if($diaactual==5)$diaactual="Viernes";
            if($diaactual==6)$diaactual="Sabado";
            if($diaactual==7)$diaactual="Domingo";


            $horaactual = "".date('H').":".date('i');
            //$horaactual = "09:10";

            //Obtengo ultimo periodo
            $sql = "SELECT * FROM control_lectivo WHERE estado=TRUE ORDER BY id DESC LIMIT 1";

            $resultado = pg_query($con2, $sql);

            $idLectivo = 0;

            while($reg=pg_fetch_assoc($resultado)){
              $idLectivo = $reg['id'];
            }

            $sql2 = 'SELECT * FROM control_distributivo WHERE "idDocente_id"='.$idusuariovinculado.' AND "idLectivo_id"='.$idLectivo.'  '." AND dia='".$diaactual."'";

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

                require('../conexion.php');
                $con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

                $sql3 = 'SELECT * FROM laboratorio WHERE vinculado_laboratorio='.$lab.'';
                $resultado3 = pg_query($con, $sql3);


                $imagen = '';
                $pulso = '';
                $idlaboratorio = 0;
                while($reg2=pg_fetch_assoc($resultado3)){
                    $imagen = $reg2['imagen_laboratorio'];
                    $pulso = $reg2['pulso_laboratorio'];
                    $idlaboratorio = $reg2['idlaboratorio'];
                }


                $respuesta = '<div class="col-md-4">
                                <br>
                                <a style="cursor:pointer;" onclick="'."guardarregistro('".$pulso."',".$idlaboratorio.");".'" return false;"><img src="'.$imagen.'" width="100%" class="img-rounded" title="Abrir"></a>
                              </div>';
                 
              }
             
            }

            

            echo $respuesta;
            
          
            

            


?>