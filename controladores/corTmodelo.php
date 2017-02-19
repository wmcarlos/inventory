<?php
require_once("../modelos/clsTmodelo.php");
$lobjTmodelo = new clsTmodelo();

$lobjTmodelo->acCodigo=$_REQUEST['txtcodigo'];
$lobjTmodelo->acNombre=$_POST['txtnombre'];
$lobjTmodelo->acCodigo_marca=$_POST['txtcodigo_marca'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTmodelo->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTmodelo->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTmodelo->buscar()){
			$lcCodigo=$lobjTmodelo->acCodigo;
$lcNombre=$lobjTmodelo->acNombre;
$lcCodigo_marca=$lobjTmodelo->acCodigo_marca; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTmodelo->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTmodelo->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>