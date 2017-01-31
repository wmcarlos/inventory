<?php
require_once("../modelos/clsTmunicipio.php");
$lobjTmunicipio = new clsTmunicipio();

$lobjTmunicipio->acCodigo=$_REQUEST['txtcodigo'];
$lobjTmunicipio->acNombre=$_POST['txtnombre'];
$lobjTmunicipio->acCodigo_estado=$_POST['txtcodigo_estado'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTmunicipio->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTmunicipio->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTmunicipio->buscar()){
			$lcCodigo=$lobjTmunicipio->acCodigo;
$lcNombre=$lobjTmunicipio->acNombre;
$lcCodigo_estado=$lobjTmunicipio->acCodigo_estado; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTmunicipio->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTmunicipio->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>