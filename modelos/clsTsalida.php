<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTsalida extends clsDatos{
private $acCodigo;
private $acFecha_salida;
private $acCedula_personal;
private $acNro_solicitud;
private $acFecha_solicitud;
private $acObservacion;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acFecha_salida = "";
$this->acCedula_personal = "";
$this->acNro_solicitud = "";
$this->acFecha_solicitud = "";
$this->acObservacion = "";
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
$this->ejecutar("select * from tsalida where(codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acFecha_salida=$laRow['fecha_salida'];
$this->acCedula_personal=$laRow['cedula_personal'];
$this->acNro_solicitud=$laRow['nro_solicitud'];
$this->acFecha_solicitud=$laRow['fecha_solicitud'];
$this->acObservacion=$laRow['observacion'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from tsalida where((codigo like '%$valor%') or (fecha_salida like '%$valor%') or (cedula_personal like '%$valor%') or (nro_solicitud like '%$valor%') or (fecha_solicitud like '%$valor%') or (observacion like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acFecha_salida=$laRow['fecha_salida'];
$this->acCedula_personal=$laRow['cedula_personal'];
$this->acNro_solicitud=$laRow['nro_solicitud'];
$this->acFecha_solicitud=$laRow['fecha_solicitud'];
$this->acObservacion=$laRow['observacion'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
			   <td style='font-weight:bold; font-size:20px;'>codigo</td>
<td style='font-weight:bold; font-size:20px;'>fecha_salida</td>
<td style='font-weight:bold; font-size:20px;'>cedula_personal</td>
<td style='font-weight:bold; font-size:20px;'>nro_solicitud</td>
<td style='font-weight:bold; font-size:20px;'>fecha_solicitud</td>
<td style='font-weight:bold; font-size:20px;'>observacion</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acCodigo."</td>
<td>".$this->acFecha_salida."</td>
<td>".$this->acCedula_personal."</td>
<td>".$this->acNro_solicitud."</td>
<td>".$this->acFecha_solicitud."</td>
<td>".$this->acObservacion."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tsalida(codigo,fecha_salida,cedula_personal,nro_solicitud,fecha_solicitud,observacion)values('$this->acCodigo','$this->acFecha_salida','$this->acCedula_personal','$this->acNro_solicitud','$this->acFecha_solicitud','$this->acObservacion')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tsalida set codigo = '$this->acCodigo', fecha_salida = '$this->acFecha_salida', cedula_personal = '$this->acCedula_personal', nro_solicitud = '$this->acNro_solicitud', fecha_solicitud = '$this->acFecha_solicitud', observacion = '$this->acObservacion' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tsalida where(codigo = '$this->acCodigo')");
}
//fin clase
}?>