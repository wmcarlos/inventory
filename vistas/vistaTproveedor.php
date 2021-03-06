<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTproveedor.php');
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = 'no';
}else{
$cmunicipio="<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tmunicipio","codigo","nombre","codigo_estado",$estado,$municipio);
$cparroquia="<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tparroquia","codigo","nombre","codigo_municipio",$municipio,$parroquia);
$cciudad = "<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tciudad","codigo","nombre","codigo_parroquia",$parroquia,$lcCodigo_ciudad);
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion Proveedor</title>
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
<h1>Proveedor</h1>
<table border='1' class='datos' align='center'>
<tr >
<td align='right'><span class='rojo'>*</span> Rif:</td>
<td><input type='text' disabled='disabled' maxlength='10' name='txtrif' value='<?php print($lcRif);?>' id='txtrif' class='validate[required],maxSize[10],minSize[10]'/></td>
<td align='right'><span class='rojo'>*</span> Razon Social:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtrazon_social' value='<?php print($lcRazon_social);?>' id='txtrazon_social' class='validate[required]'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Estado:</td>
<td><select name='txtcodigo_estado' disabled='disabled' id='txtcodigo_estado' class='validate[required], select_change' load_data="txtcodigo_municipio" operacion="listar_municipios">
	<option value=''>Seleccione</option>
	<?php print $objFunciones->crear_combo("testado","codigo","nombre",$estado); ?>
</select></td>
<td align='right'><span class='rojo'>*</span> Municipio:</td>
<td><select name='txtcodigo_municipio' disabled='disabled' id='txtcodigo_municipio' class='validate[required] select_change' operacion="listar_parroquias" load_data="txtcodigo_parroquia">
	<option value=''>Seleccione</option>
	<?php print $cmunicipio; ?>
</select></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Parroquia:</td>
<td><select name='txtcodigo_parroquia' disabled='disabled' id='txtcodigo_parroquia' class='validate[required] select_change' operacion="listar_ciudades" load_data="txtcodigo_ciudad">
<option value=''>Seleccione</option>
<?php print $cparroquia; ?>
</select></td>
<td align='right'><span class='rojo'>*</span> Ciudad:</td>
<td><select name='txtcodigo_ciudad' disabled='disabled' id='txtcodigo_ciudad' class='validate[required]'>
<option value=''>Seleccione</option>
<?php print $cciudad; ?>
</select></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Direccion:</td>
<td><textarea name='txtdireccion' maxlength='' disabled='disabled' id='txtdireccion' class='validate[required]'><?php print($lcDireccion);?></textarea></td>
<td align='right'>Correo:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtcorreo' value='<?php print($lcCorreo);?>' id='txtcorreo' class='validate[custom[email]]'/></td>
</tr>
<tr>
<td align='right'>Telefono:</td>
<td colspan="3"><input type='text' disabled='disabled' maxlength='11' name='txttelefono' value='<?php print($lcTelefono);?>' id='txttelefono' class='validate[custom[integer],maxSize[11],minSize[11]]'/></td>
</tr>

<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcRif); ?>'>
</table>
<?php $objFunciones->botonera_general('Tproveedor','total',$id); ?>
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