<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTentrada.php');
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = $lcCodigo;
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion Recepción</title>
<?php print($objFunciones->librerias_generales); ?>
<script>
function cargar()
{
	var operacion = '<?php print($operacion);?>';
	var listo = '<?php print($listo);?>';
	mensajes(operacion,listo);
	cargar_select(operacion,listo);
}
</script>
</head>
<body onload='cargar();'>
<?php print($objFunciones->cuadro_busqueda); ?>
<!--
	Codigo
	Antes del
	Formulario
	antes_form.php
-->
<?php @include('antes_form.php'); ?>
<div id='mensajes_sistema'></div><br />
<center>Todos los campos con <span class='rojo'>*</span> son Obligatorios</center>
</br>
<form name='form1' id='form1' autocomplete='off' method='post'/>
<div class='cont_frame'>
<h1>Recepción</h1>
<table border='1' class='datos' align='center'>
<tr >
<td align='right'><span class='rojo'>*</span> Nro. Recepción:</td>
<td><input type='text' disabled='disabled' size="3" readonly="readOnly" maxlength='' name='txtcodigo' value='<?php print($lcCodigo);?>' id='txtcodigo' class='validate[required]'/></td>
<td align='right'><span class='rojo'>*</span> Fecha Recepcion:</td>
<td><input type='text' disabled='disabled' name='txtfecha_entrada' value='<?php print($lcFecha_entrada);?>' id='txtfecha_entrada' class='validate[required] fecha_formateada'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Proveedor:</td>
<td><select name='txtrif_proveedor' disabled='disabled' id='txtrif_proveedor' class=''>
<option value=''>Seleccione</option>
<?php print $objFunciones->crear_combo("tproveedor","rif","razon_social",$lcRif_proveedor); ?>
</select></td>
<td align='right'><span class='rojo'>*</span> Nro. Factura:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtnro_factura' value='<?php print($lcNro_factura);?>' id='txtnro_factura' class='validate[required]'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Fecha Factura:</td>
<td><input type='text' disabled='disabled' name='txtfecha_factura' value='<?php print($lcFecha_factura);?>' id='txtfecha_factura' class='validate[required] fecha_formateada'/></td>
<td align='right'><span class='rojo'>*</span> Observación:</td>
<td><textarea name='txtobservacion' maxlength='' disabled='disabled' id='txtobservacion' class='validate[required]'><?php print($lcObservacion);?></textarea></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Partida:</td>
<td colspan="3"><select name='txtcodigo_partida' disabled='disabled' id='txtcodigo_partida' class='validate[required]'>
<option value=''>Seleccione</option>
<?php print $objFunciones->crear_combo("tpartida","codigo","nombre",$lcCodigo_partida); ?>
</select></td>
</tr>
</table>
</div>
<div class='cont_frame'>
<h1>Detalle</h1>
<table border='1' class='datos' align='center'>
<tr>
	<td>Articulo</td>
	<td>Unidad de Medida</td>
	<td>Cant. Recp</td>
	<td>-</td>
</tr>
<tr>
	<td>
	<input type="hidden" disabled="disabled" id="txtcodigo_articulo" name="txtcodigo_articulo">
	<input type="text" disabled="disabled" id="txttext_articulo" name="txttext_articulo">
	</td>
	<td>
		<input type="text" disabled="disabled" name="txtunidad_medida" readonly="readonly" id="txtunidad_medida"/>
	</td>
	<td><input type="text" name="txtcantidad" disabled="disabled" id="txtcantidad" size="5"/></td>
	<td><button type="button" onclick="addline();">+</button></td>
</tr>
<tbody id="content-details">
	<?php print $cadrecepcion; ?>
</tbody>
<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcCodigo); ?>'>
</table>
<?php $objFunciones->botonera_general('Tentrada','total',$id); ?>
</div>
</form>
<!--
	Codigo
	Despues del
	Formulario
	despues_form.php
-->
<?php @include('despues_form.php'); ?>
<script type="text/javascript">
	$(document).ready(function(){
    var availableTags = [
    	<?php  print $lista_prod; ?>
    ]
    $( "#txttext_articulo" ).autocomplete({
      source: availableTags,
      select: function( event , ui ) {
            var data = ui.item.label.split("-");
            var cod = data[0];
            var text = data[1];
            var um = data[2];
            $("#txtcodigo_articulo").val(cod);
            $("#txttext_articulo").val(text);
            $("#txtunidad_medida").val(um);
        }
    });
	});
</script>
</body>
</html>