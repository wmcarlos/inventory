<?php
require_once("../modelos/clsTparroquia.php");
$lobjTparroquia = new clsTparroquia();

$lobjTparroquia->acCodigo=$_REQUEST['txtcodigo'];
$lobjTparroquia->acNombre=$_POST['txtnombre'];
$lobjTparroquia->acCodigo_municipio=$_POST['txtcodigo_municipio'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTparroquia->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTparroquia->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTparroquia->buscar()){
			$lcCodigo=$lobjTparroquia->acCodigo;
			$lcNombre=$lobjTparroquia->acNombre;
			$lcCodigo_municipio=$lobjTparroquia->acCodigo_municipio; 
			$estado = $lobjTparroquia->estado;
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTparroquia->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTparroquia->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>