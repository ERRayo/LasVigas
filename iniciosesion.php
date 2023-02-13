<?php
include("Conexion.php");
$con=conectar();

$usuario=$_POST["usuario"];
$contrasena=$_POST["contrasena"];

$sql = "select * from datosadmin where usuario='$usuario' and pass='$contrasena'";

$ConsultaUsuario = mysqli_query($con,$sql) or die("Error al iniciar sesion");

if ($resultado = mysqli_fetch_array($ConsultaUsuario)) 
{
	session_start();
	$_SESSION["u_usuario"] = $resultado["usuario"];
	echo"<script type=\"text/javascript\">alert('Sesion de administrador iniciada'); window.location='MenuAdmin.php';</script>";
}
else
{
	echo"<script type=\"text/javascript\">alert('Usuario o contraseña incorrectos'); window.location='SesionAdmin.php';</script>";	
}
?>