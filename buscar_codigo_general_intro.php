<?php
	include 'config.php'; 
	include 'funcion_ver_documento.php';
?>



<?php
function ArrayFiltroN($TypeID,$arrayFiltro,$Basica,$Campo,$Start,$Limite,$FiltroA)
{
	//Aqui meter mano;
	
	ArrayFiltro($TypeID,$arrayFiltro,$Basica,$Campo,$Start,$Limite,$FiltroA);
	
}
?>	


<?php
function ArrayFiltro($TypeID,$arrayFiltro,$Basica,$Campo,$Start,$Limite,$FiltroA)
{
	//var_dump ($FiltroA);
	if (!isset($arrayFiltro))
		echo "<a>+ de 50 Valores</a>";
	else if (empty($arrayFiltro))
		echo "<a>0 Valores</a>";
	else
	{
	
	$FiltroAplicarT= json_decode($FiltroA, true);
	
	if (isset($FiltroAplicarT[$TypeID])&&(!empty($FiltroAplicarT[$TypeID])))
		{
			$FiltroAplicar= $FiltroAplicarT[$TypeID];
		}
	else
	{
		$FiltroAplicar=array();
	}
		
	foreach ($arrayFiltro as $arrayV)
				{
					$cunt;
					$val;
					foreach ($arrayV as $EtiquetaV=>$Valor)
					{
						if ($EtiquetaV=="Count")
							$cunt=$Valor;
						else if ($EtiquetaV=="FilterString")
							$val=$Valor; 
					}
				
				echo "<li class=\"lifiltro\">";
				
				
				if (in_array ($val,$FiltroAplicar))
					echo "<input type=\"checkbox\" name=\"f".$TypeID."[]\" value=\"".$val."\"  checked >".$val." (".$cunt.")";				
				else
					echo "<input type=\"checkbox\" name=\"f".$TypeID."[]\" value=\"".$val."\">".$val." (".$cunt.")";
				echo "</li>";
				}
	}
}
?>	

<div>

<?php



	$Campo=$_POST["Campo"];
	$Start=$_POST["Start"];
	$Limite=$_POST["Limite"];
	$FiltroA=$_POST["Filtro"];
	$FiltroNuevo=$_POST["FiltroNuevo"];
	$BusquedaARRAY=$_POST["BusquedaARRAY"];
	$BusquedaStringLabelIN=$_POST["BusquedaStringLabelIN"];

	
	if (empty($FiltroNuevo))
		$FiltroNuevo=false;
	
	if (isset($BusquedaStringLabelIN)&&!empty($BusquedaStringLabelIN))
		$BusquedaStringLabel=$BusquedaStringLabelIN;
	
	if (isset($BusquedaARRAY)&&!empty($BusquedaARRAY))
	{
		$BusquedaArray=json_decode($BusquedaARRAY);
	}
	//var_dump($FiltroA);
	
	if (empty($Start))
		$Start=0;
	
	if (empty($Limite))
		$Limite=10;
	
	$ServerService='http://'.ClavyServer.':'.ClavyPort.'/'.ClavyDomine.'/rest/Finder/';
	$service_url = $ServerService.'active';
	$curl = curl_init($service_url);

	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60); // Setting the amount of time (in seconds) before the request times out
	curl_setopt($curl, CURLOPT_TIMEOUT, 180);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
		$info = curl_getinfo($curl);
		curl_close($curl);
		echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' no esta activo, por favor pruebe de nuevo y contacte con el administrador si persiste';
	}else
	{
		curl_close($curl);
		$service_url = $ServerService.'find?userclavy='.Clavyuser.'&passwordclavy='.Clavyuserkey.'&keyclavy='.Clavykey.'&start='.$Start.'&limit='.$Limite;
		$service_url= $service_url.
		
	$curl = curl_init($service_url);
	
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60); // Setting the amount of time (in seconds) before the request times out
	curl_setopt($curl, CURLOPT_TIMEOUT, 180);
	
		
		
	//var_dump($TypeNumber);
	//var_dump($Campo);
	
	include 'filtro.php';
	
	$FiltroData = array("filtro" => $Filtro); 
	
	
	//var_dump($FiltroA);
	
	if (isset($FiltroA)&&!(empty($FiltroA)))
		$FiltroAplicar= json_decode($FiltroA, true);
	else
		$FiltroAplicar=array();

	
	/*foreach ($Filtro as $Valor)	
		var_dump($_POST["f".$Valor]);
	echo "<br>"; */
	
	if ($FiltroNuevo)
	{
		$FiltroAplicar=array();
		foreach ($Filtro as $Valor)	
		{		
			if (isset($_POST["f".$Valor])&&!(empty($_POST["f".$Valor])))
			{
				$A=$_POST["f".$Valor];
				$FiltroAplicar[$Valor]=$A;
			}
		}
	}
	//var_dump($FiltroAplicar);
	
	$FiltroA=json_encode($FiltroAplicar); 
	
	
	echo "<br>";
	
	include 'description.php';

	$BusquedaData=array("busqueda" => $BusquedaArray, "filtro" => $FiltroData,"faplicado" => $FiltroAplicar,"resumen" => $Desc);
	
	//var_dump($BusquedaData);
		
	$data_string = json_encode($BusquedaData);    
	
	$BusquedaArray = json_encode($BusquedaArray);    
	
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60); // Setting the amount of time (in seconds) before the request times out
	curl_setopt($curl, CURLOPT_TIMEOUT, 180);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);  
	$curl_response = curl_exec($curl);
	
	
	if ($curl_response === false) {
		$info = curl_getinfo($curl);
		curl_close($curl);
		echo 'Problema del Buscador, intentelo de nuevo info: '.$info['http_code'];
		echo $curl_response;
	}else
	{
		$status = curl_getinfo($curl);
		
		if ($status['http_code']=='200')
		{
			$JObj=json_decode($curl_response, true);
	
			curl_close($curl);
			//var_dump($JObj);
			
			
			$arraYDocumentos=array();
			$TotalValue=0;
			$arraYFiltro=array();
			
			foreach ($JObj as $valor) {
				
				foreach ($valor as $EtiquetaV=>$arrayE)
				{
				if ($EtiquetaV=='Documents')
					$arraYDocumentos=$arrayE;		
				
				if ($EtiquetaV=='DocumentsCountTotal')
					$TotalValue=$arrayE;
				
				if ($EtiquetaV=='Filtro')
					$arraYFiltro=$arrayE;
				
				}
			}
			
			?>
			</br>
			<div class='nvisibles'>
			
			<form name='formlimite' action='' method="post">
			<input type="hidden" name="BarraBasica" value=<?php echo $Basica?> />
			<input type="hidden" name="Campo" value=<?php echo $Campo?> />
			<input type="hidden" name="Start" value=0 />
			<input type="hidden" name="Filtro" value='<?php echo $FiltroA?>' />
			<input type="hidden" name="BusquedaStringLabelIN" value='<?php echo $BusquedaStringLabel?>' />
			<input type="hidden" name="BusquedaARRAY" value='<?php echo $BusquedaArray?>' />

			<select name="Limite" onchange="javascript:document.forms['formlimite'].submit();">
		<option value="10"<?php if ($Limite==10) echo "selected=\"selected\"";?>>10</option>
		<option value="25"<?php if ($Limite==25) echo "selected=\"selected\"";?>>25</option>
		<option value="50"<?php if ($Limite==50) echo "selected=\"selected\"";?>>50</option>
		<option value="100"<?php if ($Limite==100) echo "selected=\"selected\"";?>>100</option>
		<option value="200"<?php if ($Limite==200) echo "selected=\"selected\"";?>>200</option>
		<option value="500"<?php if ($Limite==500) echo "selected=\"selected\"";?>>500</option>
		<option value="1000"<?php if ($Limite==1000) echo "selected=\"selected\"";?>>1000</option>
			</select>
			</form>
			</div>
			</br>
			
			<?php
			
			if ($TotalValue>0){
				$ParticionesC=$TotalValue/$Limite;
			}
			if ($TotalValue>$Limite)
				{
				$Particiones=$TotalValue/$Limite;
				echo "<div class='paginacion'>";
				$Visibles=0;
				$InicioMenos=false;
				for ($i = 0; ($i <= $Particiones&&$Visibles<6); $i++) {
					$sta=($Limite*$i);		
					$sup=$Limite+($Limite*$i);
					if ($sup>$TotalValue)
						$sup=$TotalValue;
					
					
					if ($Start<=$sta)
					{
						
					if (!$InicioMenos&&$Start!=0)	
					{
					$InicioMenos=true;	
					$staPlus=$sta-($Limite*5);
					if ($staPlus<0)
						$staPlus=0;
					echo "<form class=\"paginacionF\" name=\"p".($staPlus+1)."\" action='' method=\"post\">";
					echo "<input type=\"hidden\" name=\"BarraBasica\" value=".$Basica." />";
					echo "<input type=\"hidden\" name=\"Campo\" value=".$Campo." />";
					echo "<input type=\"hidden\" name=\"Start\" value=".$staPlus." />";
					echo "<input type=\"hidden\" name=\"Limite\" value=".$Limite." />";
					echo "<input type=\"hidden\" name=\"Filtro\" value='".$FiltroA."' />";	
					echo "<input type=\"hidden\" name=\"BusquedaStringLabelIN\" value='".$BusquedaStringLabel."' />";
					echo "<input type=\"hidden\" name=\"BusquedaARRAY\" value='".$BusquedaArray."' />";
					echo "<a class=\"paginadorNoActivo\" href=\"javascript:void(0)\" onclick=\"javascript:document.forms['p".($staPlus+1)."'].submit();\" >Menos</a>  ";
					echo "</form>";
					}
					else
						$InicioMenos=true;	
					
	//				echo "[".$sta."-".$sup."]";
					echo "<form class=\"paginacionF\" name=\"p".($sta+1)."\" action='' method=\"post\">";
					echo "<input type=\"hidden\" name=\"BarraBasica\" value=".$Basica." />";
					echo "<input type=\"hidden\" name=\"Campo\" value=".$Campo." />";
					echo "<input type=\"hidden\" name=\"Start\" value=".$sta." />";
					echo "<input type=\"hidden\" name=\"Limite\" value=".$Limite." />";
					echo "<input type=\"hidden\" name=\"Filtro\" value='".$FiltroA."' />";	
					echo "<input type=\"hidden\" name=\"BusquedaStringLabelIN\" value='".$BusquedaStringLabel."' />";
					echo "<input type=\"hidden\" name=\"BusquedaARRAY\" value='".$BusquedaArray."' />";
				
					if ($Visibles<5)
					{
						
					$Visibles=$Visibles+1;
					echo "<a ";
					if ($Start==$sta)
						echo "class=\"paginadorActivo\" ";
					else
						echo "class=\"paginadorNoActivo\" ";
					echo " href=\"javascript:void(0)\" onclick=\"javascript:document.forms['p".($sta+1)."'].submit();\" >".($i+1)."</a>  ";
					
					}else
					{	
					$Visibles=$Visibles+1;
					echo "<a class=\"paginadorNoActivo\" href=\"javascript:void(0)\" onclick=\"javascript:document.forms['p".($sta+1)."'].submit();\" >Mas</a>  ";	
					}
					echo "</form>";
					}
					
				}		
				echo "</div>";	
				echo "</br>";
				echo "</br>";
				}
				
			?>	
			<div class='filtro'>
			
			
			<form class="filtroF" name="formFilter" action='' method="post">
			<input type="hidden" name="BarraBasica" value=<?php echo $Basica?> />
			<input type="hidden" name="Campo" value=<?php echo $Campo?> />
			<input type="hidden" name="Start" value=<?php echo $Start?> />
			<input type="hidden" name="Limite" value=<?php echo $Limite?>  />
			<input type="hidden" name="FiltroNuevo" value=true />
			<input type="hidden" name="BusquedaStringLabelIN" value='<?php echo $BusquedaStringLabel?>' />
			<input type="hidden" name="BusquedaARRAY" value='<?php echo $BusquedaArray?>' />
			<?php
			
			
			foreach ($arraYFiltro as $arrayEU)
			{
				$TypeA=0;
				$valueAArr="";
				foreach ($arrayEU as $Etiqueta=>$ValorE)
				{
					if ($Etiqueta=='TypeId')
						$TypeA=$ValorE;
						
					else
						$valueAArr=$ValorE;
						
				}
				
				
				echo "<details class=\"detailsfiltro\" ";
				
				if ((isset($FiltroAplicar[$TypeA])&&(!empty($FiltroAplicar[$TypeA])))||$TypeA==0)
					echo "open"; 
				echo ">";
				echo "<summary>";
				$ValueA=$FiltroObject->findElem($TypeA);
				$ValueNumber=$FiltroObject->isNumeric($TypeA);
				echo $ValueA;
				echo "</summary>";
				echo "<div class=\"scrollFilter\">";
				if ($ValueNumber)
					ArrayFiltro($TypeA,$valueAArr,$Basica,$Campo,$Start,$Limite,$FiltroA);
				else
					ArrayFiltroN($TypeA,$valueAArr,$Basica,$Campo,$Start,$Limite,$FiltroA);
				echo "</div>";
				echo "</details>";
				
		
				
			}
			?>	
			</br>
			<input class="submitFiltro" type="submit" value="Aplicar Filtro">
			</form>
			</br>
			
			
			</div>	
			<div class='documents'>
			<?php
			$counterdoc=0;
			foreach ($arraYDocumentos as $arrayEU)
				{
					$counterdoc=$counterdoc+1;
					$counterdocT=$counterdoc+$Start;
				//	echo $counterdoc;
				$valorID="";
				$valorDesc="";
				$valorIZ="imagenes/logomenu2.png";
				$valorElem=array();
				foreach ($arrayEU as $Etiqueta=>$ValorE)
				{
					
					if ($Etiqueta=='IDDOcument')
						$valorID=$ValorE;
					else if ($Etiqueta=='Description')
						$valorDesc=$ValorE;
						else if ($Etiqueta=='Icon'&&!empty($ValorE))
						$valorIZ=$ValorE;
							else if ($Etiqueta=='Atributos')
								$valorElem=$ValorE;
					
				}
				show_document($valorID,$valorDesc,$valorIZ,$counterdocT,$valorElem,$DescObject);
			}
			echo "</div>";	
			//var_dump($JObj);
			//echo $curl_response;
			
			
		/*	
		
		 //Paginacion Abajo Problemas con el float
		
			if ($TotalValue>0){
				$ParticionesC=$TotalValue/$Limite;
			}
			if ($TotalValue>$Limite)
				{
				
				$Particiones=$TotalValue/$Limite;
				echo "<div class='paginacion'>";
				echo "</br>";
				echo "</br>";
				$Visibles=0;
				$InicioMenos=false;
				for ($i = 0; ($i <= $Particiones&&$Visibles<6); $i++) {
					$sta=($Limite*$i);		
					$sup=$Limite+($Limite*$i);
					if ($sup>$TotalValue)
						$sup=$TotalValue;
					
					
					if ($Start<=$sta)
					{
						
					if (!$InicioMenos&&$Start!=0)	
					{
					$InicioMenos=true;	
					$staPlus=$sta-($Limite*5);
					if ($staPlus<0)
						$staPlus=0;
					echo "<form class=\"paginacionF\" name=\"p".($staPlus+1)."\" action='' method=\"post\">";
					echo "<input type=\"hidden\" name=\"BarraBasica\" value=".$Basica." />";
					echo "<input type=\"hidden\" name=\"Campo\" value=".$Campo." />";
					echo "<input type=\"hidden\" name=\"Start\" value=".$staPlus." />";
					echo "<input type=\"hidden\" name=\"Limite\" value=".$Limite." />";
					echo "<input type=\"hidden\" name=\"Filtro\" value='".$FiltroA."' />";	
					echo "<input type=\"hidden\" name=\"BusquedaStringLabelIN\" value='".$BusquedaStringLabel."' />";
					echo "<a class=\"paginadorNoActivo\" href=\"javascript:void(0)\" onclick=\"javascript:document.forms['p".($staPlus+1)."'].submit();\" >Menos</a>  ";
					echo "</form>";
					}
					else
						$InicioMenos=true;	
					
	//				echo "[".$sta."-".$sup."]";
					echo "<form class=\"paginacionF\" name=\"p".($sta+1)."\" action='' method=\"post\">";
					echo "<input type=\"hidden\" name=\"BarraBasica\" value=".$Basica." />";
					echo "<input type=\"hidden\" name=\"Campo\" value=".$Campo." />";
					echo "<input type=\"hidden\" name=\"Start\" value=".$sta." />";
					echo "<input type=\"hidden\" name=\"Limite\" value=".$Limite." />";
					echo "<input type=\"hidden\" name=\"Filtro\" value='".$FiltroA."' />";	
					echo "<input type=\"hidden\" name=\"BusquedaStringLabelIN\" value='".$BusquedaStringLabel."' />";
				
					if ($Visibles<5)
					{
						
					$Visibles=$Visibles+1;
					echo "<a ";
					if ($Start==$sta)
						echo "class=\"paginadorActivo\" ";
					else
						echo "class=\"paginadorNoActivo\" ";
					echo " href=\"javascript:void(0)\" onclick=\"javascript:document.forms['p".($sta+1)."'].submit();\" >".($i+1)."</a>  ";
					
					}else
					{	
					$Visibles=$Visibles+1;
					echo "<a class=\"paginadorNoActivo\" href=\"javascript:void(0)\" onclick=\"javascript:document.forms['p".($sta+1)."'].submit();\" >Mas</a>  ";	
					}
					echo "</form>";
					}
					
				}		
				echo "</div>";	
				
				}
			*/	
				
			
		}
		else
		{
			echo 'Problema del Buscador, intentelo de nuevo info: '.$status['http_code'];
			echo "</br>";
			echo $curl_response;
			curl_close($curl);
			
		}
		
	}
		
	}


?>

</div>
</br>
<?php include 'botton.php'; ?>