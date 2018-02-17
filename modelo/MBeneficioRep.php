<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class Beneficio extends CModeloDatos  {

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();

     }

    public function buscarSolicitud($id){
        $consulta = $this->consulta("SELECT bs.*,b.nombre as tipo, per.*, pc.fecha_ini as fechaafi, progra.nombre_largo as programa
        FROM cappiutep.t_beneficio_solicitud as bs 
        inner join cappiutep.t_beneficio as b on b.id_beneficio = bs.id_beneficio 
        inner join cappiutep.t_persona_caja as pc on pc.id_persona_caja = bs.id_solicitante
        inner join cappiutep.t_persona as per on per.id_persona = pc.id_persona
        left join cappiutep.t_lista_valor as progra on progra.id_lista_valor = bs.id_programa
        where bs.id_beneficio_solicitud=$id");
        return $this->getArreglo($consulta);
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