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
$this->ejecutar("select *, date_format(fecha_factura, '%d/%m/%Y') as fecha_factura, date_format(fecha_entrada, '%d/%m/%Y') as fecha_entrada from tentrada where(codigo = '$this->acCodigo')");
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
$lrTb=$this->ejecutar("select *, date_format(fecha_factura, '%d/%m/%Y') as fecha_factura, date_format(fecha_entrada, '%d/%m/%Y') as fecha_entrada from tentrada where((codigo like '%$valor%') or (rif_proveedor like '%$valor%') or (nro_factura like '%$valor%') or (fecha_factura like '%$valor%') or (observacion like '%$valor%') or (codigo_partida like '%$valor%') or (fecha_entrada like '%$valor%'))");
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
				<td style='font-weight:bold; font-size:20px;'>Proveedor</td>
				<td style='font-weight:bold; font-size:20px;'>Nro Factura</td>
				<td style='font-weight:bold; font-size:20px;'>Fecha de Factura</td>
				<td style='font-weight:bold; font-size:20px;'>Observacion</td>
				<td style='font-weight:bold; font-size:20px;'>Fecha de Entrada</td>
				<td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acRif_proveedor."</td>
					<td>".$this->acNro_factura."</td>
					<td>".$this->acFecha_factura."</td>
					<td>".$this->acObservacion."</td>
					<td>".$this->acFecha_entrada."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
$fecrep = explode("/", $this->acFecha_entrada);
$fecfac = explode("/", $this->acFecha_factura);

$this->acFecha_entrada = $fecrep[2]."/".$fecrep[1]."/".$fecrep[0];
$this->acFecha_factura = $fecfac[2]."/".$fecfac[1]."/".$fecfac[0];

return $this->ejecutar("insert into tentrada(codigo,rif_proveedor,nro_factura,fecha_factura,observacion,codigo_partida,fecha_entrada)values('$this->acCodigo','$this->acRif_proveedor','$this->acNro_factura','$this->acFecha_factura','$this->acObservacion','$this->acCodigo_partida','$this->acFecha_entrada')");
}

public function incluir_detalle($producto, $cantidad){
	return $this->ejecutar("insert into tlinea_entrada (codigo_entrada,codigo_articulo,cantidad)
	 values ($this->acCodigo,$producto,$cantidad)");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
$fecrep = explode("/", $this->acFecha_entrada);
$fecfac = explode("/", $this->acFecha_factura);

$this->acFecha_entrada = $fecrep[2]."/".$fecrep[1]."/".$fecrep[0];
$this->acFecha_factura = $fecfac[2]."/".$fecfac[1]."/".$fecfac[0];
return $this->ejecutar("update tentrada set codigo = '$this->acCodigo', rif_proveedor = '$this->acRif_proveedor', nro_factura = '$this->acNro_factura', fecha_factura = '$this->acFecha_factura', observacion = '$this->acObservacion', codigo_partida = '$this->acCodigo_partida', fecha_entrada = '$this->acFecha_entrada' where(codigo = '$this->acCodigo')");
}


public function listar_productos(){
	$cad = '';
	$this->ejecutar("
		select 
			ta.codigo as codigo,
			ta.nombre as articulo,
			tum.nombre as unidad_medida
		from 
		tarticulo as ta
		inner join tuniad_medida as tum on (tum.codigo = ta.codigo_unidad_medida)
		order by ta.nombre asc");
	while($laRow=$this->arreglo())
	{			
		$cad.='"'.$laRow["codigo"].'-'.$laRow["articulo"].'-'.$laRow["unidad_medida"].'",';
	}
	return $cad;
} 

public function deleteline(){
	return $this->ejecutar("delete from tlinea_entrada where codigo_entrada = $this->acCodigo");
}

public function listar_detalles(){
	$cad = '';
	$this->ejecutar("
		select 
			le.codigo_articulo,
			ta.nombre as articulo,
			tum.nombre as unidad_medida,
			le.cantidad
		from tlinea_entrada as le
		inner join tarticulo as ta on (ta.codigo = le.codigo_articulo)
		inner join tuniad_medida as tum on (ta.codigo_unidad_medida = tum.codigo)
		where le.codigo_entrada = $this->acCodigo");
	while($laRow=$this->arreglo())
	{
		$cad.="<tr>";
			$cad.="<td><input type='hidden' name='articulos[]' value='".$laRow["codigo_articulo"]."'>".$laRow["articulo"]."</td>";
			$cad.="<td>".$laRow["unidad_medida"]."</td>";
			$cad.="<td><input type='hidden' name='cantidades[]' value='".$laRow["cantidad"]."'>".$laRow["cantidad"]."</td>";
			$cad.="<td><button type='button' onclick='delline(this);'>x</button></td>";
		$cad.="</tr>";
	}
	return $cad;
}

//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tentrada where(codigo = '$this->acCodigo')");
}
//fin clase
}?>