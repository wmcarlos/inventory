<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTarticulo extends clsDatos{
private $acCodigo;
private $acNombre;
private $acDescripcion;
private $marca;
private $acCodigo_modelo;
private $acCodigo_unidad_medida;
private $acCodigo_partida;
private $acMin;
private $acMax;
private $acExistencia;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acNombre = "";
$this->acDescripcion = "";
$this->acCodigo_modelo = "";
$this->acCodigo_unidad_medida = "";
$this->acCodigo_partida = "";
$this->acMin = "";
$this->acMax = "";
$this->acExistencia = "";
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
$this->ejecutar("select tarticulo.*, tmo.codigo_marca from tarticulo
inner join tmodelo as tmo on (tmo.codigo = tarticulo.codigo_modelo)
where(tarticulo.codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acDescripcion=$laRow['descripcion'];
$this->marca = $laRow["codigo_marca"];
$this->acCodigo_modelo=$laRow['codigo_modelo'];
$this->acCodigo_unidad_medida=$laRow['codigo_unidad_medida'];
$this->acCodigo_partida=$laRow['codigo_partida'];
$this->acMin=$laRow['min'];
$this->acMax=$laRow['max'];
$this->acExistencia=$laRow['existencia'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from tarticulo where((codigo like '%$valor%') or (nombre like '%$valor%') or (descripcion like '%$valor%') or (codigo_modelo like '%$valor%') or (codigo_unidad_medida like '%$valor%') or (codigo_partida like '%$valor%') or (min like '%$valor%') or (max like '%$valor%') or (existencia like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acDescripcion=$laRow['descripcion'];
$this->acCodigo_modelo=$laRow['codigo_modelo'];
$this->acCodigo_unidad_medida=$laRow['codigo_unidad_medida'];
$this->acCodigo_partida=$laRow['codigo_partida'];
$this->acMin=$laRow['min'];
$this->acMax=$laRow['max'];
$this->acExistencia=$laRow['existencia'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>descripcion</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
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
return $this->ejecutar("insert into tarticulo(codigo,nombre,descripcion,codigo_modelo,codigo_unidad_medida,codigo_partida,min,max,existencia)values('$this->acCodigo','$this->acNombre','$this->acDescripcion','$this->acCodigo_modelo','$this->acCodigo_unidad_medida','$this->acCodigo_partida','$this->acMin','$this->acMax','$this->acExistencia')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tarticulo set codigo = '$this->acCodigo', nombre = '$this->acNombre', descripcion = '$this->acDescripcion', codigo_modelo = '$this->acCodigo_modelo', codigo_unidad_medida = '$this->acCodigo_unidad_medida', codigo_partida = '$this->acCodigo_partida', min = '$this->acMin', max = '$this->acMax', existencia = '$this->acExistencia' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tarticulo where(codigo = '$this->acCodigo')");
}
//fin clase
}?>