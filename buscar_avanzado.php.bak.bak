<?php include 'top.php'; ?>
<?php $LinkAtras="index.php"; ?>
<?php include 'cabecera.php'; ?>
<?php include 'form_buscador.php'?>	
<?php 

	$Previa=$_POST["BarraBasica"];
	
	
	
	$Basica=$_POST["BarraBusqueda"];
	$Basica2=$_POST["Campo"];

	
	$Opciones=$_POST["Opciones"];
	
	//var_dump($Opciones);
	
	if (!isset($Basica)||empty($Basica))
		$Basica=array();
	
	if (!isset($Basica2)||empty($Basica2))
		$Basica2=array();
	
	
		
/*	var_dump($Basica);
	
	echo "</br>";
	
	var_dump($Basica2); 
	echo "</br>";
	*/
	
	$BusquedaArray=array();
	
	
	$BusquedaStringLabel="";
	
	
	for ($x = 0; $x < count($Basica); $x++) 
	{
		$BasicaUni=$Basica[$x];
		$Campo=$Basica2[$x];
		
		$Positivo=true;
		$AND=true;
		
		if (array_key_exists($x,$Opciones))
			if ($Opciones[$x]=="OR")
				$AND=false;
			else
				if ($Opciones[$x]=="AND")
				$AND=true;
			else
				if ($Opciones[$x]=="NOT")
				$Positivo=false;	
	
		$TypeNumber=intval($Campo);
		$Inside=$CamposArray->isinside($TypeNumber);
		$TypeNumber=$CamposArray->findElem($TypeNumber);
	
/*	echo $BasicaUni;
	echo "</br>";
	*/
	
	if (preg_match("/^\".+\"$/",$BasicaUni))
		{
			$BasicaUni=str_replace("\"","",$BasicaUni);
			$incluseList=true;
		}
	
	if (isset($BasicaUni)&&(!empty($BasicaUni))&&($incluseList||!listanegra($BasicaUni)))
		{
			
		if (!empty($BusquedaStringLabel))
			
			if ($AND)
				$BusquedaStringLabel=$BusquedaStringLabel."AND ";
			else
				$BusquedaStringLabel=$BusquedaStringLabel."OR ";
			
			
			$Negativotemporal="";
			if (!$Positivo)
				$Negativotemporal="¬";
			
			$BusquedaStringLabel=$BusquedaStringLabel.$Negativotemporal.$BasicaUni." ";	
			
			$BasicaUniE=$BasicaUni;
			
			if ($Inside)
				$BasicaUniE="*".$BasicaUni."*";
			
		$Busqueda= array("value"=>$BasicaUniE,"type" => $TypeNumber,"positive" => $Positivo, "and" =>$AND,"exacto"=>true) ;
			array_push($BusquedaArray,$Busqueda);	
			
		//$Busqueda= array("type" => $TypeNumber,"positive" => $Positivo, "and" =>$ORE) ;
		//$BusquedaArray[$BasicaUni]=$Busqueda;
		}
	}
	

		if (isset($Previa)&&(!empty($Previa)))
			$BusquedaArray= json_decode($Previa, true);
	
	
//	var_dump($BusquedaArray);
	$Basica=json_encode($BusquedaArray);
	
	include 'buscar_codigo_general.php';
	
		
	?>
	