<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTsalida.php');
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = 'no';
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion Despacho</title>
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
<h1>Despacho</h1>
<table border='1' class='datos' align='center'>
<tr >
<td align='right'><span class='rojo'>*</span> Nro. Despacho:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtcodigo' value='<?php print($lcCodigo);?>' id='txtcodigo' class='validate[required]'/></td>
<td align='right'><span class='rojo'>*</span> Fecha Despacho:</td>
<td><input type='text' disabled='disabled' name='txtfecha_salida' value='<?php print($lcFecha_salida);?>' id='txtfecha_salida' class=' fecha_formateada'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Unidad:</td>
<td><select name='txtunidad' disabled='disabled' id='txtunidad' class='validate[required]'><option value=''>Seleccione</option></select></td>
<td align='right'><span class='rojo'>*</span> Trabajador:</td>
<td><select name='txtcedula_personal' disabled='disabled' id='txtcedula_personal' class='validate[required]'><option value=''>Seleccione</option></select></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Nro Solicitud:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtnro_solicitud' value='<?php print($lcNro_solicitud);?>' id='txtnro_solicitud' class='validate[required]'/></td>
<td align='right'><span class='rojo'>*</span> Fecha Solicitud:</td>
<td><input type='text' disabled='disabled' name='txtfecha_solicitud' value='<?php print($lcFecha_solicitud);?>' id='txtfecha_solicitud' class='validate[required] fecha_formateada'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Observación:</td>
<td colspan="3"><textarea name='txtobservacion' maxlength='' disabled='disabled' id='txtobservacion' class='validate[required]'><?php print($lcObservacion);?></textarea></td>
</tr>
</table>
</div>
<div class='cont_frame'>
<h1>Detalle</h1>
<table border='1' class='datos' align='center'>
<tr>
	<td>Codigo Articulo</td>
	<td>Descripcion Art.</td>
	<td>Unidad de Medida</td>
	<td>Cant. Desp</td>
	<td>-</td>
</tr>
<tr>
	<td>
	<select>
		<option value="" disabled="disabled">Seleccione</option>	
	</select>
	</td>
	<td><textarea  disabled="disabled"></textarea></td>
	<td>
		<select>
			<option value="" disabled="disabled">Seleccione</option>	
		</select>
	</td>
	<td><input type="text"  disabled="disabled" size="5"/></td>
	<td><button type="button"  disabled="disabled">+</button></td>
</tr>
<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcCodigo); ?>'>
</table>
<?php $objFunciones->botonera_general('Tsalida','total',$id); ?>
</div>
</form>
<!--
	Codigo
	Despues del
	Formulario
	despues_form.php
-->
<?php @include('despues_form.php'); ?>
</body>
</html>