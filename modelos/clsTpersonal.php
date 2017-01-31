<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTpersonal extends clsDatos{
private $acCedula;
private $acNacionalidad;
private $acNombres;
private $acAppellidos;
private $acSexo;
private $acFecha_nacimiento;
private $acCorreo;
private $acTelefono;
private $estado;
private $municipio;
private $parroquia;
private $acCodigo_ciudad;
private $acDireccion;
private $acCodigo_unidad;
private $acCodigo_cargo;

//constructor de la clase		
public function __construct(){
$this->acCedula = "";
$this->acNacionalidad = "";
$this->acNombres = "";
$this->acAppellidos = "";
$this->acSexo = "";
$this->acFecha_nacimiento = "";
$this->acCorreo = "";
$this->acTelefono = "";
$this->acCodigo_ciudad = "";
$this->acDireccion = "";
$this->acCodigo_unidad = "";
$this->acCodigo_cargo = "";
}

//metodo magico set
public function __set($atributo, $valor){ $this->$atributo = strtoupper($valor);}		
//metodo get
public function __get($atributo){ return trim($this->$atributo); }
//destructor de la clase        
public function __destruct() { }
		
//funcion Buscar        
public function buscar()
{
$llEnc=false;
$this->ejecutar("select 
	tp.cedula,
	tp.nacionalidad,
	tp.nombres,
	tp.appellidos,
	tp.sexo,
	date_format(tp.fecha_nacimiento, '%d/%m/%Y') as fecha_nacimiento,
	tp.correo,
	tp.telefono,
	te.codigo as estado,
	tm.codigo as municipio,
	tpa.codigo as parroquia,
	tp.codigo_ciudad,
	tp.direccion,
	tp.codigo_unidad,
	tp.codigo_cargo
	from tpersonal as tp
	inner join tciudad as tc on (tc.codigo = tp.codigo_ciudad)
	inner join tparroquia as tpa on (tpa.codigo = tc.codigo_parroquia)
	inner join tmunicipio as tm on (tm.codigo = tpa.codigo_municipio)
	inner join testado as te on (te.codigo = tm.codigo_estado)
	where(tp.cedula = '$this->acCedula')");
if($laRow=$this->arreglo())
{		
$this->acCedula=$laRow['cedula'];
$this->acNacionalidad=$laRow['nacionalidad'];
$this->acNombres=$laRow['nombres'];
$this->acAppellidos=$laRow['appellidos'];
$this->acSexo=$laRow['sexo'];
$this->acFecha_nacimiento=$laRow['fecha_nacimiento'];
$this->acCorreo=$laRow['correo'];
$this->acTelefono=$laRow['telefono'];
$this->estado = $laRow["estado"];
$this->municipio = $laRow["municipio"];
$this->parroquia = $laRow["parroquia"];
$this->acCodigo_ciudad=$laRow['codigo_ciudad'];
$this->acDireccion=$laRow['direccion'];
$this->acCodigo_unidad=$laRow['codigo_unidad'];
$this->acCodigo_cargo=$laRow['codigo_cargo'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from tpersonal where((cedula like '%$valor%') or (nacionalidad like '%$valor%') or (nombres like '%$valor%') or (appellidos like '%$valor%') or (sexo like '%$valor%') or (fecha_nacimiento like '%$valor%') or (correo like '%$valor%') or (telefono like '%$valor%') or (codigo_ciudad like '%$valor%') or (direccion like '%$valor%') or (codigo_unidad like '%$valor%') or (codigo_cargo like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCedula=$laRow['cedula'];
$this->acNacionalidad=$laRow['nacionalidad'];
$this->acNombres=$laRow['nombres'];
$this->acAppellidos=$laRow['appellidos'];
$this->acSexo=$laRow['sexo'];
$this->acFecha_nacimiento=$laRow['fecha_nacimiento'];
$this->acCorreo=$laRow['correo'];
$this->acTelefono=$laRow['telefono'];
$this->acCodigo_ciudad=$laRow['codigo_ciudad'];
$this->acDireccion=$laRow['direccion'];
$this->acCodigo_unidad=$laRow['codigo_unidad'];
$this->acCodigo_cargo=$laRow['codigo_cargo'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
			   <td style='font-weight:bold; font-size:20px;'>Cedula</td>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Correo</td>
				<td style='font-weight:bold; font-size:20px;'>Telefono</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acNacionalidad."-".$this->acCedula."</td>
					<td>".$this->acNombres." ".$this->acAppellidos."</td>
					<td>".$this->acCorreo."</td>
					<td>".$this->acTelefono."</td>
					<td><a href='?txtcedula=".$laRow['cedula']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
	$part = explode("/", $this->acFecha_nacimiento);

	$this->acFecha_nacimiento = $part[2]."/".$part[1]."/".$part[0];
return $this->ejecutar("insert into tpersonal(cedula,nacionalidad,nombres,appellidos,sexo,fecha_nacimiento,correo,telefono,codigo_ciudad,direccion,codigo_unidad,codigo_cargo)values('$this->acCedula','$this->acNacionalidad','$this->acNombres','$this->acAppellidos','$this->acSexo','$this->acFecha_nacimiento','$this->acCorreo','$this->acTelefono','$this->acCodigo_ciudad','$this->acDireccion','$this->acCodigo_unidad','$this->acCodigo_cargo')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
	$part = explode("/", $this->acFecha_nacimiento);
	$this->acFecha_nacimiento = $part[2]."/".$part[1]."/".$part[0];
return $this->ejecutar("update tpersonal set cedula = '$this->acCedula', nacionalidad = '$this->acNacionalidad', nombres = '$this->acNombres', appellidos = '$this->acAppellidos', sexo = '$this->acSexo', fecha_nacimiento = '$this->acFecha_nacimiento', correo = '$this->acCorreo', telefono = '$this->acTelefono', codigo_ciudad = '$this->acCodigo_ciudad', direccion = '$this->acDireccion', codigo_unidad = '$this->acCodigo_unidad', codigo_cargo = '$this->acCodigo_cargo' where(cedula = '$this->acCedula')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tpersonal where(cedula = '$this->acCedula')");
}
//fin clase
}?>