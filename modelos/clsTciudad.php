<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTciudad extends clsDatos{
private $acCodigo;
private $acNombre;
private $acCodigo_parroquia;
private $parroquia;
private $municipio;
private $estado;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acNombre = "";
$this->acCodigo_parroquia = "";
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
	tm.codigo as municipio,
	tc.codigo_parroquia,
	tc.codigo,
	tc.nombre
 	from tciudad as tc
 	inner join tparroquia as tp on (tc.codigo_parroquia = tp.codigo)
 	inner join tmunicipio as tm on (tp.codigo_municipio = tm.codigo)
 	inner join testado as te on (tm.codigo_estado = te.codigo)
	where(tc.codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->estado = $laRow["estado"];
$this->municipio = $laRow["municipio"];
$this->acNombre=$laRow['nombre'];
$this->acCodigo_parroquia=$laRow['codigo_parroquia'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select 
		tc.codigo,
		tc.nombre,
		tc.codigo_parroquia,
		tp.nombre as parroquia
		 from tciudad as tc
		 inner join tparroquia as tp on (tp.codigo = tc.codigo_parroquia)
		 where((tc.codigo like '%$valor%') or (tc.nombre like '%$valor%') or (tp.nombre like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCodigo_parroquia=$laRow['codigo_parroquia'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Parroquia a la que Pertenece</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acNombre."</td>
					<td>".$laRow["parroquia"]."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tciudad(codigo,nombre,codigo_parroquia)values('$this->acCodigo','$this->acNombre','$this->acCodigo_parroquia')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tciudad set codigo = '$this->acCodigo', nombre = '$this->acNombre', codigo_parroquia = '$this->acCodigo_parroquia' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tciudad where(codigo = '$this->acCodigo')");
}
//fin clase
}?>