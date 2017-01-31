<?php
require_once("../modelos/clsTuniad_medida.php");
$lobjTuniad_medida = new clsTuniad_medida();

$lobjTuniad_medida->acCodigo=$_REQUEST['txtcodigo'];
$lobjTuniad_medida->acNombre=$_POST['txtnombre'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTuniad_medida->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTuniad_medida->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTuniad_medida->buscar()){
			$lcCodigo=$lobjTuniad_medida->acCodigo;
$lcNombre=$lobjTuniad_medida->acNombre; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTuniad_medida->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTuniad_medida->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>