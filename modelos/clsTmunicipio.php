<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTmunicipio extends clsDatos{
private $acCodigo;
private $acNombre;
private $acCodigo_estado;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acNombre = "";
$this->acCodigo_estado = "";
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
$this->ejecutar("select * from tmunicipio where(codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCodigo_estado=$laRow['codigo_estado'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select tm.codigo, tm.nombre, te.nombre as estado from tmunicipio as tm 
	inner join testado as te on (tm.codigo_estado = te.codigo) 
	where((tm.codigo like '%$valor%') or (tm.nombre like '%$valor%') or (te.nombre like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCodigo_estado=$laRow['codigo_estado'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Estado al que Pertenece</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acNombre."</td>
					<td>".$laRow["estado"]."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tmunicipio(codigo,nombre,codigo_estado)values('$this->acCodigo','$this->acNombre','$this->acCodigo_estado')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tmunicipio set codigo = '$this->acCodigo', nombre = '$this->acNombre', codigo_estado = '$this->acCodigo_estado' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tmunicipio where(codigo = '$this->acCodigo')");
}
//fin clase
}?>