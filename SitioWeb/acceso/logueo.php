<?php
session_start();

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$passwordE = base64_encode($password);

require('../conexion.php');
$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

$sql = "SELECT * FROM usuario WHERE username='$username' AND password='$passwordE' ";

$resultado = pg_query($con, $sql);

if(!$resultado){
	//ERROR DE BUSQUEDA
}

$mensaje = '';

$filas = pg_num_rows($resultado);
if($filas<=0){
	//NO EXISTE
	$mensaje = 'Usuario o Contraseña incorrectos';
}else{
	//EXISTE
	$mensaje = 'Bienvenido';
	
	while($reg=pg_fetch_assoc($resultado)){
		$_SESSION['IDUSUARIO'] = $reg['idusuario'];
		$_SESSION['NOMBRE'] = $reg['nombre'];
		$_SESSION['USERNAME'] = $reg['username'];
		$_SESSION['IDROL'] = $reg['idrol'];
		$_SESSION['IDUSUARIOVINCULADO'] = $reg['idusuariovinculado'];
	}


	
}

echo $mensaje;



?>
