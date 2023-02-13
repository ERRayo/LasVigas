<?php
	
	include("./plantilla.php");
	//include("fpdf/fpdf.php");
	
	include("Conexion.php");
	$con=conectar();

	session_start();

		if (isset($_SESSION["u_usuario"])) 
		{
			$datoU=$_SESSION['u_usuario'];
		}
		else{
			echo"<script type=\"text/javascript\">alert('Es necesario iniciar sesion para aceder a esta pagina'); window.location='SesionAdmin.php';</script>";
		}
	


	$pdf = new PDF();
	$pdf->AliasNbPages();
	
	
	$sql = "SELECT * FROM datosafectado";
	$ConsultaRegis = mysqli_query($con,$sql) or die("Error al cargar");
	

	$sqlDatos = "SELECT * FROM danosafectados";
	$ConsultaRegisDatos = mysqli_query($con,$sqlDatos) or die("Error al cargar");
	
	//--------------------------------------------------------------------------
	$sql = "SELECT * FROM datosafectado";
	$ConsultaRegis = mysqli_query($con,$sql) or die("Error al cargar");
	$num_registros= mysqli_num_rows($ConsultaRegis);

	$sqlEdad = "SELECT SUM(edada) AS edad FROM datosafectado";
	$ConsultaEdad = mysqli_query($con,$sqlEdad) or die("Error al cargar");
	$ResuEdad= mysqli_fetch_array($ConsultaEdad);

	$sqlHombre = "SELECT * FROM datosafectado WHERE sexoa = 'Hombre'";
	$ConsulHombre = mysqli_query($con,$sqlHombre) or die("Error al cargar");
	$ResultadoConsulta= mysqli_num_rows($ConsulHombre);

	$sqlMujer = "SELECT * FROM datosafectado WHERE sexoa = 'Mujer'";
	$ConsulMujer = mysqli_query($con,$sqlMujer) or die("Error al cargar");
	$ResultadoConsulta2= mysqli_num_rows($ConsulMujer);

	

	
	///---------------------------------------

	$num_registros= mysqli_num_rows($ConsultaRegis);//<---- numero total de

	//--------------------------------------------------------------------------
	$TotalRegistros=$num_registros;

	$FechaAc=getdate();

	$TotalH=$ResultadoConsulta;
	$TotalM=$ResultadoConsulta2;

	$Porc=$TotalRegistros/$TotalH;
	$Porc=100/$Porc;

	if(empty($TotalM))
	{
		$TotalM = 0;
		$PorcM = 0;

	} 

	if(!empty($TotalM))
	{

		$PorcM=$TotalRegistros/$TotalM;
		$PorcM=100/$PorcM;

	}

	
	//------------- Edad
	$ResuEdadAux = $ResuEdad["edad"];
	$ResuEdadAux = ceil($ResuEdadAux/$TotalRegistros);
	//------------- Estufa
	
	
	$EstufaS=0;
	$Lavadora=0;
	$Refrigerador=0;
	$Boiler=0;
	$Television=0;
	$HornoMicro=0;
	$Comedor=0;
	$Sala=0;
	$General=0;
	$Total=0;

	$sqlDatos2 = "SELECT * FROM danosafectados";
	$ConsultaRegisDatos2 = mysqli_query($con,$sqlDatos2) or die("Error al cargar");
	while ($DatosDanos = mysqli_fetch_array($ConsultaRegisDatos2)) 
	{
		$EstufaS += $DatosDanos['estufa'];
		$Lavadora += $DatosDanos['lavadora'];
		$Refrigerador += $DatosDanos['refrigerador'];
		$Boiler += $DatosDanos['boiler'];
		$Television += $DatosDanos['television'];
		$HornoMicro += $DatosDanos['hornomicro'];
		$Comedor += $DatosDanos['comedor'];
		$Sala += $DatosDanos['sala'];
		$General += $DatosDanos['otrasperdidastotal'];
		$Total += $DatosDanos['total'];
	}

	$EstufaS1 = $EstufaS/$TotalRegistros;
	$Lavadora1 = $Lavadora/$TotalRegistros;
	$Refrigerador1 = $Refrigerador/$TotalRegistros;
	$Boiler1 = $Boiler/$TotalRegistros;
	$Television1 = $Television/$TotalRegistros;
	$HornoMicro1 = $HornoMicro/$TotalRegistros;
	$Comedor1 = $Comedor/$TotalRegistros;
	$Sala1 = $Sala/$TotalRegistros;
	$General1 = $General/$TotalRegistros;
	$Total1 = $Total/$TotalRegistros;


	//--------------------------------------------------------------------------

	$pdf->AddPage();
	$pdf->Ln(25);
	$pdf->Cell(25);
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(70,6,'Total de registros: '.$TotalRegistros,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Fecha: '.$FechaAc['mday'].'-'.$FechaAc['mon'].'-'.$FechaAc['year'],0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Registros realizados por: ',0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Hombres: '.$TotalH.' -- %'.round($Porc,2),0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Mujeres: '.$TotalM.' -- %'.round($PorcM,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,utf8_decode('Promedio de edad: '.$ResuEdadAux.' años'),0,0,'C',1);
	$pdf->Cell(8);
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(8);
	
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Estufa - Total: $'.$EstufaS,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($EstufaS1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Lavadora - Total: $'.$Lavadora,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($Lavadora1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Refrigerador - Total: $'.$Refrigerador,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($Refrigerador1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Boiler - Total: $'.$Boiler,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($Boiler1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Television - Total: $'.$Television,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($Television1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Horno de microndas - Total: $'.$HornoMicro,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($HornoMicro1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Comedor - Total: $'.$Comedor,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($Comedor1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Sala - Total: $'.$Sala,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($Sala1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Otras perdidas - Total: $'.$General,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($General1,2),0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(25);
	$pdf->Cell(70,6,'Total: $'.$Total,0,0,'C',1);
	$pdf->Cell(8);
	$pdf->Cell(60,6,'Promedio: $'.round($Total1,2),0,0,'C',1);


	$Contador=0;

	while ($Fila =  mysqli_fetch_array($ConsultaRegis) and $FilaD =  mysqli_fetch_array($ConsultaRegisDatos)) 
	{

	$pic = 'data://text/plain;base64,' . base64_encode($FilaD['image']);
	// extract dimensions from image
	$info = getimagesize($pic);

	$pdf->AddPage();

	$pdf->Ln(10);
	$pdf->Cell(8);
	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(60);
	$pdf->Cell(35,6,'ID de registro: '.$Fila['id_afectado'],0,0,'C',1);
	$pdf->Cell(70,6,'Fecha de registro: '.$Fila['FechaRegistro'],0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->SetFillColor(102,121,177);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(165,6,utf8_decode('Nombre: '.$Fila['nombrea'].' '.$Fila['apellidosa']),0,0,'C',1);
	

	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->SetFillColor(102,121,177);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(45,6,'Sexo: '.$Fila['sexoa'],0,0,'C',1);
	$pdf->Cell(25);
	$pdf->Cell(20,6,'Edad: '.$Fila['edada'],0,0,'C',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(55,6,utf8_decode('Calle: '.$Fila['callea']),0,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Localidad: '.$Fila['localidada']),0,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Municipio: '.$Fila['municipioa']),0,0,'C',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Telefno: '.$Fila['telefonoa'],0,0,'C',1);
	$pdf->Cell(20);
	$pdf->Cell(95,6,'E-mail: '.$Fila['emaila'],0,0,'C',1);
	
	$pdf->Ln(10);
	$pdf->Cell(8);
	$pdf->Cell(165,6,utf8_decode('Daños registrados por desastre natural'),0,0,'C',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(55,6,'Tipo de desastre: '.$FilaD['tipodesastre'],0,0,'C',1);
	$pdf->Cell(55,6,'Lugar del desatre: '.$FilaD['lugardesastre'],0,0,'C',1);
	$pdf->Cell(55,6,'Tipo de pedida: '.$FilaD['tipoperdida'],0,0,'C',1);

	$pdf->Image($pic,65,190,80,80,'JPG'); 
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Estufa: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['estufa'],0,0,'',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Lavadora: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['lavadora'],0,0,'',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Refrigerador: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['refrigerador'],0,0,'',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Boiler: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['boiler'],0,0,'',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Television: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['television'],0,0,'',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Horno de microndas: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['hornomicro'],0,0,'',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Comedor: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['comedor'],0,0,'',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Sala: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['sala'],0,0,'',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Otras perdidas: ',0,0,'C',1);
	$pdf->Multicell(60,6,utf8_decode($FilaD['otrasperdidas']),0,1,'J',1);
	
	$pdf->Ln(1);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Sub-Total de otras perdidas: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['otrasperdidastotal'],0,0,'',1);	
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Total: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['total'],0,0,'',1);

	}
 	
	$pdf->Output();
?>