<?php
require_once("../modelos/clsTciudad.php");
$lobjTciudad = new clsTciudad();

$lobjTciudad->acCodigo=$_REQUEST['txtcodigo'];
$lobjTciudad->acNombre=$_POST['txtnombre'];
$lobjTciudad->acCodigo_parroquia=$_POST['txtcodigo_parroquia'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTciudad->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTciudad->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTciudad->buscar()){
			$lcCodigo=$lobjTciudad->acCodigo;
			$estado = $lobjTciudad->estado;
			$municipio = $lobjTciudad->municipio;
			$lcNombre=$lobjTciudad->acNombre;
			$lcCodigo_parroquia=$lobjTciudad->acCodigo_parroquia; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTciudad->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTciudad->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>