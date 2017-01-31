<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTproveedor extends clsDatos{
private $acRif;
private $acRazon_social;
private $estado;
private $municipio;
private $parroquia;
private $acCodigo_ciudad;
private $acDireccion;
private $acCorreo;
private $acTelefono;

//constructor de la clase		
public function __construct(){
$this->acRif = "";
$this->acRazon_social = "";
$this->acCodigo_ciudad = "";
$this->acDireccion = "";
$this->acCorreo = "";
$this->acTelefono = "";
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
	tp.rif,
	tp.razon_social,
	tp.codigo_ciudad,
	tp.direccion,
	tp.correo,
	tp.telefono,
	te.codigo as estado,
	tm.codigo as municipio,
	tpa.codigo as parroquia
from tproveedor as tp
inner join tciudad as tc on (tc.codigo = tp.codigo_ciudad)
inner join tparroquia as tpa on (tpa.codigo = tc.codigo_parroquia)
inner join tmunicipio as tm on (tm.codigo = tpa.codigo_municipio)
inner join testado as te on (te.codigo = tm.codigo_estado)
where(tp.rif = '$this->acRif')");


if($laRow=$this->arreglo())
{		
$this->acRif=$laRow['rif'];
$this->acRazon_social=$laRow['razon_social'];
$this->estado = $laRow["estado"];
$this->municipio = $laRow["municipio"];
$this->parroquia = $laRow["parroquia"];
$this->acCodigo_ciudad=$laRow['codigo_ciudad'];
$this->acDireccion=$laRow['direccion'];
$this->acCorreo=$laRow['correo'];
$this->acTelefono=$laRow['telefono'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from tproveedor where((rif like '%$valor%') or (razon_social like '%$valor%') or (codigo_ciudad like '%$valor%') or (direccion like '%$valor%') or (correo like '%$valor%') or (telefono like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acRif=$laRow['rif'];
$this->acRazon_social=$laRow['razon_social'];
$this->acCodigo_ciudad=$laRow['codigo_ciudad'];
$this->acDireccion=$laRow['direccion'];
$this->acCorreo=$laRow['correo'];
$this->acTelefono=$laRow['telefono'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
			   <td style='font-weight:bold; font-size:20px;'>Rif</td>
				<td style='font-weight:bold; font-size:20px;'>Razon Social</td>
				<td style='font-weight:bold; font-size:20px;'>Correo</td>
				<td style='font-weight:bold; font-size:20px;'>Telefono</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acRif."</td>
					<td>".$this->acRazon_social."</td>
					<td>".$this->acCorreo."</td>
					<td>".$this->acTelefono."</td>
					<td><a href='?txtrif=".$laRow['rif']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tproveedor(rif,razon_social,codigo_ciudad,direccion,correo,telefono)values('$this->acRif','$this->acRazon_social','$this->acCodigo_ciudad','$this->acDireccion','$this->acCorreo','$this->acTelefono')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tproveedor set rif = '$this->acRif', razon_social = '$this->acRazon_social', codigo_ciudad = '$this->acCodigo_ciudad', direccion = '$this->acDireccion', correo = '$this->acCorreo', telefono = '$this->acTelefono' where(rif = '$this->acRif')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tproveedor where(rif = '$this->acRif')");
}
//fin clase
}?>