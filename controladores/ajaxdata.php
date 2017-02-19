<?php
//Cantidad de Atributos y clase
require_once("../modelos/clsFunciones.php");
$clase = "cls".$_POST['clase'];
$operacion = $_POST['operacion'];
$datos = $_POST['datos'];
if(!isset($operacion)){
require_once("../modelos/".$clase.".php");
$obj = new $clase();
print($obj->busqueda_ajax($datos));
}else{
	$objFunciones = new clsFunciones();
	//Otra Manera
	switch($operacion){
		case "listar_municipios":
			print "<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tmunicipio","codigo","nombre","codigo_estado",$datos,"");
		break;
		case "listar_parroquias":
			print "<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tparroquia","codigo","nombre","codigo_municipio",$datos,"");
		break;
		case "listar_ciudades":
			print "<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tciudad","codigo","nombre","codigo_parroquia",$datos,"");
		break;
		case "listar_modelos":
			print "<option value=''>Seleccione</option>".$objFunciones->combo_segun_combo("tmodelo","codigo","nombre","codigo_marca",$datos,"");
		break;
	}	
}
?>