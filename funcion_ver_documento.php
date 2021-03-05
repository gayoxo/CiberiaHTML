<?php

function show_document($arg_1,$arg_2,$arg_3,$arg_4,$arg_5,$DescObject)
{

	echo "<div class=\"documento_unico\">";
	echo "<div class=\"documento_unico_orden\">";
	echo $arg_4;
	echo "</div>";
	echo "<div class=\"documento_unico_icono\">";
	echo "<img class=\"documento_unico_icono\" src=\"".$arg_3."\" width=\"50\" border=\"0\" alt=\"iconoDocumento\">";
	echo "</div>";
	echo "<div class=\"documento_unico_resto\">";
	echo "<a class=\"linkdocument\" href=\"ver_documento.php?documento=".$arg_1."\" >";
	echo "<span class=\"Descripcion_documento_buscador_valor\">".$arg_2."</span>";
	echo "</a>";
	echo "</br>";
	echo "</br>";
	foreach($arg_5 as $arrayElem)
	{
		
		$Type=0;
		$Valor="";
		foreach($arrayElem as $Clave=>$ValorA)
		{
			if ($Clave=="TypeId")
				$Type=$ValorA;
			
			if ($Clave=="Value")
				$Valor=$ValorA;
		}

		$Resultado=$DescObject->findElem($Type);
		//echo $Resultado.": ".$Valor;
		
		if (strpos(PHP_VERSION, '5') === 0) {
			$Valor = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_+.~#?&//=]+)','<a href="\1" target="_blank">\1 </a>', $Valor);
			$Valor = eregi_replace('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_+.~#?&//=]+)','<a href="\1" target="_blank">\1</a>', $Valor);
			$Valor = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_+.~#?&//=]+)','\1<a href="http://\2" target="_blank">\2</a>', $Valor);
			$Valor = eregi_replace('([_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3})','<a href="mailto:\1" target="_blank">\1</a>', $Valor);
			}else{
			$Valor = preg_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_+.~#?&//=]+)','<a href="\1" target="_blank">\1 </a>', $Valor);
			$Valor = preg_replace('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_+.~#?&//=]+)','<a href="\1" target="_blank">\1</a>', $Valor);
	//		$Valor = preg_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_+.~#?&//=]+)','\1<a href="http://\2" target="_blank">\2</a>', $Valor);
			$Valor = preg_replace('([_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3})','<a href="mailto:\1" target="_blank">\1</a>', $Valor);	
				
			}

		echo "<span class=\"Descripcion_documento_tipo\"> ".$Resultado."</span>: ";
		echo "<span class=\"Descripcion_documento_tipo_valor\">".$Valor."</span>";

		echo "</br>";
	}
	
	
	echo "</div>";
	echo "</div>";
	
	//echo "ID=".$arg_1." Descripcion= ".$arg_2." Icono=".$arg_3."</br>";;
	
}
?>