<?php
	
	include("plantilla2.php");
	//include("fpdf/fpdf.php");
	
	include("Conexion.php");
	$con=conectar();
	session_start();

	$id_siniestro=$_POST["id_victima"];

	$sql = "SELECT 
C.id_victima, C.nombrev, C.apellidosv, C.sexo, C.edadv, C.caracteristicasv, C.FechaRegistro, 
E.tiposiniestro, E.calles, E.localidads, E.municipios, E.descripcionsiniestro,
IFNULL(O.nombredenu, 'S/DATOS') AS NombreD, IFNULL(O.apellidosdenu, 'S/DATOS') AS ApellidosD, IFNULL(O.telefonodenu, 'S/DATOS') AS TelD, IFNULL(O.emaildenu, 'S/DATOS') AS EmailD
FROM datosvictimas C 
LEFT JOIN datossiniestro E ON C.id_victima = E.id_victima 
LEFT JOIN datosdenunciante O ON C.id_victima = O.id_victima
WHERE C.id_victima ='$id_siniestro'";

	$ConsultaRegis = mysqli_query($con,$sql) or die("Error al imprimir");
	$Fila =  mysqli_fetch_array($ConsultaRegis);


	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->Ln(14);
	$pdf->Cell(68);
	$pdf->SetFont('Arial','',11);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(35,6,'ID de registro: '.$Fila['id_victima'],0,0,'L',1);
	$pdf->Cell(2);
	$pdf->Cell(75,6,'Fecha de registro: '.$Fila['FechaRegistro'],0,0,'L',1);
	
	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(160,6,'Datos victima',0,0,'C',1);
	
	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(104,6,utf8_decode('Nombre: '.$Fila['nombrev'].' '.$Fila['apellidosv']),0,0,'L',1);
	$pdf->Cell(3);
	$pdf->Cell(20,6,'Edad: '.$Fila['edadv'],0,0,'L',1);
	$pdf->Cell(3);
	$pdf->Cell(30,6,'Sexo: '.$Fila['sexo'],0,0,'L',1);

	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->Multicell(160,6,utf8_decode('Caracteristicas: '.$Fila['caracteristicasv']),0,1,'J',1);

	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(160,6,'Datos del siniestro',0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(80,6,'Tipo de siniestro: '.$Fila['tiposiniestro'],0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(50,6,utf8_decode('Calle: '.$Fila['calles']),0,0,'L',1);
	$pdf->Cell(5);
	$pdf->Cell(50,6,utf8_decode('Localidad: '.$Fila['localidads']),0,0,'L',1);
	$pdf->Cell(5);
	$pdf->Cell(50,6,utf8_decode('Municipio: '.$Fila['municipios']),0,0,'L',1);

	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->Multicell(160,6,utf8_decode('Descipcci??n: '.$Fila['descripcionsiniestro']),0,1,'J',1);

	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(160,6,'Datos del denunciante',0,0,'C',1);

	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',11);
	$pdf->SetFillColor(102,121,177);
	$pdf->Cell(90,6,'Nombre: '.$Fila['NombreD'].' '.$Fila['ApellidosD'],0,0,'L',1);
	
	$pdf->Ln(8);
	$pdf->Cell(20);
	$pdf->Cell(40,6,'Tel: '.$Fila['TelD'],0,0,'L',1);
	$pdf->Cell(30);
	$pdf->Cell(90,6,'E-mail: '.$Fila['EmailD'],0,0,'L',1);


	$pdf->Output();
?>