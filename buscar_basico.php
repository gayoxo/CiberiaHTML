<?php include 'top.php'; ?>
<?php $LinkAtras="index.php"; ?>
<?php include 'cabecera.php'; ?>
<?php include 'form_buscador.php'?>	
<?php include 'listanegra.php'?>	

	

	
<?php 
	
	$Basica=$_POST["BarraBasica"];

	$BusquedaArray=array();
	
	$BusquedaStringLabel=$Basica;
	
	$BusquedaStringLabelIN=$Basica;
	
	$BusquedaStringLabelQ=$Basica;

	
	include 'buscar_codigo_general.php';
	
	
	?>
	