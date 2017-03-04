<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTsalida extends clsDatos{
private $acCodigo;
private $acFecha_salida;
private $acCedula_personal;
private $acNro_solicitud;
private $acFecha_solicitud;
private $acObservacion;
private $unidad;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acFecha_salida = "";
$this->acCedula_personal = "";
$this->acNro_solicitud = "";
$this->acFecha_solicitud = "";
$this->acObservacion = "";
$this->unidad = "";
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
$this->ejecutar("
	select 
	date_format(ts.fecha_solicitud, '%d/%m/%Y') as fecha_solicitud, 
	date_format(ts.fecha_salida, '%d/%m/%Y') as fecha_salida,
	ts.codigo as codigo,
	ts.cedula_personal as cedula_personal,
	ts.nro_solicitud,
	ts.observacion,
	tun.codigo as unidad 
	from tsalida as ts
	inner join tpersonal as tp on (tp.cedula = ts.cedula_personal)
	inner join tunidad as tun on (tun.codigo = tp.codigo_unidad)
	where(ts.codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
	$this->acCodigo=$laRow['codigo'];
	$this->acFecha_salida=$laRow['fecha_salida'];
	$this->acCedula_personal=$laRow['cedula_personal'];
	$this->acNro_solicitud=$laRow['nro_solicitud'];
	$this->acFecha_solicitud=$laRow['fecha_solicitud'];
	$this->acObservacion=$laRow['observacion'];		
	$this->unidad = $laRow["unidad"];
$llEnc=true;
}
return $llEnc;
}

public function lastnro(){
	$nro = 0;
	$this->ejecutar("select codigo from tsalida order by codigo desc limit 1");
	if($row = $this->arreglo()){
		$nro = $row['codigo'] + 1;
	}
	return $nro;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select *, date_format(fecha_solicitud, '%d/%m/%Y') as fecha_solicitud, date_format(fecha_salida, '%d/%m/%Y') as fecha_salida from tsalida where((codigo like '%$valor%') or (fecha_salida like '%$valor%') or (cedula_personal like '%$valor%') or (nro_solicitud like '%$valor%') or (fecha_solicitud like '%$valor%') or (observacion like '%$valor%'))");
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
			   <td style='font-weight:bold; font-size:20px;'>Nro Salida</td>
				<td style='font-weight:bold; font-size:20px;'>Fecha Salida</td>
				<td style='font-weight:bold; font-size:20px;'>Nro solicitud</td>
				<td style='font-weight:bold; font-size:20px;'>Fecha Solicitud</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acCodigo."</td>
					<td>".$this->acFecha_salida."</td>
					<td>".$this->acNro_solicitud."</td>
					<td>".$this->acFecha_solicitud."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

public function incluir_detalle($producto, $cantidad){
	return $this->ejecutar("insert into tlinea_salida (codigo_salida,codigo_articulo,cantidad)
	 values ($this->acCodigo,$producto,$cantidad)");
}

public function listar_productos(){
	$cad = '';
	$this->ejecutar("
		select 
			ta.codigo as codigo,
			ta.nombre as articulo,
			tum.nombre as unidad_medida,
			ta.existencia
		from 
		tarticulo as ta
		inner join tuniad_medida as tum on (tum.codigo = ta.codigo_unidad_medida)
		order by ta.nombre asc");
	while($laRow=$this->arreglo())
	{			
		$cad.='"'.$laRow["codigo"].'-'.$laRow["articulo"].'-'.$laRow["unidad_medida"].'-'.$laRow["existencia"].'",';
	}
	return $cad;
} 

//funcion inlcuir
public function incluir()
{
	$fecsal = explode("/",$this->acFecha_salida);
	$fecsol = explode("/", $this->acFecha_solicitud);
	$this->acFecha_salida = $fecsal[2]."/".$fecsal[1]."/".$fecsal[0];
	$this->acFecha_solicitud = $fecsol[2]."/".$fecsol[1]."/".$fecsol[0];

return $this->ejecutar("insert into tsalida(codigo,fecha_salida,cedula_personal,nro_solicitud,fecha_solicitud,observacion)values('$this->acCodigo','$this->acFecha_salida','$this->acCedula_personal','$this->acNro_solicitud','$this->acFecha_solicitud','$this->acObservacion')");
}

public function deleteline(){
	return $this->ejecutar("delete from tlinea_salida where codigo_salida = $this->acCodigo");
}

public function listar_detalles(){
	$cad = '';
	$this->ejecutar("
		select 
			le.codigo_articulo,
			ta.nombre as articulo,
			tum.nombre as unidad_medida,
			le.cantidad
		from tlinea_salida as le
		inner join tarticulo as ta on (ta.codigo = le.codigo_articulo)
		inner join tuniad_medida as tum on (ta.codigo_unidad_medida = tum.codigo)
		where le.codigo_salida = $this->acCodigo");
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

public function resinventory($producto, $cantidad){
	$actual = 0;
	$this->ejecutar("select existencia from tarticulo where codigo = $producto");
	if($row = $this->arreglo()){
		$actual = $row["existencia"];
	}
	$total = $actual - $cantidad;
	$this->ejecutar("update tarticulo set existencia = $total where codigo = $producto");
}

//funcion modificar
public function modificar($lcVarTem)
{
	$fecsal = explode("/",$this->acFecha_salida);
	$fecsol = explode("/", $this->acFecha_solicitud);
	$this->acFecha_salida = $fecsal[2]."/".$fecsal[1]."/".$fecsal[0];
	$this->acFecha_solicitud = $fecsol[2]."/".$fecsol[1]."/".$fecsol[0];
return $this->ejecutar("update tsalida set codigo = '$this->acCodigo', fecha_salida = '$this->acFecha_salida', cedula_personal = '$this->acCedula_personal', nro_solicitud = '$this->acNro_solicitud', fecha_solicitud = '$this->acFecha_solicitud', observacion = '$this->acObservacion' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tsalida where(codigo = '$this->acCodigo')");
}

public function listarsalidas(){
	$this->ejecutar("select 
		s.codigo as nro_despacho,
		date_format(s.fecha_salida, '%d/%m/%Y') as fecha_despacho,
		concat(p.nacionalidad,'-',p.cedula,' ',p.nombres,' ',p.appellidos,' (',u.nombre,')') as personal,
		a.nombre as articulo,
		ls.cantidad as cantidad
		from tlinea_salida as ls
		inner join tsalida as s on (s.codigo = ls.codigo_salida)
		inner join tarticulo as a on (a.codigo = ls.codigo_articulo)
		inner join tpersonal as p on (s.cedula_personal = p.cedula)
		inner join tunidad as u on (u.codigo = p.codigo_unidad)");

	$cad = "";

	while($row = $this->arreglo()){
		$cad.="<tr>";
			$cad.="<td>".$row["nro_despacho"]."</td>";
			$cad.="<td>".$row["fecha_despacho"]."</td>";
			$cad.="<td>".$row["personal"]."</td>";
			$cad.="<td>".$row["articulo"]."</td>";
			$cad.="<td>".$row["cantidad"]."</td>";
		$cad.="</tr>";
	}

	return $cad;
}
//fin clase
}?>