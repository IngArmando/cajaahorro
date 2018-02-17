<?php 
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class Recuperar extends CModeloDatos  {
     private $IdUser;
     private $User;
     private $Pass;
     private $Preg;
     private $Resp;
     private $DifAnt;

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {
        parent::__construct();
        $this->IdUser = "";
        $this->User   = "";
        $this->Pass   = "";
        $this->Preg   = "";
        $this->Resp   = "";
        $this->DifAnt = "";
    }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdUser ( $valor ){  $this->IdUser = $valor;   }
    public function setUser   ( $valor ){  $this->User   = $valor;   }
    public function setPass   ( $valor ){  $this->Pass   = $valor;   }
    public function setPreg   ( $valor ){  $this->Preg   = $valor;   }
    public function setResp   ( $valor ){  $this->Resp   = $valor;   }
    public function setDifAnt ( $valor ){  $this->DifAnt = $valor;   }

//--------------------------------------------------------------------
//      Verificar usuario
//--------------------------------------------------------------------
    public function checkUser(){
        $consulta = $this->ejecutar("SELECT id_usuario AS iduser FROM cappiutep.t_usuario WHERE nombre = '$this->User'");
        $data = $this->getArreglo($consulta);
        return $data["iduser"];
    }


//--------------------------------------------------------------------
//       Lista las preguntas de seguridad de un usuario
//--------------------------------------------------------------------

    public function listarPreg(){
        $consulta = $this->ejecutar("SELECT * FROM cappiutep.t_usuario_pregunta WHERE id_usuario = '$this->IdUser'");
        while($data = $this->getArreglo($consulta))$datos[] = $data;
        return $datos;
    }
//--------------------------------------------------------------------
//       Compara las respuestas para ver si son correctas
//--------------------------------------------------------------------


    public function PregResp() {        
        $consulta = $this->ejecutar("SELECT * FROM cappiutep.t_usuario_pregunta WHERE pregunta = '$this->Preg' AND respuesta = '$this->Resp' and id_usuario=".$_SESSION['userTemp']." ");
        return $this->setNoTupla( $consulta);
    }

//--------------------------------------------------------------------
//       Registra nueva contraseña
//--------------------------------------------------------------------
	public function NuevoPass(){
		$this->ejecutar("UPDATE cappiutep.t_usuario_clave SET fecha_fin = CURRENT_DATE WHERE id_usuario = '$this->IdUser' AND fecha_fin IS NULL");
		return $this->ejecutar("INSERT INTO cappiutep.t_usuario_clave(id_usuario,clave,fecha_ini,fecha_fin) VALUES($this->IdUser,'$this->Pass',CURRENT_DATE,NULL)");
	}

//--------------------------------------------------------------------
//       Compara contraseñas con las anteriores
//--------------------------------------------------------------------
	public function AntePass(){
		$consulta=$this->ejecutar("SELECT clave FROM cappiutep.t_usuario_clave WHERE id_usuario = $this->IdUser LIMIT $this->DifAnt");
		$valida='SISA';
		while($data = $this->getArreglo($consulta))$datos[] = $data;
		foreach ($datos as $index => $Pswd) 
        {
            if($Pswd['clave']==$this->Pass)
            	$valida = 'NORSA';
        }
        return $valida;
	}

//--------------------------------------------------------------------
//       Convierte tuplas en arreglos
//--------------------------------------------------------------------
    public function setArreglo( $registro )
    {   return $this->getArreglo( $registro ); }

//--------------------------------------------------------------------
//       Contar filas en consulta
//--------------------------------------------------------------------
    public function setNoTupla( $registro )
    {   return $this->getNoTupla( $registro ); }   
    
}
//  Fin de la clase
?>

