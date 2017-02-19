<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTpersonal.php');
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
<title>Gestion Personal</title>
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
<h1>Personal</h1>
<table border='1' class='datos' align='center'>
<tr >
<td align='right'><span class='rojo'>*</span> Cedula:</td>
<td><input type='text' disabled='disabled' maxlength='9' name='txtcedula' value='<?php print($lcCedula);?>' id='txtcedula' class='validate[required],custom[integer],maxSize[9],minSize[7],max[nnoo]'/></td>
<td align='right'><span class='rojo'>*</span> Nacionalidad:</td>
<td>V <input type='radio' name='txtnacionalidad' checked="checked" value='V'/> E <input type='radio' <?php if($lcNacionalidad == "E"){ print "checked='checked'"; }?> name='txtnacionalidad' value='E'/> </td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Nombres:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtnombres' value='<?php print($lcNombres);?>' id='txtnombres' class='validate[required],custom[onlyLetterSp]'/></td>
<td align='right'><span class='rojo'>*</span> Apellidos:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtappellidos' value='<?php print($lcAppellidos);?>' id='txtappellidos' class='validate[required],custom[onlyLetterSp]'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> sexo:</td>
<td>M <input type='radio' name='txtsexo' checked="checked" value='M'/> F <input type='radio' <?php if($lcSexo == "F"){ print "checked='checked'"; } ?> name='txtsexo' value='F'/> </td>
<td align='right'><span class='rojo'>*</span> Fecha de Nacimiento:</td>
<td><input type='text' disabled='disabled' name='txtfecha_nacimiento' value='<?php print($lcFecha_nacimiento);?>' id='txtfecha_nacimiento' class='validate[required] fecha_formateada'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Correo:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtcorreo' value='<?php print($lcCorreo);?>' id='txtcorreo' class='validate[required],custom[email]'/></td>
<td align='right'><span class='rojo'>*</span> Telefono:</td>
<td><input type='text' disabled='disabled' maxlength='11' name='txttelefono' value='<?php print($lcTelefono);?>' id='txttelefono' class='validate[required],custom[integer],maxSize[11],minSize[11]'/></td>
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
<tr>
<td align='right'><span class='rojo'>*</span> Direccion:</td>
<td><textarea name='txtdireccion' maxlength='' disabled='disabled' id='txtdireccion' class='validate[required]'><?php print($lcDireccion);?></textarea></td>
<td align='right'><span class='rojo'>*</span> Unidad:</td>
<td><select name='txtcodigo_unidad' disabled='disabled' id='txtcodigo_unidad' class='validate[required]'>
<option value=''>Seleccione</option>
<?php print $objFunciones->crear_combo("tunidad","codigo","nombre",$lcCodigo_unidad); ?>
</select></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Cargo:</td>
<td colspan="3"><select name='txtcodigo_cargo' disabled='disabled' id='txtcodigo_cargo' class='validate[required]'>
<option value=''>Seleccione</option>
<?php print $objFunciones->crear_combo("tcargo","codigo","nombre",$lcCodigo_cargo); ?>
</select></td>
</tr>

<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcCedula); ?>'>
</table>
<?php $objFunciones->botonera_general('Tpersonal','total',$id); ?>
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