<?php 
	require_once("../modelos/clsTsalida.php");
	$objSalida = new clsTsalida();
	$cad = $objSalida->listarsalidas();

	require_once("../reportes/dompdf/autoload.inc.php");
	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	$dompdf = new Dompdf();

	$html = '<!DOCTYPE html>
	<html>
	<head>
		<title>Reporte de Inventario</title>
		<style type="text/css">
			table#customers{
				width: 100%;
			}

			table#customers tr td{
				border: 1px solid #ccc;
				text-align: center;
				padding:2px;
			}
		</style>
	</head>
	<body>
	<div id="content">
	   <img src="img/banner.png" width="723"/>
	   <center><h3>Lista de Recepcion de Articulos</h3></center>
		<table id="customers">
		<tr>
			<td>Nro Despacho</td>
			<td>Fecha Despacho</td>
			<td>Despacho fue Para</td>
			<td>Articulo</td>
			<td>Cantidad</td>
		</tr>
		'.$cad.'
	</table> 
	</div>
	</body>
	</html>';

	$dompdf->loadHtml($html);
	// (Optional) Setup the paper size and orientation
	//$dompdf->setPaper('A', 'landscape');
	// Render the HTML as PDF
	$dompdf->render();
	// Output the generated PDF to Browser
	$dompdf->stream("lista_de_despachos.pdf", array("Attachment" => false));

	exit(0);
?>