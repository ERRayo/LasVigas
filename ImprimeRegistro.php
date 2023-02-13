<html>
<head>
	<title>Imprimir</title>
	<link rel="shortcut icon" href="image/iconoTitle2.png">
	<link rel="stylesheet" href="./css/estiloFormu.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="./css/estiloTexto.css">
	<?php
	include("Conexion.php");
	$con=conectar();

	$nombreR=$_POST["nombreR"];
	$apellidosR=$_POST["apellidosR"];
	$sexoR=$_POST['tipoSexo'];
	$edadR=$_POST["edadR"];
	$calleR=$_POST["calleR"];
	$coloniaR="S/datos";
	$localidadR=$_POST["localidadR"];
	$municipioR=$_POST["municipioR"];
	$telR=$_POST["telR"];
	$emailR=$_POST["emailR"];
	$menuR=$_POST["menuR"];
	$lugarR=$_POST["lugarR"];
	$tipoP=$_POST["tipoP"];
	$estufa=$_POST["estufa"];
	$lavadora=$_POST["lavadora"];
	$refrigerador=$_POST["refrigerador"];
	$boiler=$_POST["boiler"];
	$television=$_POST["television"];
	$hornoMicro=$_POST["hornoMicro"];
	$comedor=$_POST["comedor"];
	$sala=$_POST["sala"];
	$desGeneral=htmlspecialchars($_POST["desGeneral"]);
	$general=$_POST["general"];
	$total=$_POST["total"];

	$nombreIma=$_FILES["imagen"]["tmp_name"];
	

	$TELaux;
	$EMAILaux;

	if(empty($estufa))
	{
		$estufa=0;
	}
	if(empty($lavadora))
	{
		$lavadora=0;
	}
	if(empty($refrigerador))
	{
		$refrigerador=0;
	}
	if(empty($boiler))
	{
		$boiler=0;
	}
	if(empty($television))
	{
		$television=0;
	}
	if(empty($hornoMicro))
	{
		$hornoMicro=0;
	}
	if(empty($comedor))
	{
		$comedor=0;
	}
	if(empty($sala))
	{
		$sala=0;
	}
	if(empty($general))
	{
		$general=0;
		$desGeneral="S/Descripción";
	}
	if(empty($desGeneral))
	{
		
		$desGeneral="S/Descripción";
		$total=$total-$general;
		$general=0;
	}
	//---------------------------------------------
	if (!empty($telR)) // <= false
	{  
	    $TELaux=1;// No está vacía (true)
	} else {
	    $TELaux=0;// Está vacía (false)
	}
	if (!empty($emailR)) // <= false
	{ 
	    $EMAILaux=1;// No está vacía (true)
	} else {
	    $EMAILaux=0;// Está vacía (false)
	}

	if(!empty($nombreR))
	{
			switch (true) 
			{
				case ($TELaux == 1) and ($EMAILaux == 1):// Telefoni Si -- Email Si
						$sqlDatos="INSERT INTO datosafectado
						(nombrea,apellidosa,sexoa,edada,callea,localidada,municipioa,telefonoa,emaila)
						VALUES('$nombreR','$apellidosR','$sexoR','$edadR','$calleR','$localidadR','$municipioR','$telR','$emailR');";
						break;
				case ($TELaux == 0) and ($EMAILaux == 0):// Telefoni No -- Email No
						$sqlDatos="INSERT INTO datosafectado
						(nombrea,apellidosa,sexoa,edada,callea,localidada,municipioa)
						VALUES('$nombreR','$apellidosR','$sexoR','$edadR','$calleR','$localidadR','$municipioR');";
						break;
				case ($TELaux == 0) and ($EMAILaux == 1):// Telefoni No -- Email Si
						$sqlDatos="INSERT INTO datosafectado
						(nombrea,apellidosa,sexoa,edada,callea,localidada,municipioa,emaila)
						VALUES('$nombreR','$apellidosR','$sexoR','$edadR','$calleR','$localidadR','$municipioR','$emailR');";
						break;
				case ($TELaux == 1) and ($EMAILaux == 0):// Telefoni Si -- Email No
						$sqlDatos="INSERT INTO datosafectado
						(nombrea,apellidosa,sexoa,edada,callea,localidada,municipioa,telefonoa)
						VALUES('$nombreR','$apellidosR','$sexoR','$edadR','$calleR','$localidadR','$municipioR','$telR');";
						break;
				default: 
			    		echo 'Algo salio mal'; 
			  			break;	
			}

		$ConsulAfectado = mysqli_query($con,$sqlDatos,MYSQLI_USE_RESULT) or die("Error al acceder a la base de datos".mysqli_error());
		
		if($ConsulAfectado==true)
		{
			
			

			$imagenAux=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
			//echo "-->".$imagenAux;

			$sqlDanos="INSERT INTO danosafectados (tipoDesastre,lugarDesastre,tipoPerdida,estufa,lavadora,refrigerador,boiler,television,hornoMicro,comedor,sala,otrasPerdidas,otrasPerdidasTotal,total,image) VALUES('$menuR','$lugarR','$tipoP','$estufa','$lavadora','$refrigerador','$boiler','$television','$hornoMicro','$comedor','$sala','$desGeneral','$general','$total','$imagenAux');";
			

			$ConsultaDanos = mysqli_query($con,$sqlDanos,MYSQLI_USE_RESULT) or die("Error al ingresar datos a daños".mysqli_error());


			$sqlImagen="SELECT * FROM datosafectado WHERE nombrea='$nombreR' AND apellidosa='$apellidosR' AND edada='$edadR';";
			$ConsultaImg = mysqli_query($con,$sqlImagen) or die("Error al cargar imagen ID kha".mysqli_error());
			$rowImg =  mysqli_fetch_array($ConsultaImg);
			$imgID=$rowImg["id_afectado"];

			$sqlImg="SELECT image FROM danosafectados WHERE id_afectado='$imgID'";
			$ConsultaImgAux = mysqli_query($con,$sqlImg) or die("Error al cargar");
			$rowImgAux =  mysqli_fetch_array($ConsultaImgAux);

		}
		$sqlID="SELECT MAX(id_afectado) as ID FROM datosafectado;";
		$ConsultaID = mysqli_query($con,$sqlID) or die(mysqli_error());
		$idO = mysqli_fetch_array($ConsultaID);
		$IDMax = htmlspecialchars($idO["ID"]);
	} else {
		$imagenAux="sin dato";
		$IDMax="Sin datos";
		$nombreR="Sin datos";
		$apellidosR="";
		$sexoR="Sin datos";
		$edadR="Sin datos";
		$calleR="Sin datos";
		$coloniaR="Sin datos";
		$municipioR="Sin datos";
		$telR="Sin datos";
		$emailR="Sin datos";
		$menuR="Sin datos";
		$lugarR="Sin datos";
		$tipoP="Sin datos";
		$estufa="Sin datos";
		$lavadora="Sin datos";
		$refrigerador="Sin datos";
		$boiler="Sin datos";
		$television="Sin datos";
		$hornoMicro="Sin datos";
		$comedor="Sin dato";
		$sala="Sin datos";;
		$desGeneral="Sin datos";
		$general="Sin datos";
		$total="Sin datos"; //sin dato 
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
		<tr>
			<td colspan="4" height="20" align="center">
				<h3>"Afectaciones registradas por siniestro"</h3>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="right">
				<b>No. de registro de desastre natural:</b>
			</td>
			<td colspan="1">
				<?php echo $IDMax; ?>
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
				<b>Sexo:</b>
			</td>
			<td >
				<?php echo $sexoR; ?>
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
				<?php echo $emailR; ?>
			</td>
			<td>
				<b>Telefono:</b>
			</td>
			<td>
				<?php echo $telR; ?>
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
				<b>Localidad:</b>
			</td>
			<td>
				<?php echo $localidadR; ?>
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
			<td colspan="4" align="center">
				<b>Daños registrados</b>
			</td>
		</tr>
		<tr>
			<td>
				<b>Tipo de desastre:</b>
			</td>
			<td colspan="3">
				<?php echo $menuR; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Lugar:</b>
			</td>
			<td>
				<?php echo $lugarR; ?>
			</td>
			<td>
				<b>Tipo de perdida:</b>
			</td>
			<td>
				<?php echo $tipoP; ?>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<center><img height="240" src="data:image/jpg;base64,<?php echo base64_encode($rowImgAux["image"]); ?>"></center>
			</td>
		</tr>
		<tr>
			<td>
				<b>Estufa:</b>
			</td>
			<td>
				<?php echo $estufa; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Lavadora:</b>
			</td>
			<td>
				<?php echo $lavadora; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Refrigerador:</b>
			</td>
			<td>
				<?php echo $refrigerador; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Boiler:</b>
			</td>
			<td>
				<?php echo $boiler; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Television:</b>
			</td>
			<td>
				<?php echo $television; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Horno de microondas:</b>
			</td>
			<td>
				<?php echo $hornoMicro; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Comedor:</b>
			</td>
			<td>
				<?php echo $comedor; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Sala:</b>
			</td>
			<td>
				<?php echo $sala; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Otras perdidas:</b>
			</td>
			<td>
				<?php echo $desGeneral; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Total:</b>
			</td>
			<td>
				<?php echo $general; ?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Total en general:</b>
			</td>
			<td>
				<?php echo $total; ?>
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