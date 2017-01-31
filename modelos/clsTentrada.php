<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTentrada extends clsDatos{
private $acCodigo;
private $acRif_proveedor;
private $acNro_factura;
private $acFecha_factura;
private $acObservacion;
private $acCodigo_partida;
private $acFecha_entrada;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acRif_proveedor = "";
$this->acNro_factura = "";
$this->acFecha_factura = "";
$this->acObservacion = "";
$this->acCodigo_partida = "";
$this->acFecha_entrada = "";
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
$this->ejecutar("select * from tentrada where(codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acRif_proveedor=$laRow['rif_proveedor'];
$this->acNro_factura=$laRow['nro_factura'];
$this->acFecha_factura=$laRow['fecha_factura'];
$this->acObservacion=$laRow['observacion'];
$this->acCodigo_partida=$laRow['codigo_partida'];
$this->acFecha_entrada=$laRow['fecha_entrada'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from tentrada where((codigo like '%$valor%') or (rif_proveedor like '%$valor%') or (nro_factura like '%$valor%') or (fecha_factura like '%$valor%') or (observacion like '%$valor%') or (codigo_partida like '%$valor%') or (fecha_entrada like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acRif_proveedor=$laRow['rif_proveedor'];
$this->acNro_factura=$laRow['nro_factura'];
$this->acFecha_factura=$laRow['fecha_factura'];
$this->acObservacion=$laRow['observacion'];
$this->acCodigo_partida=$laRow['codigo_partida'];
$this->acFecha_entrada=$laRow['fecha_entrada'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
			   <td style='font-weight:bold; font-size:20px;'>codigo</td>
<td style='font-weight:bold; font-size:20px;'>rif_proveedor</td>
<td style='font-weight:bold; font-size:20px;'>nro_factura</td>
<td style='font-weight:bold; font-size:20px;'>fecha_factura</td>
<td style='font-weight:bold; font-size:20px;'>observacion</td>
<td style='font-weight:bold; font-size:20px;'>codigo_partida</td>
<td style='font-weight:bold; font-size:20px;'>fecha_entrada</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acCodigo."</td>
<td>".$this->acRif_proveedor."</td>
<td>".$this->acNro_factura."</td>
<td>".$this->acFecha_factura."</td>
<td>".$this->acObservacion."</td>
<td>".$this->acCodigo_partida."</td>
<td>".$this->acFecha_entrada."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tentrada(codigo,rif_proveedor,nro_factura,fecha_factura,observacion,codigo_partida,fecha_entrada)values('$this->acCodigo','$this->acRif_proveedor','$this->acNro_factura','$this->acFecha_factura','$this->acObservacion','$this->acCodigo_partida','$this->acFecha_entrada')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tentrada set codigo = '$this->acCodigo', rif_proveedor = '$this->acRif_proveedor', nro_factura = '$this->acNro_factura', fecha_factura = '$this->acFecha_factura', observacion = '$this->acObservacion', codigo_partida = '$this->acCodigo_partida', fecha_entrada = '$this->acFecha_entrada' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tentrada where(codigo = '$this->acCodigo')");
}
//fin clase
}?>