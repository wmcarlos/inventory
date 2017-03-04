function Incluir($id){
var f = document.form1;
$('#form1').find('input').attr("disabled",false);
$('#form1').find('textarea').attr("disabled",false);
$('#form1').find('select').attr("disabled",false);		
if($id=="no"){
	f[0].value = "";
	f[0].focus();
}else{
	f[0].value = $id;
	f[1].focus();
}
//botones	
f.txtoperacion.value = 'incluir';
f.btnincluir.disabled = true;
f.btnbuscar.disabled = true;
f.btnmodificar.disabled = true;
f.btneliminar.disabled = true;
f.btncancelar.disabled = false;
f.btnguardar.disabled = false;
}

function Modificar(){
var f = document.form1;
//campos		
$('#form1').find('input').attr("disabled",false);
$('#form1').find('textarea').attr("disabled",false);
$('#form1').find('select').attr("disabled",false);	
f[0].disabled = true;
f[1].focus();
//botones	
f.txtoperacion.value = 'modificar';
f.btnincluir.disabled = true;
f.btnbuscar.disabled = true;
f.btnmodificar.disabled = true;
f.btneliminar.disabled = true;
f.btncancelar.disabled = false;
f.btnguardar.disabled = false;
}

function Eliminar()
		{
			var f = document.form1;
			if(confirm('Desea Eliminar Este Registro?'))
			{
				f[0].disabled = false;
				f.txtoperacion.value = 'eliminar';
				f.submit();
			}
		}
		
		function Cancelar(redirec){
			
			location.href='../vistas/vista'+redirec+'.php';	
		}

function cargar_select(operacion,listo){

			var f = document.form1;
			if(listo==1 && operacion=='buscar')
			{
				f.btnincluir.disabled = true;
				f.btnbuscar.disabled = true;
				f.btnmodificar.disabled = false;
				f.btneliminar.disabled = false;
				f.btncancelar.disabled = false;
			}

			if(listo==1 && operacion=='buscar2')
			{
				f.btnincluir.disabled = true;
				f.btnbuscar.disabled = true;
				f.btnmodificar.disabled = false;
				f.btneliminar.disabled = false;
				f.btncancelar.disabled = false;
			}
}


function delline(e){
	var td = e.parentNode;
	var tr = td.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}

function validateprod(name){
	var arr = document.getElementsByName("articulos[]");
	var total = arr.length;
	var cont = 0;
	for(var i= 0; i < total ; i++){
		if(arr[i].value == name){
			cont++;
		}
	}

	if(cont > 0){
		return true;
	}else{
		return false;
	}
}	

function addline(){
	var content = document.getElementById("content-details");
	var articulo = document.getElementById("txttext_articulo").value.split("-");
	var unidad_medida = document.getElementById("txtunidad_medida").value;
	var existencia = document.getElementById("txtexistencia").value;
	var cantidad = document.getElementById("txtcantidad").value;
	var text = "";
	if(document.getElementById("txttext_articulo").value && document.getElementById("txtcantidad").value){
		if(validateprod(articulo[0])){
			alert("Ya el articulo esta Agregado");
			document.getElementById("txttext_articulo").value = "";
			document.getElementById("txtunidad_medida").value = "";
			document.getElementById("txtexistencia").value = "";
			document.getElementById("txtcantidad").value = "";
		}else{
			text+="<tr>";
			text+="<td><input type='hidden' name='articulos[]' value='"+articulo[0]+"'>"+articulo[1]+"</td>";
			text+="<td>"+unidad_medida+"</td>";
			text+="<td>"+existencia+"</td>";
			text+="<td><input type='hidden' name='cantidades[]' value='"+cantidad+"'>"+cantidad+"</td>";
			text+="<td><button type='button' onclick='delline(this);'>x</button></td>";
			text+="</tr>";
			document.getElementById("txttext_articulo").value = "";
			document.getElementById("txtunidad_medida").value = "";
			document.getElementById("txtexistencia").value = "";
			document.getElementById("txtcantidad").value = "";
			content.innerHTML+=text;
		}
	}else{
		alert("Debes seleccionar un Articulo con su Cantidad");
	}
}

$(function() {
	$( ".fecha_formateada" ).datepicker({
		dateFormat : 'dd/mm/yy',
		changeMonth : true,
		changeYear : true
	});
});

$(function() {
	$( ".range_formateada" ).datepicker({
		dateFormat : 'dd/mm/yy',
		changeMonth : true,
		changeYear : true,
		minDate : '-4D',
		maxDate : '+0D'
	});
});