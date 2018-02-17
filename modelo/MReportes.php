<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class Reporte extends CModeloDatos  {

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();

     }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function historial($id_socio,$desde,$hasta,$id_beneficio,$estatus)
    {
        if ($desde != '') 
        {
          $desde=" AND bs.fecha >= '$desde'";
        }

        if ($hasta != '') 
        {
          $hasta=" AND bs.fecha <= '$hasta'";
        }

        if ($id_beneficio != '') 
        {
          $id_beneficio=" AND bs.id_beneficio = $id_beneficio";
        }

        if ($estatus != '') 
        {
          $estatus=" AND bs.estatus = '$estatus'";
        }

      $datos=NULL;
      
      $consulta = $this->ejecutar("SELECT bs.*,b.nombre as tipo, per.*, bs.estatus AS solestatus
        FROM cappiutep.t_beneficio_solicitud as bs 
        inner join cappiutep.t_beneficio as b on b.id_beneficio = bs.id_beneficio 
        inner join cappiutep.t_persona_caja as pc on pc.id_persona_caja = bs.id_solicitante
        inner join cappiutep.t_persona as per on per.id_persona = pc.id_persona
        where bs.id_solicitante = $id_socio".$desde.$hasta.$id_beneficio.$estatus);
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;

    }

//--------------------------------------------------------------------
//       Reporte general de solicitudes
//--------------------------------------------------------------------

    public function reportesolicitudes($desde,$hasta,$id_beneficio,$estatus)
    {
        if ($desde != '') 
        {
          $desde=" WHERE bs.fecha >= '$desde'";
        }

        if ($hasta != '') 
        {
          $hasta=" AND bs.fecha <= '$hasta'";
        }

        if ($id_beneficio != '') 
        {
          $id_beneficio=" AND bs.id_beneficio = $id_beneficio";
        }

        if ($estatus != '') 
        {
          $estatus=" AND bs.estatus = '$estatus'";
        }

      $datos=NULL;
      
      $consulta = $this->ejecutar("SELECT bs.*,b.nombre as tipo, per.*, bs.estatus AS solestatus
        FROM cappiutep.t_beneficio_solicitud as bs 
        inner join cappiutep.t_beneficio as b on b.id_beneficio = bs.id_beneficio 
        inner join cappiutep.t_persona_caja as pc on pc.id_persona_caja = bs.id_solicitante
        inner join cappiutep.t_persona as per on per.id_persona = pc.id_persona".$desde.$hasta.$id_beneficio.$estatus."order by bs.id_beneficio_solicitud");
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;
    }

//--------------------------------------------------------------------
//       Mostrar monto total por tipo de prestamo
//--------------------------------------------------------------------

    public function mostrartotal($desde,$hasta,$id_beneficio,$estatus)
    {
        if ($desde != '') 
        {
          $desde=" WHERE bs.fecha >= '$desde' ";
        }

        if ($hasta != '') 
        {
          $hasta=" AND bs.fecha <= '$hasta' ";
        }      

      $datos=NULL;
      
      $consulta = $this->ejecutar("SELECT SUM(bs.monto) as total,b.nombre as tipo,COUNT(bs.monto) as cant
                                        FROM cappiutep.t_beneficio_solicitud as bs 
                                         RIGHT JOIN cappiutep.t_beneficio as b on b.id_beneficio = bs.id_beneficio 
                                        ".$desde.$hasta."
                                  GROUP BY tipo");
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;
    }

//--------------------------------------------------------------------
//       Mostrar monto total por status
//--------------------------------------------------------------------

    public function porestados($desde,$hasta,$id_beneficio,$estatus)
    {
        if ($desde != '') 
        {
          $desde=" WHERE bs.fecha >= '$desde' ";
        }

        if ($hasta != '') 
        {
          $hasta=" AND bs.fecha <= '$hasta' ";
        }      

      $datos=NULL;
      
      $consulta = $this->ejecutar("SELECT SUM(bs.monto) AS total,
                                        COUNT(bs.monto) AS cant, 
                                            bs.estatus AS estatus 
                                   FROM cappiutep.t_beneficio_solicitud AS bs ".$desde.$hasta."GROUP BY bs.estatus");
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;
    }
////".$desde.$hasta."
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