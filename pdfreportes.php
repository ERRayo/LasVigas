<?php
	
	include("plantilla3.php");
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

	

	$sql = "SELECT idcivico, nombrec, apellidosc, edadc,sexoc, IFNULL(telc,'S/DATOS') AS tel, IFNULL(emailc,'S/DATOS') AS email, tiporeporte, reporte, callec, localidadc, municipioc, fechaobservada, imagenc, fecharegistro FROM reportecivico ";
	$ConsultaRegis = mysqli_query($con,$sql) or die("Error al cargar");

	$pdf = new PDF();
	$pdf->AliasNbPages();
	
	
while ($Fila =  mysqli_fetch_array($ConsultaRegis) ) 
{


	$pic = 'data://text/plain;base64,' . base64_encode($Fila['imagenc']);
	// extract dimensions from image
	$info = getimagesize($pic);
	
	
	$pdf->AddPage();

	

	$pdf->Ln(10);
	$pdf->Cell(8);
	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(60);
	$pdf->Cell(35,6,'ID de registro: '.$Fila['idcivico'],0,0,'C',1);
	$pdf->Cell(70,6,'Fecha de registro: '.$Fila['fecharegistro'],0,0,'C',1);


	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->SetFillColor(102,121,177);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(68,6,utf8_decode('Reporte: '.$Fila['tiporeporte']),0,0,'L',1);
	$pdf->Cell(2);
	$pdf->Cell(95,6,utf8_decode('Fecha de observacion del problema: '.$Fila['fechaobservada']),0,0,'L',1);
	

	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->SetFillColor(102,121,177);
	$pdf->SetFont('Arial','',12);
	$pdf->Multicell(90,6,utf8_decode('Descripción: '.$Fila['reporte']),0,'L',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(55,6,utf8_decode('Calle: '.$Fila['callec']),0,0,'L',1);
	$pdf->Cell(55,6,utf8_decode('Localidad: '.$Fila['localidadc']),0,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Municipio: '.$Fila['municipioc']),0,0,'C',1);

	$pdf->Ln(10);
	$pdf->Cell(8);
	$pdf->Cell(165,6,utf8_decode('Ciudadano'),0,0,'C',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->SetFillColor(102,121,177);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(165,6,utf8_decode('Nombre: '.$Fila['nombrec'].' '.$Fila['apellidosc']),0,0,'L',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->SetFillColor(102,121,177);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(50,6,'Sexo: '.$Fila['sexoc'],0,0,'L',1);
	$pdf->Cell(20);
	$pdf->Cell(20,6,'Edad: '.$Fila['edadc'],0,0,'L',1);
	
	$pdf->Ln(8);
	$pdf->Cell(8);
	$pdf->Cell(50,6,'Telefno: '.$Fila['tel'],0,0,'L',1);
	$pdf->Cell(20);
	$pdf->Cell(95,6,'E-mail: '.$Fila['email'],0,0,'L',1);


	
	//------------------> imagen
	$pdf->Image($pic,65,130,80,80,'JPG'); 
	
}
	$pdf->Output();
?>