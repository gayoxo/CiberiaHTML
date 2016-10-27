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



$FiltroP= array(new FiltroElem(0,"Tipo",false),new FiltroElem(33443,"Idiomas",false),new FiltroElem(32750,"Año",false),new FiltroElem(33445,"Género",false),new FiltroElem(33449,"Recursos estilísticos",false),new FiltroElem(33451,"Tema",false),new FiltroElem(33453,"Formatos",false),new FiltroElem(33455,"Programas informáticos",false));

$FiltroObject=new FiltroArray($FiltroP);

$Filtro=getfiltro($FiltroObject->FiltroA);

?>