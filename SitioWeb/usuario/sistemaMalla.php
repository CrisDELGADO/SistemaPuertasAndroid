<?php

$cadena = " host='localhost' port='5432' dbname='dbcontrol' user='postgres' password='123456' ";
$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

function listarUsuarios(){
	$sql = "SELECT * FROM auth_user";

	$resultado = pg_query($con, $sql);

	if(!$resultado){
		//ERROR DE BUSQUEDA
	}

	$valoresOption = '';

	while($reg=pg_fetch_assoc($resultado)){
		$valoresOption.="<option value=".$reg['id'].">".$reg['first_name']." ".$reg['last_name']."</option>";
	}

	return $valoresOption;

	
}


function verLaboratorios($idusuariovinculado){

	$diaactual=date("N");
	if($diaactual==1)$diaactual="Lunes";
	if($diaactual==2)$diaactual="Martes";
	if($diaactual==3)$diaactual="Miercoles";
	if($diaactual==4)$diaactual="Jueves";
	if($diaactual==5)$diaactual="Viernes";
	if($diaactual==6)$diaactual="Sabado";
	if($diaactual==7)$diaactual="Domingo";

	//Obtengo ultimo periodo
	$sql = "SELECT * FROM control_lectivo WHERE estado=TRUE ORDER BY id DESC LIMIT 1";

	$resultado = pg_query($con, $sql);

	$idLectivo = 0;

	while($reg=pg_fetch_assoc($resultado)){
		$idLectivo = $reg['id'];
	}

	$sql2 = "SELECT * FROM control_distributivo WHERE idDocente_id='".$idusuariovinculado."' AND idLectivo_id='".$idLectivo."'";

	$resultado2 = pg_query($con, $sql);


	$respuesta = '';

	while($reg=pg_fetch_assoc($resultado2)){
		$respuesta .= "";
	}

	return $respuesta;



	
}

?>