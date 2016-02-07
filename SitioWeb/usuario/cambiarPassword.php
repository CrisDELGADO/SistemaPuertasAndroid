<?php
session_start();

$idusuario = $_SESSION['IDUSUARIO'];
$password = $_POST['password'];
$passwordnueva = $_POST['passwordnueva'];
$passwordnueva2 = $_POST['passwordnueva2'];


if($passwordnueva!='' && $passwordnueva2!='' && $password!=''){

	require('../conexion.php');
	$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

	$sql = "SELECT * FROM usuario WHERE idusuario=".$idusuario."";

	$resultado = pg_query($con, $sql);
	

	$passwordActual = '';


	while($reg=pg_fetch_assoc($resultado)){
	  $passwordActual = $reg['password'];
	}

	if($password==$passwordActual){

		if($passwordnueva==$passwordnueva2){

			$sql2 = "UPDATE usuario SET password='".$passwordnueva."' WHERE idusuario='".$idusuario."'";
			pg_query($con, $sql2);
			

			echo 'BIEN';

		}else{
			echo 'Contraseñas nuevas, no coinciden.';
		}


	}else{
		echo 'Contraseña Actual Incorrecta.';
	}


	
	

}else{
	echo 'Todos los campos son obligatorios.';
}



?>
