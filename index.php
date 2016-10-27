<?php include 'top.php'; ?>
<?php $LinkAtras=""; ?>
<?php include 'cabecera.php'; ?>

<?php include 'form_buscador.php'?>
	
<?php include 'listanegra.php'?>	

	

	
<?php 
	
	$Basica=$_POST["BarraBasica"];
	$Basica2=$_POST["Campo"];
	
	$TypeNumber=intval($Basica2);
	
	$Inside=$CamposArray->isinside($TypeNumber);
	
	$TypeNumber=$CamposArray->findElem($TypeNumber);
	

	$ArrayBasico=preg_split("/[\s,]+/",$Basica); 
	
	$BusquedaArray=array();
	
	$Busqueda1A=array();
	array_push($Busqueda1A,0);
	
	$Busqueda1= array("value"=>"Obra","type" => $Busqueda1A,"positive" => true, "and" =>false , "exacto"=>true) ;
	
	
	$Busqueda1B=array();
	array_push($Busqueda1B,0);
	
	$Busqueda2= array("value"=>"Autor","type" => $Busqueda1B,"positive" => true, "and" =>false , "exacto"=>true) ;
	
	
	$BusquedaStringLabel="";
	
	
	
	array_push($BusquedaArray,$Busqueda1);
	array_push($BusquedaArray,$Busqueda2);
	
	
/*	foreach ($ArrayBasico as $elem)
	{
		if (preg_match("/^\".+\"$/",$elem))
		{
			$elem=str_replace("\"","",$elem);
			$incluseList=true;
		}
		
		if (!empty($elem)&&($incluseList||!listanegra($elem)))
		{
			
			if (!empty($BusquedaStringLabel))
				$BusquedaStringLabel=$BusquedaStringLabel."AND ";
			
			
			$BusquedaStringLabel=$BusquedaStringLabel.$elem." ";
			
			$elemE=$elem;
				
			if ($Inside)
				$elemE="*".$elem."*";
			
			$Busqueda= array("value"=>$elemE,"type" => $TypeNumber,"positive" => true, "and" =>true , "exacto"=>true) ;
			array_push($BusquedaArray,$Busqueda);
			
		}
	}*/
	
	/*var_dump($BusquedaArray);*/
	
	/*$Busqueda= array("type" => $TypeNumber,"positive" => true, "and" =>false) ;
	$BusquedaArray=array($Basica => $Busqueda);*/
	
	include 'buscar_codigo_general_intro.php';
	
	
	?>