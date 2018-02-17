<?php
	session_start();
	date_default_timezone_set("America/Caracas");
	require_once("fpdf.php");

	class clsFpdf extends FPDF{
		//Cabecera de página
		public function Header(){
			//Logo
			$this->Image('../image/logop.jpg',3,3,25,25);
			$this->SetY(15);			
			$this->SetX(30);			
			//Fecha
			$this->SetFont("Arial","B",10);
			$this->Cell(1,5,utf8_decode("ASOCIACIÓN DE EMPLEADOS MUNICIPALES DE PASTAZA"),0,1,"L");
			$this->SetX(30);			
			$this->SetFont("Arial","",8);
			//$this->Cell(1,5,utf8_decode("RIF: J-4015085181"),0,1,"L");
						
			$this->SetY(15);			
			$this->SetX(-25);			
			$this->SetFont("Arial","",10);
			$this->Cell(1,5,"Fecha: ".date("d/m/Y"),0,1,"R");
			
			$this->ln(8);
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
			//$this->Cell(0,4,utf8_decode("Avenida Circunvalación Sur, diagonal a la Cruz Roja, dentro de las instalaciones de la U.P.T.P. Acarigua, Estado Portuguesa."),0,1,"C");
			//$this->Cell(0,4,utf8_decode("Teléfono: 0255-6144078"),0,1,"C");
			//Número de página
			$this->Cell(0,4,utf8_decode("Página").$this->PageNo()."/{nb}",0,1,"R");
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
