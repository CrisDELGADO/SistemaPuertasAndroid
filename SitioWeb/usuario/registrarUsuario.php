<?php
session_start();

$idusuariovinculado = $_POST['idusuariovinculado'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];


if($nombre!='' && $apellido!='' && $username!='' && $password!='' && $password2!=''){

	if($password!= $password2){
		echo 'Las contraseñas no coinciden';
	}
	else{


		require('../conexion.php');
		$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

		$sql = "SELECT username FROM usuario WHERE username='".$username."'";

		$resultado = pg_query($con, $sql);

		$existe = FALSE;

		while($reg=pg_fetch_assoc($resultado)){
		  $existe = TRUE;
		}

		if($existe){
			echo 'Este Username ya está ocupado';
		}else{

			$sqlUser = "INSERT INTO usuario (nombre, apellido, username, password, idusuariovinculado, idrol) VALUES ('".$nombre."','".$apellido."','".$username."','".$password."',".$idusuariovinculado.",2)";

			pg_query($con, $sqlUser);

			echo 'BIEN';
		}
	}


}else{
	echo 'Todos los campos son obligatorios.';
}



?>
