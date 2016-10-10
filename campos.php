<?php
class CampoElem
{
	
	public $Numer =0; 
	public $Id =array(); 
	public $Valor ="Unvalued";
	public $inside =false;
	
	
  /*  public function __construct($numer,array $id, $valor){
        $this->Id = $id;
		$this->Valor=$valor;
		$this->Numer=$numer;
		$this->inside=false;
    }*/
    
	public function __construct($numer,array $id, $valor, $inside){
        $this->Id = $id;
		$this->Valor=$valor;
		$this->Numer=$numer;
		$this->inside=$inside;
    }

}

class CampoArray
{
	public $CampoA =array(); 
	
	
    public function __construct(array $campoA ){
        $this->CampoA = $campoA;
    }
    
	
	public function findElem($numerID)
	{
	foreach ($this->CampoA as $elem)
		foreach ($elem as $elemV)
			if ($elemV->Numer==$numerID)
				return $elemV->Id;
	
	$SalidaVacia=array($numerID);
	return $SalidaVacia; 
	}
	
	public function isinside($numerID)
	{
	foreach ($this->CampoA as $elem)
		foreach ($elem as $elemV)
			if ($elemV->Numer==$numerID)
				return $elemV->inside;
			
	return false; 
	}
	
	
	
}

	$Grupo0=array(new CampoElem(0,array(0),"Todos",false));

	$Grupo1=array(
	new CampoElem(1,array(-1,56330,56334),"Nombre",false),
	new CampoElem(2,array(56468),"Función",false),
	new CampoElem(3,array(56348),"Exilio",false),
	new CampoElem(4,array(56339),"Fecha de nacimiento",true),
	new CampoElem(5,array(56340),"Fecha de muerte",true),
	new CampoElem(6,array(56347),"Género",false));
	
	$Grupo2=array(
	new CampoElem(7,array(-2,56473,56486,56521),"Titulo",false),
	new CampoElem(8,array(56488,56492,56491,56490),"Datos de Publicación",false),
	new CampoElem(9,array(56497,56502,56504,56508,56510),"Materia",false),
	new CampoElem(10,array(-3,56521),"Colección o serie",false),
	new CampoElem(11,array(56549,56550,56551,56553,56554),"Otros Campos",false)
	);
	
	$CamposArrayA=array(0 => $Grupo0,"Autor" =>$Grupo1,"Obra" => $Grupo2);
	
	$CamposArray=new CampoArray($CamposArrayA);

?>