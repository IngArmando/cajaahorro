<?php 
	define("SEGUNDOS", 1);
    define("MINUTOS", 60 * SEGUNDOS);
    define("HORAS", 60 * MINUTOS);
    define("DIAS", 24 * HORAS);
    define("MESES", 30 * DIAS);
    if(isset($_GET["p"])) $vista = $_GET["p"];
    if(isset($_POST["evento"])) $operacion = $_POST["evento"];
    function base_url(){
		if (isset($_SERVER['HTTP_HOST'])){
			$base_url = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
			$base_url .= '://'. $_SERVER['HTTP_HOST'];
			$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
		}
		return $base_url;
	}
	function obtenerFechaHora(){
		date_default_timezone_set("America/Caracas");
		putenv('TZ=America/Caracas'); 
		$mes = array("-","enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
		$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

		$gisett=(int)date("w");
		$mesnum=(int)date("m");
		$hora = date(" H:i",time());

		$arreglo = array("diaLetra"=>$dia[$gisett],"mes"=>$mes[$mesnum],"hora"=>$hora);

		return $arreglo;
	}
	function obtenerModulo($nombreModulo){
		return in_array($nombreModulo, apache_get_modules());
	}
	function obtenerModulosApache(){
		return apache_get_modules();
	}

    function timeago($time) {
    	$time = strtotime($time);
        $delta = time() - $time;

        if ($delta < 1 * MINUTOS){
            return $delta == 1 ? "en este momento" : "hace " . $delta . " segundos ";
        }
        if ($delta < 2 * MINUTOS){
            return "hace un minuto";
        }
        if ($delta < 45 * MINUTOS){
            return "hace " . floor($delta / MINUTOS) . " minutos";
        }
        if ($delta < 90 * MINUTOS){
            return "hace una hora";
        }
        if ($delta < 24 * HORAS){
            return "hace " . floor($delta / HORAS) . " horas";
        }
        if ($delta < 48 * HORAS){
            return "ayer";
        }
        if ($delta < 30 * DIAS){
            return "hace " . floor($delta / DIAS) . " dias";
        }
        if ($delta < 12 * MESES){
            $MESES = floor($delta / DIAS / 30);
            return $MESES <= 1 ? "el mes pasado" : "hace " . $MESES . " meses";
        }
        else{
            $years = floor($delta / DIAS / 365);
            return $years <= 1 ? "el año pasado" : "hace " . $years . " años";
        }
    	return 0;
    }
?>