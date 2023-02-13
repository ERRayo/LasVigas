<?php
	
	include('./fpdf/fpdf.php');

	class PDF extends FPDF
	{
		function Header()
		{

			$this->Image('./image/logo.png',14,4,30);
			$this->SetFont('Arial','B',15);
			$this->Cell(40);
			$this->Cell(150,25,utf8_decode('Reporte Cívico'),0,0,'L');
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