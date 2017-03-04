        </div>
   </div>
   <!--Pie de Pagina-->
   <div id="pie">
                <p id="contenido_pie">
					Calle San Felipe entre avenidas Libertador y Miranda Frente a la Plaza Bolivar Sarare Estado Lara<br />
					 <a href="#">Codigo Postal: 3015</a><br />
           <a href="#">Telefonos: 0251-9921112</a><br />
                </p>
   </div>
</div>
<script type="text/javascript">
  var enlaces = document.getElementsByTagName("a");
  var total = enlaces.length;
  for(i = 0; i < total; i++){
      switch(enlaces[i].getAttribute("href")){
        case 'vistaReporte_de_inventario.php':
          enlaces[i].setAttribute("target","_blank");
        break;
        case 'vistaLista_de_recepciones.php':
          enlaces[i].setAttribute("target","_blank");
        break;
        case 'vistaLista_de_despachos.php':
          enlaces[i].setAttribute("target","_blank");
        break;
      }
  }
</script>
</body>
</html>