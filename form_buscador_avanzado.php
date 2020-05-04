<?php include 'top.php'; ?>
<?php $LinkAtras="index.php"; ?>
<?php include 'cabecera.php'; ?>
<?php

	$Campos=$_POST["Campos"];
	
//	echo $Campos;
	
	if (!isset($Campos)||(empty($Campos)))
		$Campos=array();
	
//	echo $Campos;
	?>
	<br>
<!--	<span class="texto_base_avanzado buscador_avanzado buscador_avanzado_zona">Buscador Avanzado</span>-->
	<br>
	</div> <!-- Cierre de la cabecera con imagen -->
	
	<p class="buscador_avanzado_texto_Cabecera">Buscador Avanzado</p>
	<hr class="linea_horizontal">
	
	
	<form class="formulario_base buscador_avanzado buscador_avanzado_zona_mas" name="buscadoravanzadobuscar" action='buscar_avanzado.php' method="post">
	
	
	<?php
	
	include 'campos.php';
	
		
	
	$counter=0;
	
	$counterCampos=0;
	
	foreach ($CamposArray->CampoA as $Group1=>$Arra) 
	{
		echo "</br>";	
		if ($Group1!="0")
		{
			echo "<span class='grupo'>".$Group1."</span>";
			$CamposAct=1;
		}
		else 
		{
			echo "<span class='grupo'>Todos</span>";
			$CamposAct=0;
		}
		
		
			if (array_key_exists($counterCampos,$Campos))
				$CamposAct=$Campos[$counterCampos];

			
	$Campos[$counterCampos] = $CamposAct;
		
		
	//	var_dump($Campos);
		
		for ($x = 0; $x <= $CamposAct; $x++) {
			
			echo "</br>";	
			
		

			echo "<input class=\"barra_buscador_avanzado buscador_avanzado\" type=\"text\" name=\"BarraBusqueda[".$counter."]\" maxlength=\"120\">";
			
			echo "<select class=\"campo_valores_buscador_avanzado buscador_avanzado\" name=\"Opciones[".$counter."]\"  title=\"Opciones\">";
			

			echo "<option value=\"AND\">AND</option>";
			
			if ($x!=0)
				echo "<option value=\"OR\">OR</option>";
			
			echo "<option value=\"NOT\">NOT</option>";
			echo "</select>";
			
			echo "<select class=\"campo_valores_buscador_avanzado_tipos buscador_avanzado";
	
			if ($Group1=="0")
				echo " buscador_avanzado_todos ";
			
			echo "\" name=\"Campo[".$counter."]\">";
	

	
			foreach ($Arra as $elem) 
				echo "<option value=\"".$elem->Numer."\">".$elem->Valor."</option>";
			
			$counter=$counter+1;
		echo "</select>";
	
	
	}
	
	echo "<input class=\"buttonnormal\"type=\"button\" value=\"+\" onclick=\"javascript:document.forms['addCampo".$counterCampos."'].submit();\">";
	echo "</br>";
	$counterCampos=$counterCampos+1;
		}
	

	?>
	
<!--	<input type="button" value="+" onclick="javascript:document.forms['addCampo'].submit();">-->
	</br>
	</br>
<!--	<input type="hidden" name="Campos" value='<?php //echo $Campos;?>' /> -->
	<input type="button" value="Buscar" onclick="javascript:document.forms['buscadoravanzadobuscar'].submit();">
	</form>
	
<?php 

//var_dump($Campos);
foreach ($Campos as $clavefor=>$valorfor) 
{
echo "<form name=\"addCampo".$clavefor."\" action='' method=\"post\">";
foreach ($Campos as $clavefor2=>$valorfor2) 
{
	if ($clavefor==$clavefor2)
	{
	$TMPCampo=$valorfor2+1;
	echo "<input type=\"hidden\" name=\"Campos[".$clavefor2."]\" value='".$TMPCampo."' />";
	}else
	{
		echo "<input type=\"hidden\" name=\"Campos[".$clavefor2."]\" value='".$valorfor2."' />";
	}
}
echo "</form>";
}
?>	
	
	</br>
	
	
<?php include 'botton.php'; ?>