<!DOCTYPE html>
<html>
<head>
	<title>Reporte</title>
	<link rel="shortcut icon" href="image/iconoTitle2.png">
	<link rel="stylesheet" href="./css/estiloFormu.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="./css/estiloTexto.css">
	<?php
	
		include("Conexion.php");
		$con=conectar();

		$menuR=$_POST["menuR"];
		$desGeneral=htmlspecialchars($_POST["desGeneral"]);
		$nombreIma=$_FILES["imagen"]["tmp_name"];
		$fechaR=$_POST["fechaO"];
		$calleR=$_POST["calleR"];
		$localidadR=$_POST["localidadR"];
		$municipioR=$_POST["municipioR"];
		$nombreR=$_POST["nombreR"];
		$apellidosR=$_POST["apellidosR"];
		$edadR=$_POST["edadR"];
		$sexoR=$_POST['tipoSexo'];
		$telR=$_POST["telR"];
		$emailR=$_POST["emailR"];

		$TELaux;
		$EMAILaux;

		if (!empty($telR)) // <= false
		{  
		    $TELaux=1;// No está vacía (true)
		    $telRaux=$telR;
		} else {
		    $TELaux=0;// Está vacía (false)
		    $telRaux="S/Datos";
		}
		if (!empty($emailR)) // <= false
		{ 
		    $EMAILaux=1;// No está vacía (true)
		    $emailRaux=$emailR;
		} else {
		    $EMAILaux=0;// Está vacía (false)
		    $emailRaux="S/Datos";
		}

	if(!empty($menuR))
	{

		$imagenAux=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
		
		switch (true) 
			{
				case ($TELaux == 1) and ($EMAILaux == 1):// Telefoni Si -- Email Si
						$sqlDatos="INSERT INTO reportecivico (nombrec,apellidosc,edadc,sexoc,telc,emailc,tiporeporte,reporte,callec,localidadc,municipioc,fechaobservada,imagenc) VALUES('$nombreR','$apellidosR','$edadR','$sexoR','$telR','$emailR','$menuR','$desGeneral','$calleR','$localidadR','$municipioR','$fechaR','$imagenAux');";
						break;
				case ($TELaux == 0) and ($EMAILaux == 0):// Telefoni No -- Email No
						$sqlDatos="INSERT INTO reportecivico (nombrec,apellidosc,edadc,sexoc,tiporeporte,reporte,callec,localidadc,municipioc,fechaobservada,imagenc) VALUES('$nombreR','$apellidosR','$edadR','$sexoR','$menuR','$desGeneral','$calleR','$localidadR','$municipioR','$fechaR','$imagenAux');";
						break;
				case ($TELaux == 0) and ($EMAILaux == 1):// Telefoni No -- Email Si
						$sqlDatos="INSERT INTO reportecivico (nombrec,apellidosc,edadc,sexoc,emailc,tiporeporte,reporte,callec,localidadc,municipioc,fechaobservada,imagenc) VALUES('$nombreR','$apellidosR','$edadR','$sexoR','$emailR','$menuR','$desGeneral','$calleR','$localidadR','$municipioR','$fechaR','$imagenAux');";
						break;
				case ($TELaux == 1) and ($EMAILaux == 0):// Telefoni Si -- Email No
						$sqlDatos="INSERT INTO reportecivico (nombrec,apellidosc,edadc,sexoc,telc,tiporeporte,reporte,callec,localidadc,municipioc,fechaobservada,imagenc) VALUES('$nombreR','$apellidosR','$edadR','$sexoR','$telR','$menuR','$desGeneral','$calleR','$localidadR','$municipioR','$fechaR','$imagenAux');";
						break;
				default: 
			    		echo 'Algo salio mal'; 
			  			break;	
			}

		$ConsulRegistro = mysqli_query($con,$sqlDatos,MYSQLI_USE_RESULT) or die("Error al acceder a la base de datos".mysqli_error());

		$sqlImagen="SELECT * FROM reportecivico WHERE nombrec='$nombreR' AND apellidosc='$apellidosR' AND edadc='$edadR';";
		$ConsultaImg = mysqli_query($con,$sqlImagen) or die("Error al cargar imagen ID kha".mysqli_error());
		$rowImg =  mysqli_fetch_array($ConsultaImg);
		

		$sqlID="SELECT MAX(idcivico) as ID FROM reportecivico;";
		$ConsultaID = mysqli_query($con,$sqlID) or die(mysqli_error());
		$idO = mysqli_fetch_array($ConsultaID);
		$IDMax = htmlspecialchars($idO["ID"]);

		

	} else
	{
		$IDMax="S/Datos";
		$menuR="S/Datos";
		$desGeneral="S/Datos";
		$nombreIma="S/Datos";
		$fechaR="S/Datos";
		$calleR="S/Datos";
		$localidadR="S/Datos";
		$municipioR="S/Datos";
		$nombreR="S/Datos";
		$apellidosR="S/Datos";
		$edadR="S/Datos";
		$sexoR="S/Datos";
		$telR="S/Datos";
		$emailR="S/Datos";

	}
		
		mysqli_close($con);

	?>
</head>
<body>
	<table width="100%" border="1" class="Texto1" align="center">
		<tr height="160" style="background-color: #024959;">
			<td style="width: 25%" align="center" class="Logo"><img src="./image/logoG.png" width="120"></td>
			<td align="center" colspan="2" ><h1 class="titulo1">L A S &nbsp; V I G A S<br>G U E R R E R O</h1></td>
			<td style="width: 25%" align="center" class="Logo1"><img src="./image/logo.png" width="140"></a></td>		
		</tr>
	</table>
	<table border="1" width="100%">
		<tr>
			<td colspan="4" height="20" align="center">
				<h3>"Registro de reporte cívico"</h3>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="right">
				<b>No. de reporte:</b>
			</td>
			<td colspan="1">
				<center><?php echo $IDMax; ?></center>
			</td>
		</tr>
		<tr>
			<td style="width: 20%">
				<b>Tipo de reporte:</b>
			</td>
			<td style="width: 20%">
				<?php echo $menuR; ?>
			</td>
			<td style="width: 30%">
				<b>A partir cuando se observó el problema</b>
			</td>
			<td>
				<center><?php echo $fechaR; ?></center>
			</td>
		</tr>
		<tr>
			<td>
				<b>Descripción:</b>
			</td>
			<td colspan="3">
				<?php echo $desGeneral; ?>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<center><img height="240" src="data:image/jpg;base64,<?php echo base64_encode($rowImg["imagenc"]); ?>"></center>
			</td>
		</tr>
		<tr>
			<td>
				<b>Calle:</b>
			</td>
			<td>
				<?php echo $calleR; ?>
			</td>
			<td>
				<b>Localidad: </b><?php echo $localidadR; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Municipio:</b>
			</td>
			<td colspan="3">
				<?php echo $municipioR; ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" height="8" align="center">
				<b>Ciudadano</b>
			</td>
		</tr>
		<tr>
			<td width="15%">
				<b>Nombre:</b>
			</td>
			<td >
				<?php echo $nombreR; echo " ".$apellidosR; ?>
			</td>
			<td width="15%">
				<b>Sexo: </b><?php echo $sexoR; ?>
			</td>
		</tr>
		<tr>
			<td >
				<b>Edad:</b>
			</td>
			<td >
				<?php echo $edadR; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>e-mail:</b>
			</td>
			<td>
				<?php echo $emailRaux; ?>
			</td>
			<td>
				<b>Telefono: </b><?php echo $telRaux; ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
				<input type="button" value="Imprimir registro" onclick="window.print()">
			</td>
		</tr>
		<tr>
			<td align="center" colspan="4" height="35" bgcolor="024959">
				<a href="javascript:cerrar();" style="text-decoration: none; color: #fff; background-color: #024959;"> Inicio </a>
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
