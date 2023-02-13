<?php
	function conectar()
	{
		$user="root";
		$pass="";
		$server="localhost";
		$db="lasvigas";
		$con=mysqli_connect($server, $user, $pass,$db) or die("No se puedo estrablecer la conexion con las base de datos".mysqli_error());
		
		return $con;

	}				
?>