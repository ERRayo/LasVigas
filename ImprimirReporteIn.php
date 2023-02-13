<?php
	
	include("plantilla.php");
	//include("fpdf/fpdf.php");
	
	include("Conexion.php");
	$con=conectar();
	session_start();

	$id_afectadoR=$_POST["id_afectado"];

	$sql = "SELECT id_afectado, nombrea, apellidosa, sexoa, edada, callea, coloniaa, localidada, municipioa, IFNULL(telefonoa,'S/DATOS') AS tel, IFNULL(emaila,'S/DATOS') AS email, FechaRegistro FROM datosafectado WHERE id_afectado='$id_afectadoR'";
	$ConsultaRegis = mysqli_query($con,$sql) or die("Error al cargar");
	$Fila =  mysqli_fetch_array($ConsultaRegis);

	$sqlDatos = "SELECT * FROM danosafectados WHERE id_afectado='$id_afectadoR'";
	$ConsultaRegisDatos = mysqli_query($con,$sqlDatos) or die("Error al cargar");
	$FilaD =  mysqli_fetch_array($ConsultaRegisDatos);

	$sqlImg="SELECT image FROM danosafectados WHERE id_afectado='$id_afectadoR'";
	$ConsultaImgAux = mysqli_query($con,$sqlImg) or die("Error al cargar");
	$rowImgAux =  mysqli_fetch_array($ConsultaImgAux);
	
	
	$pic = 'data://text/plain;base64,' . base64_encode($rowImgAux['image']);
	// extract dimensions from image
	$info = getimagesize($pic);
	
	


	$pdf = new PDF();
	$pdf->AliasNbPages();
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
	$pdf->Cell(50,6,'Telefno: '.$Fila['tel'],0,0,'C',1);
	$pdf->Cell(20);
	$pdf->Cell(95,6,'E-mail: '.$Fila['email'],0,0,'C',1);
	
	$pdf->Ln(10);
	$pdf->Cell(8);
	$pdf->Cell(165,6,utf8_decode('Daños registrados por desastre natural'),0,0,'C',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(55,6,'Tipo de desastre: '.$FilaD['tipodesastre'],0,0,'C',1);
	$pdf->Cell(55,6,'Lugar del desatre: '.$FilaD['lugardesastre'],0,0,'C',1);
	$pdf->Cell(55,6,'Tipo de pedida: '.$FilaD['tipoperdida'],0,0,'C',1);

	//------------------> imagen
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
	$pdf->Multicell(60,6,utf8_decode($FilaD['otrasperdidas']),0,1,'R',1);
	
	$pdf->Ln(1);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Sub-Total de otras perdidas: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['otrasperdidastotal'],0,0,'',1);	
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Total: ',0,0,'C',1);
	$pdf->Cell(60,6,'$'.$FilaD['total'],0,0,'',1);
	

	$pdf->Output();
?>