<?php
require_once("../modelos/clsTproveedor.php");
$lobjTproveedor = new clsTproveedor();

$lobjTproveedor->acRif=$_REQUEST['txtrif'];
$lobjTproveedor->acRazon_social=$_POST['txtrazon_social'];
$lobjTproveedor->acCodigo_ciudad=$_POST['txtcodigo_ciudad'];
$lobjTproveedor->acDireccion=$_POST['txtdireccion'];
$lobjTproveedor->acCorreo=$_POST['txtcorreo'];
$lobjTproveedor->acTelefono=$_POST['txttelefono'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTproveedor->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTproveedor->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTproveedor->buscar()){
			$lcRif=$lobjTproveedor->acRif;
			$lcRazon_social=$lobjTproveedor->acRazon_social;
			$estado = $lobjTproveedor->estado;
			$municipio = $lobjTproveedor->municipio;
			$parroquia = $lobjTproveedor->parroquia;
			$lcCodigo_ciudad=$lobjTproveedor->acCodigo_ciudad;
			$lcDireccion=$lobjTproveedor->acDireccion;
			$lcCorreo=$lobjTproveedor->acCorreo;
			$lcTelefono=$lobjTproveedor->acTelefono; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTproveedor->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTproveedor->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>