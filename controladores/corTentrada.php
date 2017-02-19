<?php
require_once("../modelos/clsTentrada.php");
$lobjTentrada = new clsTentrada();

$lobjTentrada->acCodigo=$_REQUEST['txtcodigo'];
$lobjTentrada->acRif_proveedor=$_POST['txtrif_proveedor'];
$lobjTentrada->acNro_factura=$_POST['txtnro_factura'];
$lobjTentrada->acFecha_factura=$_POST['txtfecha_factura'];
$lobjTentrada->acObservacion=$_POST['txtobservacion'];
$lobjTentrada->acCodigo_partida=$_POST['txtcodigo_partida'];
$lobjTentrada->acFecha_entrada=$_POST['txtfecha_entrada'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTentrada->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTentrada->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTentrada->buscar()){
			$lcCodigo=$lobjTentrada->acCodigo;
$lcRif_proveedor=$lobjTentrada->acRif_proveedor;
$lcNro_factura=$lobjTentrada->acNro_factura;
$lcFecha_factura=$lobjTentrada->acFecha_factura;
$lcObservacion=$lobjTentrada->acObservacion;
$lcCodigo_partida=$lobjTentrada->acCodigo_partida;
$lcFecha_entrada=$lobjTentrada->acFecha_entrada; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTentrada->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTentrada->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>