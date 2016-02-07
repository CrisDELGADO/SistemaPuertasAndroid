<?php
session_start();

$idusuario = $_SESSION['IDUSUARIO'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$username = $_POST['username'];


if($nombre!='' && $apellido!='' && $username!=''){
	require('../conexion.php');

	$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());


	$sqlUser = "SELECT username FROM usuario WHERE username='".$username."' AND idusuario != '".$idusuario."'";

	$resultado = pg_query($con, $sqlUser);

	$existe = FALSE;

	while($reg=pg_fetch_assoc($resultado)){
	  $existe = TRUE;
	}



	if($existe){
		echo 'Este Username ya está ocupado';
	}else{
		$sql = "UPDATE usuario SET nombre='".$nombre."', apellido='".$apellido."', username='".$username."' WHERE idusuario='".$idusuario."'";

		pg_query($con, $sql);

	
		$_SESSION['NOMBRE']=$nombre;
		$_SESSION['USERNAME'] = $username;

		echo 'BIEN';
	}

	

}else{
	echo 'Todos los campos son obligatorios.';
}



?>
