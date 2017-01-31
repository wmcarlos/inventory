<?php
require_once("../modelos/clsTunidad.php");
$lobjTunidad = new clsTunidad();

$lobjTunidad->acCodigo=$_REQUEST['txtcodigo'];
$lobjTunidad->acNombre=$_POST['txtnombre'];
$lobjTunidad->acCorreo=$_POST['txtcorreo'];
$lobjTunidad->acTelefono=$_POST['txttelefono'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTunidad->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTunidad->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTunidad->buscar()){
			$lcCodigo=$lobjTunidad->acCodigo;
$lcNombre=$lobjTunidad->acNombre;
$lcCorreo=$lobjTunidad->acCorreo;
$lcTelefono=$lobjTunidad->acTelefono; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTunidad->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTunidad->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>