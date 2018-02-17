<?php
include_once("MPgsql.php");
class Combo extends CModeloDatos
{
	public function __construct()
	{
		parent::__construct();
	}
	public function gen_combo($sql,$id_campo,$des_campo,$sel_campo,$nom_var,$raiz)	
	{
		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] = "<select name='".$nom_var."' id='".$nom_var."'". $raiz .">";
		$MarcasSelect[$pos++] = "<option></option>";
		$resulSet = $this->consulta( $sql );
		while($row= $this->getArreglo($resulSet))
		{
			$rSetid_var=$row[$id_campo];
			$rSetdes_var=$row[$des_campo];
			$tag_select=' ';
			if($rSetid_var==$sel_campo)
			{
				$tag_select=' selected';
				}
				$MarcasSelect[$pos++]="<option value='".$rSetid_var."'".$tag_select.">".$rSetdes_var."</option>";
		}
		$MarcasSelect[$pos++]="</select>";
		return $MarcasSelect;
	}

	public function gen_combo2($sql,$id_campo,$des_campo,$sel_campo,$nom_var,$raiz)	
	{
		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] = "<select name='".$nom_var."' id='".$nom_var."'". $raiz .">";
		$MarcasSelect[$pos++] = "<option></option>";
		$resulSet = $this->consulta( $sql );
		while($row= $this->getArreglo($resulSet))
		{
			$rSetid_var=$row[$id_campo];
			$rSetdes_var=$row[$des_campo];
			$tag_select=' ';
			if($rSetid_var==$sel_campo)
			{
				$tag_select=' selected';
				}
				$MarcasSelect[$pos++]="<option value='".$rSetid_var."'".$tag_select.">".$rSetdes_var."</option>";
		}
		$MarcasSelect[$pos++]="<option value='T'>Todos</option></select>";
		return $MarcasSelect;
	}

	public function gen_combo_icon($sql,$id_campo,$des_campo,$sel_campo,$nom_var,$raiz)	
	{
		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] = "<div class='ui selection search dropdown'>
									<input type='hidden' name='".$nom_var."' id='".$nom_var."' value=".$sel_campo.">
									<i class='dropdown icon'></i>
									<div class='default text'> Seleccionar </div>
									<div class='menu'>";
		$resulSet = $this->consulta( $sql );
		while($row= $this->getArreglo($resulSet))
		{
			$rSetid_var=$row[$id_campo];
			$rSetdes_var=$row[$des_campo];
			$tag_select=' ';
			if($rSetid_var==$sel_campo)
			{
				$tag_select=' selected';
				}
				$MarcasSelect[$pos++]="<div class='item' data-value='".$rSetid_var."'><i class='".$rSetdes_var." icon'></i>".$rSetdes_var."</div>";
		}
		$MarcasSelect[$pos++]="</div></div>";
		return $MarcasSelect;
	}
	
	public function gen_combo_dependiente($sql,$id_campo,$des_campo,$sel_campo,$nom_var,$raiz,$chain)	
	{
		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] = "<select name='".$nom_var."' id='".$nom_var."'". $raiz .">";
		$MarcasSelect[$pos++] = "<option> </option>";
		$resulSet = $this->consulta( $sql );
		while($row= $this->getArreglo($resulSet))
		{
			$rSetid_var=$row[$id_campo];
			$rSetdes_var=$row[$des_campo];
			$rSetdep_var=$row[$chain];
			$tag_select=' ';
			if($rSetid_var==$sel_campo)
			{
				$tag_select=' selected';
				}
				$MarcasSelect[$pos++]="<option value='".$rSetid_var."'".$tag_select." class='".$rSetdep_var."'>".$rSetdes_var."</option>";
			}
			$MarcasSelect[$pos++]="</select>";
			return $MarcasSelect;
	}

}
?>
