<?php
require_once("../modelos/clsTsalida.php");
$lobjTsalida = new clsTsalida();

$lobjTsalida->acCodigo=$_REQUEST['txtcodigo'];
$lobjTsalida->acFecha_salida=$_POST['txtfecha_salida'];
$lobjTsalida->acCedula_personal=$_POST['txtcedula_personal'];
$lobjTsalida->acNro_solicitud=$_POST['txtnro_solicitud'];
$lobjTsalida->acFecha_solicitud=$_POST['txtfecha_solicitud'];
$lobjTsalida->acObservacion=$_POST['txtobservacion'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTsalida->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTsalida->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTsalida->buscar()){
			$lcCodigo=$lobjTsalida->acCodigo;
$lcFecha_salida=$lobjTsalida->acFecha_salida;
$lcCedula_personal=$lobjTsalida->acCedula_personal;
$lcNro_solicitud=$lobjTsalida->acNro_solicitud;
$lcFecha_solicitud=$lobjTsalida->acFecha_solicitud;
$lcObservacion=$lobjTsalida->acObservacion; 
$unidad = $lobjTsalida->unidad;
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTsalida->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTsalida->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>