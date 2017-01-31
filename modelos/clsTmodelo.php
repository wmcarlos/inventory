<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTmodelo extends clsDatos{
private $acCodigo;
private $acNombre;
private $acCodigo_marca;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acNombre = "";
$this->acCodigo_marca = "";
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
$this->ejecutar("select * from tmodelo where(codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCodigo_marca=$laRow['codigo_marca'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select 
		tmodelo.*,
		tm.nombre as marca
		from tmodelo 
		inner join tmarca as tm on (tm.codigo = tmodelo.codigo_marca)
		where((tmodelo.codigo like '%$valor%') or (tmodelo.nombre like '%$valor%') or (tm.nombre like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCodigo_marca=$laRow['codigo_marca'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Marca a la que Pertenece</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acNombre."</td>
					<td>".$laRow["marca"]."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tmodelo(codigo,nombre,codigo_marca)values('$this->acCodigo','$this->acNombre','$this->acCodigo_marca')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tmodelo set codigo = '$this->acCodigo', nombre = '$this->acNombre', codigo_marca = '$this->acCodigo_marca' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tmodelo where(codigo = '$this->acCodigo')");
}
//fin clase
}?>