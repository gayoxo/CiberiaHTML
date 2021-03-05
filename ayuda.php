<?php include 'top.php'; ?>
<?php $LinkAtras="index.php"; ?>
<?php include 'cabecera.php'; ?>
<?php
	include 'config.php';
?>
	</br>

</div>		
<div class="ayuda">
	<p class="ayuda_texto_Cabecera">Ayuda</p>
	<hr class="linea_horizontal">
	<div class="ayuda_body">
		<div class="bloque">
				<p class="texto_bloque_cabecera">
					Resumen
				</p>
				<p class="texto-bloque_cuerpo">
				El sistema <a class="ayuda_link" href="index.php">Mnemosine</a> utiliza como fuente del conocimiento el sistema <a class="ayuda_link" target="_blank" href="http://clavy.fdi.ucm.es/">Clavy</a>. La colección <a class="ayuda_link" href="index.php">Mnemosine</a> está almacenada en esta plataforma, que se caracteriza por ser de almacenamiento de repositorios dinámicamente reconfigurable que puede exponer la información contenida mediante servicios. La web Mnemosine es un mecanismo de presentación de esta información que permite un entorno agradable para su consulta y acceso.<br/>
	
	El sistema de búsqueda esta almacenado en la plataforma <a class="ayuda_link" target="_blank" href="http://clavy.fdi.ucm.es/">Clavy</a> y se realiza mediante la creación de un índice sobre la librería <a class="ayuda_link" href="https://lucene.apache.org/">Lucene</a>. Esta librería permite el almacenamiento de la información de manera compacte e indexada, dando soporte a un potente servicio de búsqueda. <br/>
	
	En esta sección se presentará un breve resumen del mecanismo de consultas que soporta <a class="ayuda_link" href="https://lucene.apache.org/">Lucene</a> y cómo crearlas para la inspección del repositorio. Este manual de ayuda está basado en diferentes manuales de <a class="ayuda_link" href="https://lucene.apache.org/">Lucene</a> referenciados al final de esta página, donde puede encontrarse información adicional sobre el formato de las consultas.
				</p>
		</div>
		<hr class="linea_horizontal">
		
		<div class="bloque">
				<p class="texto_bloque_cabecera">
					Consulta Básica
				</p>
				<p class="texto-bloque_cuerpo">
				
				Las consultas en <a class="ayuda_link" href="https://lucene.apache.org/">Lucene</a> se tratan como una expresión lógica <i>booleana</i>, por lo que lo primero que hay que explicar es que hay ciertas palabras/símbolos reservados para la consulta. Estas palabras/símbolos son <code>AND OR && || + - ? *:</code>. <br/><br/>
				
				Una consulta básica constará de un conjunto de palabras a buscar y separadas por reservados, por ejemplo:<br/><br/>
				
				><code>Dialogos AND Teatro</code> - Esta consulta obtendrá todos aquellos elementos en cuya descripción esté la palabra Dialogo <strong>y</strong> Teatro simultáneamente.<br/><br/>
				
				><code>Dialogos OR Teatro</code> - Esta consulta obtendrá todas aquellos elementos en cuya descripción esté la palabra Dialogo <strong>ó</strong> Teatro simultáneamente.<br/><br/>
				
				><code>Dialogos AND -Teatro</code> - Esta consulta obtendra todas aquellos elementos en cuya descripción esté la palabra Dialogo <strong>y no</strong> Teatro simultaneamente.<br/><br/>
				
				><code>Dialogos OR -Teatro</code> - Esta consulta obtendrá todas aquellos elementos en cuya descripción esté la palabra Dialogo <strong>ó no </strong> Teatro simultáneamente.<br/><br/>
				
				Los simbolos <code>&&</code> y <code> || </code> equivalen a <code>AND</code> y <code>OR</code> respectivamente.<br/><br/>
				
				</p>
				
				<p class="texto_bloque_cabecera">
					Consulta por categoría
				</p>
				<p class="texto-bloque_cuerpo">
				
				Tal y como está configurada <a class="ayuda_link" href="https://lucene.apache.org/">Lucene</a>, se permite también la búsqueda más especifica por categoría. Para este objetivo, se debe incluir la categoría ( en minúsculas y sin caracteres no alfanuméricos) seguida del símbolo reservado <code>:</code><br/><br/>
				
				Unos ejemplos de consulta por categoría son:<br/><br/>
				
				><code>titulo:Dialogos AND autor:Unamuno</code> - Esta consulta obtendrá todos aquellos elementos en cuyas categoría Titulo/titulo esté contenido el concepto Dialogo <strong>y</strong> las categorías Autor/autor esté contenido el termino Unamuno simultáneamente.<br/><br/>
				
				><code>titulo:Dialogos OR autor:Unamuno</code> -  Esta consulta obtendrá todas aquellos elementos en cuyas categoría Titulo/titulo esté contenido el concepto Dialogo <strong>ó</strong> las categorías Autor/autor esté contenido el termino Unamuno simultáneamente.<br/><br/>
				
				><code>titulo:Dialogos AND -autor:Unamuno</code> - Esta consulta obtendrá todas aquellos elementos en cuyas categoría Titulo/titulo esté contenido el concepto Dialogo <strong>y no</strong> las categorías Autor/autor esté contenido el termino Unamuno simultáneamente.<br/><br/>
				
				><code>-titulo:Dialogos OR autor:Unamuno</code> -  Esta consulta obtendrá todas aquellos elementos en cuyas categoría Titulo/titulo <strong>no </strong> esté contenido el concepto Dialogo <strong>ó</strong> las categorías Autor/autor esté contenido el termino Unamumo simultáneamente.<br/><br/>
				
				
				La lista de concepto que están definidos en la colección <a class="ayuda_link" href="index.php">Mnemosine</a> son: <br/>
				
				<div class="comando_ayuda">
				
				<code class="ayuda_code">
				
				<?php 
				
				$ServerService='http://'.ClavyServer.':'.ClavyPort.'/'.ClavyDomine.'/rest/'.ClavyService.'/';
	//$service_url = $ServerService.'getConcepts';
	$service_url = $ServerService.'getConcepts?userclavy='.Clavyuser.'&passwordclavy='.Clavyuserkey.'&keyclavy='.Clavykey;
	$curl = curl_init($service_url);

	//echo ($service_url);
	
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
		$status = curl_getinfo($curl);
		
		if ($status['http_code']=='200')
		{
			/*echo $curl_response;
			echo "</br>";*/
			
			$JObj=json_decode($curl_response, true);
			
			curl_close($curl);
			
			foreach($JObj as $k => $elem){
				echo $elem . ':<br/>';
			}
			
		}
	}
				
				
				?>
				
				</code>
				</div>
				</p>
				
				</div>
				
				
		<hr class="linea_horizontal">
		
		
		<div class="bloque">
				
				
				<p class="texto_bloque_cabecera">
					Elemento Comodín
				</p>
				<p class="texto-bloque_cuerpo">
				La consultas pueden ser flexibles, permitiendo que la búsqueda sea más permeable a variaciones de una palabra. Para este cometido es necesario usar los símbolos reservados <code>? *</code>. Estos símbolos permitirán la sustitución de este por una o varios caracteres respectivamente.
				
				Un ejemplo de su uso es el siguiente.<br/><br/>
				
				><code>Surc?</code> - Esta consulta obtendrá todas aquellos elementos en cuya descripción esté por ejemplo la palabra surc<strong>o</strong> o surc<strong>a</strong>.<br/><br/>
				
				><code>Trabaja*</code> - Esta consulta obtendrá todas aquellos elementos en cuya descripción esté por ejemplo la palabra Trabaja<strong>r</strong>, Trabaja<strong>dor</strong> o Trabaja<strong>dora</strong>.<br/><br/>

				</p>
				
				
		</div>		
		<hr class="linea_horizontal">
		
		
		<div class="bloque">
				
				
				<p class="texto_bloque_cabecera">
					Expresión Regular
				</p>
				<p class="texto-bloque_cuerpo">
				
				Las expresiones regulares están permitidas para la realización de consultas complejas dentro de <a class="ayuda_link" href="https://lucene.apache.org/">Lucene</a>. Una consulta basada en expresión regular empezará con el carácter <code>/</code> y terminará con el carácter <code>/</code>.
				
				Un ejemplo de una expresión válida son los siguientes:
				
				><code>/Surc[oa]/</code> - Esta consulta obtendrá todas aquellos elementos en cuya descripción esté la palabra surc<strong>o</strong> o surc<strong>a</strong>.<br/><br/>
				
				><code>/Trabaja*/</code> - Esta consulta obtendrá todas aquellos elementos en cuya descripción esté por ejemplo la palabra Trabaja<strong>r</strong>, Trabaja<strong>dor</strong> o Trabaja<strong>dora</strong>.<br/><br/>
				
				</p>
				
				
		</div>
		<hr class="linea_horizontal">
		
		
		<div class="bloque">
				<p class="texto_bloque_cabecera">
					<a class="quienes_somos_link" href="quienessomos.php">
					Otros Links de Interés
					</a>
				</p>
				<p class="texto-bloque_cuerpo">
				Esta manual ha sido diseñado a través de diferentes tutoriales más complejos. Para conocer más de las posibilidades de las consultas en <a class="ayuda_link" href="https://lucene.apache.org/">Lucene</a> se adjuntan como referencias las siguientes webs:<br>
><a class="ayuda_link" target="_blank" href="http://www.lucenetutorial.com/lucene-query-syntax.html">Lucene Tutorial</a><br>
><a class="ayuda_link" target="_blank" href="https://lucene.apache.org/core/2_9_4/queryparsersyntax.html">Apache Lucene Tutorial</a><br>
><a class="ayuda_link" target="_blank" href="https://www.ionos.es/digitalguide/servidores/configuracion/apache-lucene/">Ionos.es</a><br>
><a class="ayuda_link" target="_blank" href="https://es.wikipedia.org/wiki/Expresi%C3%B3n_regular">Expresión Regular</a><br>
				</p>
		</div>
		
	</div>
</div>	
	
<?php include 'botton.php'; ?>