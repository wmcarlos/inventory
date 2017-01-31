<?php
require_once("../modelos/clsTpersonal.php");
$lobjTpersonal = new clsTpersonal();

$lobjTpersonal->acCedula=$_REQUEST['txtcedula'];
$lobjTpersonal->acNacionalidad=$_POST['txtnacionalidad'];
$lobjTpersonal->acNombres=$_POST['txtnombres'];
$lobjTpersonal->acAppellidos=$_POST['txtappellidos'];
$lobjTpersonal->acSexo=$_POST['txtsexo'];
$lobjTpersonal->acFecha_nacimiento=$_POST['txtfecha_nacimiento'];
$lobjTpersonal->acCorreo=$_POST['txtcorreo'];
$lobjTpersonal->acTelefono=$_POST['txttelefono'];
$lobjTpersonal->acCodigo_ciudad=$_POST['txtcodigo_ciudad'];
$lobjTpersonal->acDireccion=$_POST['txtdireccion'];
$lobjTpersonal->acCodigo_unidad=$_POST['txtcodigo_unidad'];
$lobjTpersonal->acCodigo_cargo=$_POST['txtcodigo_cargo'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTpersonal->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTpersonal->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTpersonal->buscar()){
			$lcCedula=$lobjTpersonal->acCedula;
			$lcNacionalidad=$lobjTpersonal->acNacionalidad;
			$lcNombres=$lobjTpersonal->acNombres;
			$lcAppellidos=$lobjTpersonal->acAppellidos;
			$lcSexo=$lobjTpersonal->acSexo;
			$lcFecha_nacimiento=$lobjTpersonal->acFecha_nacimiento;
			$lcCorreo=$lobjTpersonal->acCorreo;
			$lcTelefono=$lobjTpersonal->acTelefono;
			$estado = $lobjTpersonal->estado;
			$municipio = $lobjTpersonal->municipio;
			$parroquia = $lobjTpersonal->parroquia;
			$lcCodigo_ciudad=$lobjTpersonal->acCodigo_ciudad;
			$lcDireccion=$lobjTpersonal->acDireccion;
			$lcCodigo_unidad=$lobjTpersonal->acCodigo_unidad;
			$lcCodigo_cargo=$lobjTpersonal->acCodigo_cargo; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTpersonal->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTpersonal->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>