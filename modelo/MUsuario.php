<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class Usuario extends CModeloDatos  {
     private $IdPersona;
     
     private $IdUser;
     private $Cargo;
     private $FechaIni;
     private $CondicionUser;


//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdPersona    = "";
       $this->IdUser       = "";
       $this->Cargo        = "";
       $this->FechaIni     = "";
       $this->CondicionUser= "";


     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdPersona    ( $valor ){  $this->IdPersona    = $valor;   }

    public function setIdUser       ( $valor ){  $this->IdUser       = $valor;   }
    public function setCargo        ( $valor ){  $this->Cargo        = $valor;   }
    public function setFechaIni     ( $valor ){  $this->FechaIni     = $valor;   }

//--------------------------------------------------------------------
//       Cambia el estatus de un usuario
//--------------------------------------------------------------------
    public function actualizarStatus($status)  
    {
        $sql="UPDATE cappiutep.t_usuario SET
                    estatus    = '$status'
              WHERE id_usuario =  $this->IdUser";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Reestablecer contraseña
//--------------------------------------------------------------------
    public function ResetPass($status)  
    {
        $sql="UPDATE cappiutep.t_usuario SET
                    estatus    = '$status'
              WHERE id_usuario =  $this->IdUser";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


  public function listar()  
  {

    $sql="SELECT a.*,b.*,a.estatus AS ustatus
              FROM
                 cappiutep.t_usuario AS a
                 INNER JOIN cappiutep.t_persona AS b ON a.id_persona=b.id_persona
                 ORDER BY ustatus ASC;";

    $MarcasSelect = array();
    $pos=0;   
    $MarcasSelect[$pos++] =" <table class='ui large celled center aligned table' id='Tabla'>";    
    $MarcasSelect[$pos++] =" <thead><tr>
                                <th >Usuario</th>
                                <th >Socio</th>
                                <th class='collapsing' >Estado</th>
                                <th class='collapsing' >Acciones</th>
                              </tr></thead>
                              <tbody>"; 
    
    $resulSet = $this->consulta( $sql ) ; 
    while($row= $this->getArreglo($resulSet))   
    {         
    
      switch ($row['ustatus']) {
        case '0'://Nuevo Usuario
          $status="<div class='ui gray horizontal fluid large label'> Nuevo </div>";
          $acciones='<div class="ui large buttons">
                        <button type="button"class="ui red icon button" data-content="Bloquear" data-variation="basic" onclick="enviar(this.value,'.$row['id_usuario'].')" value="Bloquear">
                          <i class="ban icon"></i>
                        </button>
                      </div>';
          break;
        case '1'://Usuario Activo
          $status="<div class='ui green horizontal fluid large label'> Activo </div>";
          $acciones='<div class="ui large buttons">
                        <button type="button" class="ui yellow icon button" data-content="Reestablecer" data-variation="basic" onclick="enviar(this.value,'.$row['id_usuario'].')" value="Reestablecer">
                          <i class="refresh icon"></i>
                        </button>
                        <button type="button"class="ui red icon button" data-content="Bloquear" data-variation="basic" onclick="enviar(this.value,'.$row['id_usuario'].')" value="Bloquear">
                          <i class="ban icon"></i>
                        </button>
                      </div>';
          break;
        case '8'://Usuario Reestablecido
          $status="<div class='ui orange horizontal fluid large label'> Reestablecido </div>";
          $acciones='<div class="ui large buttons">
                        <button type="button"class="ui red icon button" data-content="Bloquear" data-variation="basic" onclick="enviar(this.value,'.$row['id_usuario'].')" value="Bloquear">
                          <i class="ban icon"></i>
                        </button>
                      </div>';
          break;

        case '9'://Usuario Bloqueado
          $status="<div class='ui red horizontal fluid large label'> Bloqueado </div>";
          $acciones='<div class="ui large buttons">
                        <button type="button"class="ui yellow icon button" data-content="Reestablecer" data-variation="basic" onclick="enviar(this.value,'.$row['id_usuario'].')" value="Reestablecer">
                          <i class="refresh icon"></i>
                        </button>
                      </div>';
          break;


      }   

      $MarcasSelect[$pos++]="<tr>
                   <td>".$row['nombre']."</td>
                   <td>".$row['nombre1']." ".$row['apellido1']."</td>
                   <td>".$status."</td>
                   <td class='right aligned'>".$acciones."</td>
                  </tr>";
    }
    $MarcasSelect[$pos++]="</tbody></table>";
    return $MarcasSelect;
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