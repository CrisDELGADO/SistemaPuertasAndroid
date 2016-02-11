<?php
session_start();

date_default_timezone_set("America/Bogota");

$rutaPulso = $_POST['rutaPulso'];
$idlaboratorio = $_POST['idlaboratorio'];

$idusuario = $_SESSION['IDUSUARIO'];


//$rutaPulso = 'http://192.168.0.110/pulsos/pulso.php';

if($_SESSION['IDROL']!=1){

	$idusuariovinculado = $_SESSION['IDUSUARIOVINCULADO'];

	//GUARDO REGISTRO
	require('../conexion.php');
	$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

	$dia=date("d");
	$mes=date("m");
	$anio=date("Y");

	$fecha_actual = $anio.'-'.$mes.'-'.$dia;
	$horaactual = "".date('H').":".date('i');
	//$horaactual = '09:10';

	$mesL = '';

	if($mes==1)$mesL = 'Enero';
	if($mes==2)$mesL = 'Febrero';
	if($mes==3)$mesL = 'Marzo';
	if($mes==4)$mesL = 'Abril';
	if($mes==5)$mesL = 'Mayo';
	if($mes==6)$mesL = 'Junio';
	if($mes==7)$mesL = 'Julio';
	if($mes==8)$mesL = 'Agosto';
	if($mes==9)$mesL = 'Septiembre';
	if($mes==10)$mesL = 'Octubre';
	if($mes==11)$mesL = 'Noviembre';
	if($mes==12)$mesL = 'Diciembre';

	$fecha_hora_registro = $dia.' de '.$mesL.' del '.$anio;

	$semestre = '';

	$diaactual=date("N");
	//$diaactual = 1;
	if($diaactual==1)$diaactual="Lunes";
	if($diaactual==2)$diaactual="Martes";
	if($diaactual==3)$diaactual="Miercoles";
	if($diaactual==4)$diaactual="Jueves";
	if($diaactual==5)$diaactual="Viernes";
	if($diaactual==6)$diaactual="Sabado";
	if($diaactual==7)$diaactual="Domingo";

	require('../conexionMalla.php');
    $con2 = pg_connect($cadena2) or die ("Error de Conexion". pg_last_error());

    //Obtengo ultimo periodo
	  $sql3 = "SELECT * FROM control_lectivo WHERE estado=TRUE ORDER BY id DESC LIMIT 1";

	  $resultado3 = pg_query($con2, $sql3);

	  $idLectivo = 0;

	  while($reg=pg_fetch_assoc($resultado3)){
	    $idLectivo = $reg['id'];
	  }


	$sql2 = 'SELECT * FROM control_distributivo D, control_asignaturas A, control_semestre S, auth_user U 
          WHERE D."idLectivo_id"='.$idLectivo.' '."AND D.dia='".$diaactual."'".' AND D."idAsignatura_id"=A.id AND A."idSemestre_id"=S.id AND U.id=D."idDocente_id" AND D."idDocente_id"='.$idusuariovinculado.'';

    $resultado2 = pg_query($con2, $sql2);

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
        	$semestre = $reg['nombre'].' '.$reg['paralelo'];
        }
    }

	

	



	$sql = "INSERT INTO registro (idusuario, idlaboratorio, fecha_hora_registro, hora_registro, semestre_registro, 
		fecha_registro) VALUES (".$idusuario.",".$idlaboratorio.",'".$fecha_hora_registro."','".$horaactual."',
		'".$semestre."','".$fecha_actual."')";
	pg_query($con, $sql);
}



header('Location: '.$rutaPulso.'');

?>