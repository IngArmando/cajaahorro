<?php
	$reporte = $_GET["reporte"];

    // obtener el HTML
    ob_start();
    //include('../'.$reporte.'/'.$reporte.'.php');
    include($_GET["pdf"].".php");
    $content = ob_get_clean();

    // convierte en PDF
    require_once(dirname(__FILE__).'/html2pdf.class.php');
    try{
        $html2pdf = new HTML2PDF('L', 'letter', 'es');
		//$html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($reporte.'.pdf','I');
    }catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
