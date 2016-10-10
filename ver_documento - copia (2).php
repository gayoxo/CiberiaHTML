<?php include 'top.php';
include 'config.php';  ?>


<?php
function ProcesaLista($ArrayE,$lis)
{
	foreach ($ArrayE as $arrayV)
	{
	$Type="";
		$Value="";
		$DocRef="";
		$Info= array();
		$DescRef="";
		
	
	foreach ($arrayV as $EtiquetaV=>$Valor)
	{
		
	/*	echo "Aqui: ".$EtiquetaV." Valor: ".$Valor ;*/
		
		
		
		
		if ($EtiquetaV=='Type')
			$Type=$Valor;		
				
		if ($EtiquetaV=='DescRef')
			$DescRef=$Valor;		
		
		if ($EtiquetaV=='Value')
			$Value=$Valor;
				
		if ($EtiquetaV=='DocRef')
			$DocRef=$Valor;
				
		if ($EtiquetaV=='Info')
			$Info=$Valor;
	}

	if (!empty($Type))
	{		
	if ($lis==true)
		echo "<li class=\"lisummary\">";
	
	if (!empty($Info))
	{
		echo "<details open>";
				
		echo "<summary>";
	}
	
		$Result="";
		
		if (!empty($Value))
		{
			$Show="OV: ".$Value." (Sin descripción)" ;
			if (!empty($DescRef))
			$Show=$DescRef;
			
			
		if ($DocRef==true)
				$Result= "<a class=\"avalueE\" href=\"ver_documento.php?documento=".$Value."\" target=\"_blank\" >".$Show."</a>";
			else 
				$Result= "<span class=\"svalueE\">".$Value."</span>";
		}
		
		echo $Type.": ".$Result;
		
		if (!empty($Info))
			echo "</summary>";
		echo "<ul>";
	}
	
		
		
		
		if (!empty($Info))
			ProcesaLista($Info,true);
			
			

			
			
		if (!empty($Type))	
		{
			echo "</ul>";
			
			if (!empty($Info))
				echo "</details>";
			
			if ($lis==true)
				echo "</li>";
		}			
	}
	
	
	
	
}



?>	


<?php 


echo "<div class=\"documento_unico_data\">";
$DocumentID=$_GET["documento"];
//echo $DocumentID;

if (!isset($DocumentID)||($DocumentID==0))
{
	echo "Error en POST";
	exit();
}
	
$ServerService='http://'.ClavyServer.':'.ClavyPort.'/'.ClavyDomine.'/rest/Finder/';
	//$service_url = $ServerService.'getPlainDocument';
	$service_url = $ServerService.'getPlainDocument?userclavy='.Clavyuser.'&passwordclavy='.Clavyuserkey.'&keyclavy='.Clavykey.'&iddocument='.$DocumentID;
	$curl = curl_init($service_url);

	//echo ($service_url);
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
		$info = curl_getinfo($curl);
		curl_close($curl);
		echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' no esta activo, por favor pruebe de nuevo y contacte con el administrador si persiste';
	}else
	{
		$status = curl_getinfo($curl);
		
		if ($status['http_code']=='200')
		{
			/*echo $curl_response;
			echo "</br>";*/
			
			$JObj=json_decode($curl_response, true);
			
			curl_close($curl);
			
			$IDDOcument=$DocumentID;
			$Description="";
			$Icon="";
			$Info= array();
			
			foreach ($JObj as $EtiquetaV=>$arrayE) {
				
				
				if ($EtiquetaV=='IDDOcument')
					$IDDOcument=$arrayE;		
				
				if ($EtiquetaV=='Description')
					$Description=$arrayE;
				
				if ($EtiquetaV=='Icon')
					$Icon=$arrayE;
				
				if ($EtiquetaV=='Info')
					$Info=$arrayE;
				

				/*foreach ($valor as $EtiquetaV=>$arrayE)
				{
				
				
				}*/
			}
			
			?>
			
			<span Class="verDocumentId"><?php echo $IDDOcument;?></span>
			
			
			<div class="verDocumentCabe"> 
			
			 <img  class="verDocumentIcon" src="<?php echo $Icon;?>" alt="Default" width="50"><span Class="verDocumentDescription"><?php echo $Description;?></span>
				
			</div>
			

				
			
			
			
			<div class="verDocumentInfo"> 
				<?php 
				
				if (!empty($Info))
				{
				//var_dump($Info);
				ProcesaLista($Info,false);
				}
				?>
			</div>

			<?php
		}
		else
		{
			echo 'Problema del Buscador, intentelo de nuevo info: '.$status['http_code'];
			echo "</br>";
			echo $curl_response;
			curl_close($curl);
			
		}
	}
echo "</div>";
?>
<?php include 'botton.php'; ?>