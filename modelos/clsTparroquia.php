<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTparroquia extends clsDatos{
private $acCodigo;
private $acNombre;
private $acCodigo_municipio;
private $estado;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acNombre = "";
$this->acCodigo_municipio = "";
$this->estado = "";
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
		te.codigo as estado,
		tp.codigo,
		tp.nombre,
		tp.codigo_municipio,
		tp.estatus
	 	from tparroquia as tp
	 	inner join tmunicipio as tm on (tp.codigo_municipio = tm.codigo)
	 	inner join testado as te on (tm.codigo_estado = te.codigo)
	 	where(tp.codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCodigo_municipio=$laRow['codigo_municipio'];	
$this->estado = $laRow["estado"];	
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select 
		tp.codigo,
		tp.codigo_municipio,
		tm.nombre as municipio,
		tp.nombre
		from tparroquia tp
		inner join tmunicipio as tm on (tm.codigo = tp.codigo_municipio)
		where((tp.codigo like '%$valor%') or (tp.nombre like '%$valor%') or (tm.nombre like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCodigo_municipio=$laRow['codigo_municipio'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Municipio al que Pertenece</td>
				<td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acNombre."</td>
					<td>".$laRow["municipio"]."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tparroquia(codigo,nombre,codigo_municipio)values('$this->acCodigo','$this->acNombre','$this->acCodigo_municipio')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tparroquia set codigo = '$this->acCodigo', nombre = '$this->acNombre', codigo_municipio = '$this->acCodigo_municipio' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tparroquia where(codigo = '$this->acCodigo')");
}
//fin clase
}?>