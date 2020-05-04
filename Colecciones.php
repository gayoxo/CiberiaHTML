<?php include 'top.php'; ?>
<?php $LinkAtras="index.php"; ?>
<?php include 'cabecera.php'; ?>
	</br>

<?php include 'form_buscador.php'?>
	
<div class="Colecciones">
	<p class="Colecciones_texto_Cabecera">Colecciones</p>
	<hr class="linea_horizontal">
	<ul>	

	<?php
	
	include 'coleccionesLista.php';
	
	foreach($CollectionArrayAL as $elembase)
	{
		
	?>
	
	
		<li>
		<div>
		<a class="coleccion_vinculo" href="buscadorColeccion.php?<?php echo $elembase->Datos; ?>" onmouseover="nhpup.popup('<?php echo $elembase->Descripcion; ?>');">
		<img  src=<?php echo $elembase->Imagen; ?> width="150" height="150" border="0" alt="1"> 
		<div class="collection_test"> <p><?php echo $elembase->Nombre; ?></p></div>
		</div>
		</a>
		</li>
	
	
	<?php
	}
	
	?>
	
		
		
		
	</ul>
</div>	
	
<?php include 'botton.php'; ?>