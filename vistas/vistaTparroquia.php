<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTparroquia.php');
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = $objFunciones->ultimo_id_plus1('tparroquia','codigo');
}else{
	$cmunicipio = $objFunciones->combo_segun_combo("tmunicipio","codigo","nombre","codigo_estado",$estado,$lcCodigo_municipio);
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion Parroquia</title>
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
<h1>Parroquia</h1>
<table border='1' class='datos' align='center'>
<tr style='display:none;'>
<td align='right'><span class='rojo'>*</span> codigo:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtcodigo' value='<?php print($lcCodigo);?>' id='txtcodigo' class='validate[required]'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Nombre:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtnombre' value='<?php print($lcNombre);?>' id='txtnombre' class='validate[required],custom[onlyLetterSp]'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Estado:</td>
<td><select name='txtcodigo_estado' disabled='disabled' id='txtcodigo_estado' class='validate[required], select_change' load_data="txtcodigo_municipio" operacion="listar_municipios">
	<option value=''>Seleccione</option>
	<?php print $objFunciones->crear_combo("testado","codigo","nombre",$estado); ?>
</select></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Municipio:</td>
<td><select name='txtcodigo_municipio' disabled='disabled' id='txtcodigo_municipio' class='validate[required]'>
	<option value=''>Seleccione</option>
	<?php print $cmunicipio; ?>
</select></td>
</tr>

<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcCodigo); ?>'>
</table>
<?php $objFunciones->botonera_general('Tparroquia','total',$id); ?>
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