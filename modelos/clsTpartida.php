<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTpartida extends clsDatos{
private $acCodigo;
private $acIdentificador;
private $acNombre;
private $acDescripcion;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acIdentificador = "";
$this->acNombre = "";
$this->acDescripcion = "";
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
$this->ejecutar("select * from tpartida where(codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acIdentificador=$laRow['identificador'];
$this->acNombre=$laRow['nombre'];
$this->acDescripcion=$laRow['descripcion'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from tpartida where((codigo like '%$valor%') or (identificador like '%$valor%') or (nombre like '%$valor%') or (descripcion like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acIdentificador=$laRow['identificador'];
$this->acNombre=$laRow['nombre'];
$this->acDescripcion=$laRow['descripcion'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
				<td style='font-weight:bold; font-size:20px;'>Identificador</td>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Descripcion</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acIdentificador."</td>
					<td>".$this->acNombre."</td>
					<td>".$this->acDescripcion."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tpartida(codigo,identificador,nombre,descripcion)values('$this->acCodigo','$this->acIdentificador','$this->acNombre','$this->acDescripcion')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tpartida set codigo = '$this->acCodigo', identificador = '$this->acIdentificador', nombre = '$this->acNombre', descripcion = '$this->acDescripcion' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tpartida where(codigo = '$this->acCodigo')");
}
//fin clase
}?>