<?php 

function getfiltro(array $Objec)
{
	
	$Salida=array();
	
	foreach ($Objec as $elem)
		array_push($Salida, $elem->Id);
	
	return $Salida;
}

class FiltroElem
{
	
	public $Id =0; 
	public $Valor ="Unvalued"; 
	public $AsumeNum =false; 
	
	
    public function __construct($id, $valor, $asumeNum ){
        $this->Id = $id;
		$this->Valor=$valor;
		$this->AsumeNum=$asumeNum;
    }
    

}

class FiltroArray
{
	public $FiltroA =array(); 
	
	
    public function __construct(array $filtroA ){
        $this->FiltroA = $filtroA;
    }
    
	
	public function findElem($valueID)
	{
	foreach ($this->FiltroA as $elem)
		if ($elem->Id==$valueID)
			return $elem->Valor;
			
	return "Unvalued"; 
	}
	
	public function isNumeric($valueID)
	{
	foreach ($this->FiltroA as $elem)
		if ($elem->Id==$valueID)
			return $elem->AsumeNum;
			
	return false; 
	}
	
}



$FiltroP= array(new FiltroElem(0,"Tipo",false),new FiltroElem(56347,"Género",false),new FiltroElem(56491,"Impresor",false),new FiltroElem(56492,"Lugar de impresión",false),new FiltroElem(56497,"Materia",false),new FiltroElem(56525,"Tipo de documento",false),new FiltroElem(56490,"Fecha de publicación",false));

$FiltroObject=new FiltroArray($FiltroP);

$Filtro=getfiltro($FiltroObject->FiltroA);

?>