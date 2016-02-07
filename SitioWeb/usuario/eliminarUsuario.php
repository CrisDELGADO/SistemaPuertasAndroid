<?php
$idusuario = $_POST['idusuario'];

require('../conexion.php');

$con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

$sql = "DELETE FROM usuario WHERE idusuario=".$idusuario."";

pg_query($con, $sql);

?>
