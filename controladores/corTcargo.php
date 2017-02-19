<?php
require_once("../modelos/clsTcargo.php");
$lobjTcargo = new clsTcargo();

$lobjTcargo->acCodigo=$_REQUEST['txtcodigo'];
$lobjTcargo->acNombre=$_POST['txtnombre'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTcargo->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTcargo->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTcargo->buscar()){
			$lcCodigo=$lobjTcargo->acCodigo;
$lcNombre=$lobjTcargo->acNombre; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTcargo->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTcargo->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>