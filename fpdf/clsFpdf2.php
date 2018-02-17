<?php
	session_start();
	date_default_timezone_set("America/Caracas");
	require_once("fpdf.php");
	class clsFpdf extends FPDF{
		//Cabecera de página
		public function Header(){
			//Logo
			$this->Image('../../../img/logo.gobierno.jpg',3,3,270,20);
			$this->SetY(30);			
			//Fecha
			$this->SetFont("Arial","B",12);
			//$this->Cell(0,6,utf8_decode("República Bolivariana de Venezuela"),0,1,"C");
			//$this->Cell(0,6,utf8_decode("Ministerio del Poder Popular para la Agricultura y Tierra"),0,1,"C");
			//$this->Cell(0,6,"Agropatria",0,1,"C");
			//$this->Cell(0,6,"Acarigua - Estado Portuguesa",0,1,"C");
			
			$this->ln(5);
		}

		//Pie de página
		public function Footer(){
			//Posición: a 3 cm del final
			$this->SetY(-25);
			//Arial italic 6
			$this->SetFont("Arial","I",9);
			$lcFecha=@date("d/m/Y");
			$lcHora =@date('g:i:s A');
			$this->Cell(0,4,"","B",1,"C");
			$this->Cell(0,4,utf8_decode("Imprimido Por: ".$_SESSION["userActivo"]." a las: ".$lcHora." el día: ".$lcFecha),0,1,"C");
			$this->Cell(0,4,utf8_decode(" Av. circunvalación Sur Vía payara Agropatria Agencia Acarigua I S.A."),0,1,"C");
			$this->Cell(0,4,utf8_decode("Teléfono: 0414-1234567"),0,1,"C");
			//Número de página
			$this->Cell(0,4,utf8_decode("Página").$this->PageNo()."/{nb}",0,1,"C");
            $this->Cell(0,3,$this->obtenToken(7),0,1,"C");
					
		}
        private function obtenCaracterAleatorio($arreglo) {
            $clave_aleatoria = array_rand($arreglo, 1);	//obtén clave aleatoria
            return $arreglo[ $clave_aleatoria ];	//devolver ítem aleatorio
        }

        private function obtenCaracterMd5($car) {
            $md5Car = md5($car.Time());	//Codificar el carácter y el tiempo POSIX (timestamp) en md5
            $arrCar = str_split(strtoupper($md5Car));	//Convertir a array el md5
            $carToken = $this->obtenCaracterAleatorio($arrCar);	//obtén un ítem aleatoriamente
            return $carToken;
        }

        private function obtenToken($longitud) {
            //crear alfabeto
            $mayus = "ABCDEFGHIJKMNPQRSTUVWXYZ";
            $mayusculas = str_split($mayus);	//Convertir a array
            //crear array de numeros 0-9
            $numeros = range(0,9);
            //revolver arrays
            shuffle($mayusculas);
            shuffle($numeros);
            //Unir arrays
            $arregloTotal = array_merge($mayusculas,$numeros);
            $newToken = "";
            for($i=0;$i<=$longitud;$i++) {
                $miCar = $this->obtenCaracterAleatorio($arregloTotal);
                $newToken .= $this->obtenCaracterMd5($miCar);
            }
            return $newToken;
        }
        
	}
?>
