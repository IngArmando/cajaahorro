<?php require_once("token.php"); date_default_timezone_set("America/Caracas"); ?>
    <page_header>
        <table width="100%">
            <tr>
            </tr>
        </table>    
    
    </page_header>
    <page_footer>
        
        
        <table align="center">
            <tr>
               <td align="center"> 
                   <?php 
                        $fecha = getdate();
                        echo "Impreso por: ".strtoupper($_SESSION["userActivo"])."  ";
		                echo "El día: ".$fecha["mday"]."-".$fecha["mon"]."-".$fecha["year"]."  "; 
                        echo "a las: ".date("g:i:s A");
                   ?>
                </td>
            </tr>
            <tr>
                <td align="center"><barcode type="EAN13" value="<?php echo obtenToken(11); ?>" label="label" style="width:30mm; height:6mm; color: #770000; font-size: 4mm"></barcode></td>
            </tr>
            <tr>
                <td colspan="2" align="center"> [[page_cu]] De [[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
