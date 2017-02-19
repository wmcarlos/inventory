<?php
require_once("../modelos/clsTpartida.php");
$lobjTpartida = new clsTpartida();

$lobjTpartida->acCodigo=$_REQUEST['txtcodigo'];
$lobjTpartida->acIdentificador=$_POST['txtidentificador'];
$lobjTpartida->acNombre=$_POST['txtnombre'];
$lobjTpartida->acDescripcion=$_POST['txtdescripcion'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTpartida->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTpartida->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTpartida->buscar()){
			$lcCodigo=$lobjTpartida->acCodigo;
$lcIdentificador=$lobjTpartida->acIdentificador;
$lcNombre=$lobjTpartida->acNombre;
$lcDescripcion=$lobjTpartida->acDescripcion; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTpartida->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTpartida->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>