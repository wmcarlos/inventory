<?php 
	require_once("../modelos/clsTarticulo.php");
	$objar = new clsTarticulo();
	$cad = $objar->listar();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reporte de Inventario</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="plugins/tableexport/tableExport.js"></script>
	<script type="text/javascript" src="plugins/tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="plugins/tableexport/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="plugins/tableexport/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="plugins/tableexport/jspdf/libs/base64.js"></script>
	<style type="text/css">
		div#content{
			width: 800px;
			height: auto;
			overflow: hidden;
			margin: 5px auto;
			box-shadow: 5px 5px 10px #ccc;
		}

		table#customers{
			width: 100%;
			border:1px solid #ccc;
		}

		table#customers thead{
			background: #ccc;
			color: black;
		}

		table#customers tr td, table#customers thead th{
			border: 1px solid #ccc;
			text-align: center;
			padding:5px;
		}
	</style>
</head>
<body>
<div id="content">
	<table id="customers" class="table table-striped" >		
	<thead>
		<th colspan="5">Reporte de Inventario</th>
	</thead>
	<thead>
		<th>Nombre</th>
		<th>Descripcion</th>
		<th>Minimo</th>
		<th>Maximo</th>
		<th>Existencia</th>
	</thead>
	<tbody>
		<?php print $cad; ?>
		<tr>
			<td colspan="5">
				<button type="button" onclick="$('#customers').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">Imprimir en PDF</button>
				<button type="button" onclick="$('#customers').tableExport({type:'excel',escape:'false'});">Imprimir en Excel</button>
			</td>
		</tr>
	</tbody>
</table> 
</div>
</body>
</html>