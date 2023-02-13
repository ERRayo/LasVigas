<?php
	
	include('./fpdf/fpdf.php');

	class PDF extends FPDF
	{
		function Header()
		{

			$this->Image('./image/logo.png',14,4,30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(150,25,utf8_decode('Reporte de daños sufridos por desastre natural'),0,0,'C');
			$this->Ln(20);
		}

		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}
?>