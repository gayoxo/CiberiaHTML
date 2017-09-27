<?php 

function getDescrip(array $Objec)
{
	
	$Salida=array();
	
	foreach ($Objec as $elem)
		array_push($Salida, $elem->Id);
	
	return $Salida;
}

class Desc
{
	
	public $Id =0; 
	public $Valor ="Unvalued"; 
	
	
    public function __construct($id, $valor){
        $this->Id = $id;
		$this->Valor=$valor;
    }
    

}

class DescArray
{
	public $DescA =array(); 
	
	
    public function __construct(array $descA ){
        $this->DescA = $descA;
    }
    
	
	public function findElem($valueID)
	{
	foreach ($this->DescA as $elem)
		if ($elem->Id==$valueID)
			return $elem->Valor;
			
	return "Unvalued"; 
	}
	
}



$DescP= array(
//new Desc(32959,"Resumen"),
//new Desc(33447,"Etiquetas"),
//new Desc(31013,"Obras"),
//new Desc(30995,"Participacion"),
//new Desc(25119,"Título"),
//new Desc(21809,"Relacion"),
//new Desc(30994,"Participantes"),
//new Desc(19749,"Editorial"),
new Desc(32959,"Resumen"));

$DescObject=new DescArray($DescP);

$Desc=getDescrip($DescObject->DescA);

?>