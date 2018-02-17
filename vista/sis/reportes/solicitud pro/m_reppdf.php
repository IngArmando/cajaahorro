<?php
require('../fpdf/fpdf.php');
class PDF extends FPDF

	{
		//Cabecera de página
		function Header()
		{
 		//Logo
    		$this->Image('../image/logop2.png',10,8,40);
    		$this->Ln(20);

   		//Arial bold Italica 12
    		$this->SetFont('Arial','BI',14);

    		//Título
    		$this->Cell(0,1,'SOLICITUD DE PROGRAMA',0,1,'C');
    		$this->Ln(5);
    		//Arial Italica 10
    		$this->SetFont('Arial','BI',14);
    		$this->Cell(0,0,utf8_decode(''),0,0,'C');
			$this->Ln(5);

		//Fecha
			date_default_timezone_set("America/Caracas");
			$FechaActual=date("d/m/Y h:m a");
			$this->SetFont('Arial','I',8);
			
		}
		//Pie de página
		function Footer()
		{
		//Posición: a 1.5 cm del final
			$this->SetY(-15);		
		//Número de página
			$this->SetFont('Arial','',8);
			$this->Cell(0,4,'Página '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}
?>
