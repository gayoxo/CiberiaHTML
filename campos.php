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
	new CampoElem(1,array(-1,32888),"Nombre",false),
	new CampoElem(2,array(32896),"Sexo",false),
	new CampoElem(3,array(32897),"Nacionalidad",false));
	
	$Grupo2=array(
	new CampoElem(7,array(-2,32957),"Título",false),
	new CampoElem(8,array(32958),"Autor",false),
	new CampoElem(8,array(32750),"Año",false),
	new CampoElem(9,array(33445),"Género",false),
	new CampoElem(10,array(33449),"Recursos estilísticos",false),
	new CampoElem(11,array(33451),"Tema",false),
	new CampoElem(11,array(33453),"Formatos",false)
	);
	
	$CamposArrayA=array(0 => $Grupo0,"Autor" =>$Grupo1,"Obra" => $Grupo2);
	
	$CamposArray=new CampoArray($CamposArrayA);

?>