<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTsalida.php');
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = $lcCodigo;
}else{
	$enlace = "<a href='#' target='_blank' style='float:right; margin-right:20px; text-decoration:none;' id='reporte'>Imprimir Despacho</a>";
	$combo_personal = "<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tpersonal","cedula","concat(nombres,' ',appellidos)","codigo_unidad",$unidad,$lcCedula_personal);
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
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
<h1>Despacho <?php print $enlace; ?></h1>
<table border='1' class='datos' align='center'>
<tr >
<td align='right'><span class='rojo'>*</span> Nro. Despacho:</td>
<td><input type='text' disabled='disabled' size="3" readonly="readOnly" maxlength='' name='txtcodigo' value='<?php print($lcCodigo);?>' id='txtcodigo' class='validate[required]'/></td>
<td align='right'><span class='rojo'>*</span> Fecha Despacho:</td>
<td><input type='text' disabled='disabled' name='txtfecha_salida' value='<?php print($lcFecha_salida);?>' id='txtfecha_salida' class='range_formateada'/></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Departamento:</td>
<td>
	<select name='txtunidad' disabled='disabled' operacion="listar_personal" load_data="txtcedula_personal" id='txtunidad' class='validate[required] select_change'>
	<option value=''>Seleccione</option>
	<?php print $objFunciones->crear_combo("tunidad","codigo","nombre",$unidad);?>
	</select></td>
<td align='right'><span class='rojo'>*</span> Trabajador:</td>
<td><select name='txtcedula_personal' disabled='disabled' id='txtcedula_personal' class='validate[required]'>
<option value=''>Seleccione</option>
<?php print $combo_personal; ?>
</select></td>
</tr>
<tr>
<td align='right'><span class='rojo'>*</span> Nro Solicitud:</td>
<td><input type='text' disabled='disabled' maxlength='' name='txtnro_solicitud' value='<?php print($lcNro_solicitud);?>' id='txtnro_solicitud' class='validate[required]'/></td>
<td align='right'><span class='rojo'>*</span> Fecha Solicitud:</td>
<td><input type='text' disabled='disabled' name='txtfecha_solicitud' value='<?php print($lcFecha_solicitud);?>' id='txtfecha_solicitud' class='validate[required] range_formateada'/></td>
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
	<td>Articulo</td>
	<td>Unidad de Medida</td>
	<td>Existencia</td>
	<td>Cant. Desp</td>
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
	<td>
		<input type="text" disabled="disabled" name="txtexistencia" readonly="readonly" id="txtexistencia"/>
	</td>
	<td><input type="text" name="txtcantidad" disabled="disabled" id="txtcantidad" size="5"/></td>
	<td><button type="button" onclick="addline();">+</button></td>
</tr>
<tbody id="content-details">
	<?php print $caddespacho; ?>
</tbody>
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
	            var ex = data[3];
	            $("#txtcodigo_articulo").val(cod);
	            $("#txttext_articulo").val(text);
	            $("#txtunidad_medida").val(um);
	            $("#txtexistencia").val(ex);
	            $("#txtcantidad").focus();
	        }
	    });

	    var operation = "<?php print $_GET['txtoperacion']; ?>";

	    if(operation == "buscar"){
	    	var nro_despacho = document.getElementById("txtcodigo").value;
	    	var fecha_despacho = document.getElementById("txtfecha_salida").value;
	    	var departamento = document.getElementById("txtunidad").options[document.getElementById("txtunidad").selectedIndex].text;
	    	var empleado = document.getElementById("txtcedula_personal").options[document.getElementById("txtcedula_personal").selectedIndex].text;
	    	var nro_solicitud = document.getElementById("txtnro_solicitud").value;
	    	var fecha_solicitud = document.getElementById("txtfecha_solicitud").value;
	    	var observacion = document.getElementById("txtobservacion").value;

	    	var link = "reporte_despacho.php?nro_despacho="+nro_despacho+"&fecha_despacho="+fecha_despacho+"&departamento="+departamento+"&trabajador="+empleado+"&nro_solicitud="+nro_solicitud+"&fecha_solicitud="+fecha_solicitud+"&observacion="+observacion;
	    	
	    	document.getElementById("reporte").setAttribute("href",link);
	    }


	});



</script>
</body>
</html>