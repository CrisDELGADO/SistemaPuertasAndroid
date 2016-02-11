<?php
session_start();

$idusuario = $_POST['idusuario'];
$idusuariovinculado = $_POST['idusuariovinculado'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

$passwordE = base64_encode($password2);



if($nombre!='' && $apellido!='' && $username!=''){



	require('../conexion.php');

	$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());


	$sqlUser = "SELECT username FROM usuario WHERE username='".$username."' AND idusuario!=".$idusuario."";

	$resultado = pg_query($con, $sqlUser);

	$existe = FALSE;

	while($reg=pg_fetch_assoc($resultado)){
	  $existe = TRUE;
	}



	if($existe){
		echo 'Este Username ya está ocupado';
	}else{
		$sql = "UPDATE usuario SET nombre='".$nombre."', apellido='".$apellido."', username='".$username."', password='".$passwordE."', idusuariovinculado=".$idusuariovinculado." WHERE idusuario='".$idusuario."'";

		pg_query($con, $sql);

		echo 'BIEN';
	}

	

}else{
	echo 'Campos obligatorios.';
}



?>
