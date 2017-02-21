<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTarticulo.php');
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = $objFunciones->ultimo_id_plus1('tarticulo','codigo');
}else{
	$cmodelos =  "<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tmodelo","codigo","nombre","codigo_marca",$marca,$lcCodigo_modelo);
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion Articulo</title>
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
<h1>Articulo</h1>
<table border='1' class='datos' align='center'>
<tr style='display:none;'>
<td align='right'><span class='rojo'>*</span> codigo:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtcodigo' value='<?php print($lcCodigo);?>' id='txtcodigo' class='validate[required]'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Nombre:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtnombre' value='<?php print($lcNombre);?>' id='txtnombre' class='validate[required],custom[onlyLetterSp]'/></td>
<td align='right'><span class='rojo'>*</span> Descripcion:</td>
<td><textarea name='txtdescripcion' maxlength='' disabled='disabled' id='txtdescripcion' class='validate[required]'><?php print($lcDescripcion);?></textarea></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Marca:</td>
<td><select name='txtcodigo_marca' disabled='disabled' id='txtcodigo_marca' class='validate[required] select_change' operacion="listar_modelos" load_data="txtcodigo_modelo">
<option value=''>Seleccione</option>
	<?php print $objFunciones->crear_combo("tmarca","codigo","nombre",$marca); ?>
</select></td>
<td align='right'><span class='rojo'>*</span> Modelo:</td>
<td><select name='txtcodigo_modelo' disabled='disabled' id='txtcodigo_modelo' class='validate[required]'>
<option value=''>Seleccione</option>
<?php print $cmodelos; ?>
</select></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Unidad de Medida:</td>
<td><select name='txtcodigo_unidad_medida' disabled='disabled' id='txtcodigo_unidad_medida' class='validate[required]'>
<option value=''>Seleccione</option>
	<?php print $objFunciones->crear_combo("tuniad_medida","codigo","nombre",$lcCodigo_unidad_medida); ?>
</select></td>
<td align='right'><span class='rojo'>*</span> Partida:</td>
<td><select name='txtcodigo_partida' disabled='disabled' id='txtcodigo_partida' class='validate[required]'>
<option value=''>Seleccione</option>
<?php print $objFunciones->crear_combo("tpartida","codigo","nombre",$lcCodigo_partida); ?>
</select></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Cantidad Minima:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtmin' value='<?php print($lcMin);?>' id='txtmin' class='validate[required],custom[integer],min[1]'/></td>
<td align='right'><span class='rojo'>*</span> Cantidad Maxima:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtmax' value='<?php print($lcMax);?>' id='txtmax' class='validate[required],custom[integer],min[1]'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Existencia:</td>
<td colspan="3"><input type='text' disabled='disabled' readonly="readOnly" maxlength='' name='txtexistencia' value='<?php print($lcExistencia);?>' id='txtexistencia' class='validate[custom[integer],min[0]'/></td>
</tr>

<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcCodigo); ?>'>
</table>
<?php $objFunciones->botonera_general('Tarticulo','total',$id); ?>
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