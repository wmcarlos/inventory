<?php 
	require_once("../modelos/clsTsalida.php");
	$objSalida = new clsTsalida();
	$nro_despacho = $_GET["nro_despacho"];
	$fecha_despacho = $_GET["fecha_despacho"];
	$departamento = $_GET["departamento"];
	$trabajador = $_GET["trabajador"];
	$nro_solicitud = $_GET["nro_solicitud"];
	$fecha_solicitud = $_GET["fecha_solicitud"];
	$observacion = $_GET["observacion"];
	$cad = $objSalida->listar_detalles_for_report($nro_despacho);

	require_once("../reportes/dompdf/autoload.inc.php");
	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	$dompdf = new Dompdf();
	$html = '<!DOCTYPE html>
			<html>
			<head>
				<style type="text/css">
					table{
							width: 100%;
						}

					table tr td{
						border: 1px solid #ccc;
						text-align: left;
						padding:2px;
					}
				</style>
			</head>
			<body>
				<div>
				<img src="img/banner.png" width="723"/>
				<center><h3>Datos del Despacho</h3></center>
				<table>
					<tr>
						<td><b>Nro Despacho :</b> '.$nro_despacho.'</td>
						<td><b>Fecha Despacho:</b> '.$fecha_despacho.'</td>
					</tr>
					<tr>
						<td><b>Departamento:</b> '.$departamento.'</td>
						<td><b>Trabajador:</b> '.$trabajador.'</td>
					</tr>
					<tr>
						<td><b>Nro Solicitud:</b> '.$nro_solicitud.'</td>
						<td><b>Fecha Solicitud:</b> '.$fecha_solicitud.'</td>
					</tr>
					<tr>
						<td colspan="3"><b>Observacion:</b> '.$observacion.'</td>
					</tr>
				</table>
				<center><h3>Detalle del Despacho</h3></center>
				<table>
					<tr>
						<td style="text-align:center; font-weight:bold;">Produto</td>
						<td style="text-align:center; font-weight:bold;">Unidad de Medida</td>
						<td style="text-align:center; font-weight:bold;">Existencia</td>
						<td style="text-align:center; font-weight:bold;">Cantidad</td>
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
	$dompdf->stream("reporte_despacho.pdf", array("Attachment" => false));

	exit(0);

	?>