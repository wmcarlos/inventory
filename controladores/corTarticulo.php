<?php
require_once("../modelos/clsTarticulo.php");
$lobjTarticulo = new clsTarticulo();

$lobjTarticulo->acCodigo=$_REQUEST['txtcodigo'];
$lobjTarticulo->acNombre=$_POST['txtnombre'];
$lobjTarticulo->acDescripcion=$_POST['txtdescripcion'];
$lobjTarticulo->acCodigo_modelo=$_POST['txtcodigo_modelo'];
$lobjTarticulo->acCodigo_unidad_medida=$_POST['txtcodigo_unidad_medida'];
$lobjTarticulo->acCodigo_partida=$_POST['txtcodigo_partida'];
$lobjTarticulo->acMin=$_POST['txtmin'];
$lobjTarticulo->acMax=$_POST['txtmax'];
$lobjTarticulo->acExistencia=$_POST['txtexistencia'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTarticulo->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTarticulo->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTarticulo->buscar()){
			$lcCodigo=$lobjTarticulo->acCodigo;
			$lcNombre=$lobjTarticulo->acNombre;
			$lcDescripcion=$lobjTarticulo->acDescripcion;
			$marca = $lobjTarticulo->marca;
			$lcCodigo_modelo=$lobjTarticulo->acCodigo_modelo;
			$lcCodigo_unidad_medida=$lobjTarticulo->acCodigo_unidad_medida;
			$lcCodigo_partida=$lobjTarticulo->acCodigo_partida;
			$lcMin=$lobjTarticulo->acMin;
			$lcMax=$lobjTarticulo->acMax;
			$lcExistencia=$lobjTarticulo->acExistencia; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTarticulo->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTarticulo->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>