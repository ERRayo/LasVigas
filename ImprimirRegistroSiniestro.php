<html>
<head>
	<title>Imprimir</title>
	<link rel="shortcut icon" href="./image/iconoTitle2.png">
	<link rel="stylesheet" href="./css/estiloFormu.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="./css/estiloTexto.css">

<?php
include("Conexion.php");
$con=conectar();

	$nombreS=$_POST["nombreS"];
	$apellidoS=$_POST["apellidoS"];
	$tipoSexo=$_POST["tipoSexo"];
	$edadS=$_POST["edadS"];
	$caracVictima=$_POST["caracVictima"];
	$tipoS=$_POST["tipoS"];
	$calleS=$_POST["calleS"];
	$coloniaS="S/Datos";
	$localidadS=$_POST["localidadS"];
	$municipioS=$_POST["municipioS"];
	$desSiniestro=htmlspecialchars($_POST["desSiniestro"]);
	$nombreD=$_POST["nombreD"];
	$apellidosD=$_POST["apellidosD"];
	$telD=$_POST["telD"];
	$emailD=$_POST["emailD"];

	if(empty($caracVictima))
	{
		$caracVictima="S/Datos";
	}
	if(empty($calleS))
	{
		$calleS="S/Datos";
	}
	if(empty($coloniaS))
	{
		$coloniaS="S/Datos";
	}
	if(empty($desSiniestro))
	{
		$desSiniestro="S/Datos";
	}
	if(empty($apellidosD))
	{
		$apellidosD="S/Datos";
	}

if(!empty($nombreS))
{
		if(!empty($apellidoS))
		{
		$sqlDatosV="INSERT INTO datosvictimas
		(nombrev,apellidosv,sexo,edadv,caracteristicasv)
		VALUES('$nombreS','$apellidoS','$tipoSexo','$edadS','$caracVictima');";
		} else {
		$sqlDatosV="INSERT INTO datosvictimas
		(nombrev,sexo,edadv,caracteristicasv)
		VALUES('$nombreS','$tipoSexo','$edadS','$caracVictima');";
		}
		
		$ConsultaVictima = mysqli_query($con,$sqlDatosV) or die(mysqli_error());

		$sqlDatosS="INSERT INTO datossiniestro
		(tiposiniestro,calles,localidads,municipios,descripcionsiniestro)
		VALUES('$tipoS','$calleS','$localidadS','$municipioS','$desSiniestro');";
		$ConsultaSiniestro = mysqli_query($con,$sqlDatosS) or die(mysqli_error());

		$sqlID="SELECT MAX(id_victima) as ID FROM datosvictimas;";
		$ConsultaID = mysqli_query($con,$sqlID) or die(mysqli_error());
		$idO = mysqli_fetch_array($ConsultaID);
		$IDMax = htmlspecialchars($idO["ID"]);
		$IDMaxAux = $IDMax;
	
} else {
		$IDMaxAux = "Sin dato";
		$nombreS="Sin dato";
		$apellidoS="";
		$tipoSexo="Sin dato";
		$edadS="Sin dato";
		$caracVictima="Sin dato";
		$tipoS="Sin dato";
		$calleS="Sin dato";
		$coloniaS="Sin dato";
		$municipioS="Sin dato";
		$desSiniestro="Sin dato";
}
//------------------------------------------------------------------------------

if(!empty($nombreD))
{
		$TELaux;
		$EMAILaux;
		if (!empty($telD)) { // <= false
	    // No está vacía (true) 
	    $TELaux=1;
		} else {
		    // Está vacía (false)
		    $TELaux=0;
		}
		if (!empty($emailD)) { // <= false
		    // No está vacía (true) 
		    $EMAILaux=1;
		} else {
		    // Está vacía (false)
		    $EMAILaux=0;
		}
		switch (true) 
		{
			case ($TELaux == 1) and ($EMAILaux == 1):// Telefoni Si -- Email Si
					$sqlDatosD="INSERT INTO datosdenunciante
					(id_victima,nombredenu,apellidosdenu,telefonodenu,emaildenu)
					VALUES('$IDMax','$nombreD','$apellidosD','$telD','$emailD');";
					break;
			case ($TELaux == 0) and ($EMAILaux == 0):// Telefoni No -- Email No
					$sqlDatosD="INSERT INTO datosdenunciante
					(id_victima,nombredenu,apellidosdenu)
					VALUES('$IDMax','$nombreD','$apellidosD');";	
					break;
			case ($TELaux == 0) and ($EMAILaux == 1):// Telefoni No -- Email Si
					$sqlDatosD="INSERT INTO datosdenunciante
					(id_victima,nombredenu,apellidosdenu,emaildenu)
					VALUES('$IDMax','$nombreD','$apellidosD','$emailD');";
					break;
			case ($TELaux == 1) and ($EMAILaux == 0):// Telefoni Si -- Email No
					$sqlDatosD="INSERT INTO datosdenunciante
					(id_victima,nombredenu,apellidosdenu,telefonodenu)
					VALUES('$IDMax','$nombreD','$apellidosD','$telD');";
					break;
			default: 
		    		echo 'Algo salio mal'; 
		  			break;	
  		}
  		$ConsulAfectado = mysqli_query($con,$sqlDatosD) or die("Error datos denunciante".mysqli_error());
	} else {
		$IDMax="";
		$nombreD="Sin dato";
		$apellidosD="";
		$telD="Sin dato";
		$emailD="Sin dato";
	}
	mysqli_close($con);
?>
</head>
<body>
<table width="100%" border="1" class="Texto1" align="center">
		<tr height="180" style="background-color: #024959;">
			<td style="width: 25%" align="center" class="Logo"><img src="./image/logoG.png" width="120"></td>
			<td align="center" colspan="2" ><h1 class="titulo1">L A S &nbsp; V I G A S<br>G U E R R E R O</h1></td>
			<td style="width: 25%" align="center" class="Logo1"><img src="./image/logo.png" width="140"></a></td>		
		</tr>
		<tr>
			<td colspan="4" height="30" align="center">
				<h3>"Comisión de Seguridad e Higiene, Resgistro de Denuncia"</h3>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="right">
				<b>No. de registro de siniestro:</b>
			</td>
			<td colspan="1">
				<?php echo $IDMaxAux; ?>
			</td>
		</tr>
		<tr>
			<td width="20%">
				<b>Nombre de la victima:</b>
			</td>
			<td width="20%">
				<?php echo $nombreS; echo " ".$apellidoS; ?>
			</td>
			<td width="20%">
				<b>Sexo:</b>
			</td>
			<td width="20%">
				<?php echo $tipoSexo; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Edad:</b>
			</td>
			<td>
				<?php echo $edadS; ?>
			</td>
			<td>
				<b>Caracteristica de la victima:</b>
			</td>
			<td>
				<?php echo $caracVictima; ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
				<b>Datos del siniestro:</b>
			</td>
		</tr>
		<tr>
			<td>
				<b>Tipo de siniestro:</b>
			</td>
			<td colspan="3">
				<?php echo $tipoS; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Calle:</b>
			</td>
			<td>
				<?php echo $calleS; ?>
			</td>
			<td>
				<b>Localidad:</b>
			</td>
			<td>
				<?php echo $localidadS; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Municipio:</b>
			</td>
			<td>
				<?php echo $municipioS; ?>
			</td>
			<td>
				<b>Descriccion del siniestro:</b>
			</td>
			<td>
				<?php echo $desSiniestro; ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
				<b>Datos del denunciante:</b>
			</td>
		</tr>
		<tr>
			<td>
				<b>Nombre:</b>
			</td>
			<td>
				<?php echo $nombreD; echo " ".$apellidosD; ?>
			</td>
			<td>
				<b>Telefono/Celular:</b>
			</td>
			<td>
				<?php echo $telD; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>e-mail:</b>
			</td>
			<td colspan="3">
				<?php echo $emailD; ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
				<input type="button" value="Imprimir registro" onclick="window.print()">
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center" bgcolor="024959">
				<a href="javascript:cerrar();" style="text-decoration: none; color: #fff"> Inicio </a>
			</td>
		</tr>
</table>
</body>
</html>
<script language="javascript" type="text/javascript"> 
function cerrar() 
{  
   window.location='index.php';
} 
</script>