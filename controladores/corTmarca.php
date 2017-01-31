<?php
require_once("../modelos/clsTmarca.php");
$lobjTmarca = new clsTmarca();

$lobjTmarca->acCodigo=$_REQUEST['txtcodigo'];
$lobjTmarca->acNombre=$_POST['txtnombre'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTmarca->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTmarca->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTmarca->buscar()){
			$lcCodigo=$lobjTmarca->acCodigo;
$lcNombre=$lobjTmarca->acNombre; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTmarca->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTmarca->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>