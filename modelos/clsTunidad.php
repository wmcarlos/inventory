<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTunidad extends clsDatos{
private $acCodigo;
private $acNombre;
private $acCorreo;
private $acTelefono;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acNombre = "";
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
$this->ejecutar("select * from tunidad where(codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCorreo=$laRow['correo'];
$this->acTelefono=$laRow['telefono'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from tunidad where((codigo like '%$valor%') or (nombre like '%$valor%') or (correo like '%$valor%') or (telefono like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];
$this->acCorreo=$laRow['correo'];
$this->acTelefono=$laRow['telefono'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Correo</td>
				<td style='font-weight:bold; font-size:20px;'>Telefono</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acNombre."</td>
					<td>".$this->acCorreo."</td>
					<td>".$this->acTelefono."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tunidad(codigo,nombre,correo,telefono)values('$this->acCodigo','$this->acNombre','$this->acCorreo','$this->acTelefono')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tunidad set codigo = '$this->acCodigo', nombre = '$this->acNombre', correo = '$this->acCorreo', telefono = '$this->acTelefono' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tunidad where(codigo = '$this->acCodigo')");
}
//fin clase
}?>