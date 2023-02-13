<html>
<head>
	<title>Las Vigas Gro</title>
	<link rel="shortcut icon" href="image/iconoTitle2.png">
	

	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	
	<link rel="stylesheet" href="./css/estiloFormu.css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	
	<script>
		function sumaInputs()
		{	
			var num1= parseInt(document.contenido.valor1.value);
			var num2= parseInt(document.contenido.valor2.value);
			var num3= parseInt(document.contenido.valor3.value);
			var num4= parseInt(document.contenido.valor4.value);
			var num5= parseInt(document.contenido.valor5.value);
			var num6= parseInt(document.contenido.valor6.value);
			var num7= parseInt(document.contenido.valor7.value);
			var num8= parseInt(document.contenido.valor8.value);
			var num9= parseInt(document.contenido.valor9.value);
			if(isNaN(num1))
			{
				num1=0;
			};
			if(isNaN(num2))
			{
				num2=0;
			};
			if(isNaN(num3))
			{
				num3=0;
			};
			if(isNaN(num4))
			{
				num4=0;
			};
			if(isNaN(num5))
			{
				num5=0;
			};
			if(isNaN(num6))
			{
				num6=0;
			};
			if(isNaN(num7))
			{
				num7=0;
			};
			if(isNaN(num8))
			{
				num8=0;
			};
			if(isNaN(num9))
			{
				num9=0;
			};
			var totalS=num1+num2+num3+num4+num5+num6+num7+num8+num9;
			$("#total").val(totalS);
		};
	</script>
	<script>
		function valida(e)
		{
			tecla = (document.all) ? e.keyCode : e.which;
			//Tecla de retroceso para borrar, siempre la permite
			if (tecla==8)
			{
				return true;
			}   
			// Patron de entrada, en este caso solo acepta numeros
			patron =/[0-9]/;
			tecla_final = String.fromCharCode(tecla);
			return patron.test(tecla_final);
		}
	</script>
</head>
<body >
	<table class="tabla1" border="0" align="center">	
		<tr height="220" style="background-color: #024959;">
			<td style="width: 25%" align="center" class="Logo"><img src="./image/logoG.png" width="120"></td>
			<td align="center" ><h1 class="titulo1">L A S &nbsp; V I G A S<br>G U E R R E R O</h1></td>
			<td style="width: 25%" align="center" class="Logo1"><img src="./image/logo.png" width="140"></a></td>		
		</tr>
		<tr>
			<td height="48">
				<div class="inicioR">
					<a href="javascript:cerrar();" > Inicio </a>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div class="container">
					<div class="from_top" align="center">
						<h2>Registro de afectaciones <span>por siniestro</span></h2>
					</div>
					<form enctype="multipart/form-data" name="contenido" class="form_reg" method="POST" action="ImprimeRegistro.php"  data-ajax = "false" />
						<label>Nombre:</label>
						<input maxlength="50" class="input" type="text" name="nombreR" placeholder="Nombre(s)..." required>
						<input maxlength="50" class="input" type="text" name="apellidosR" placeholder="Apellidos..." required>

						<label>Edad:</label> 
						<input maxlength="2" class="input" type="text" name="edadR" min="18" max="99" onkeypress="return valida(event)"  required>

						<label>Sexo:</label> 
						
						<label>Mujer</label>
						<input  type="radio" name="tipoSexo" value="Mujer" required>
						
						<lable>Hombre</lable>
						<input  type="radio" name="tipoSexo" value="Hombre" required>
						
						<div><br>
						<label>-Dirección-</label> 
						<label>Calle:</label>
						<input maxlength="20" class="input" type="text" name="calleR" placeholder="Calle..." required>
						
						<label>Localidad:</label>
						<input maxlength="20" class="input" type="text" name="localidadR" placeholder="Las Vigas" value="Las Vigas" readonly >
						
						<label>Minicipio:</label>
						<input maxlength="20" class="input" type="text" name="municipioR" placeholder="San Marcos" value="San Marcos"  readonly >

						<label>Telefono</label>
						<input maxlength="10" class="input" type="tel" name="telR" placeholder="Telefono/Celular..." onkeypress="return valida(event)" >

						<label>Correo electronico</label>
						<input maxlength="50" class="input" type="email" name="emailR" placeholder="Correo electronico..." >
						</div>
						<label>Tipo de Desastre natural:</label>
						<select name="menuR" required>
							<option selected="true" disabled="disabled">-------</option>
							<option value="Inundaciones">Inundación</option>
							<option value="Huracanes">Huracan</option>
							<option value="Terremoto">Terremoto</option>
							<option value="Deslave">Deslave</option>
							<option value="Incendio">Incendio</option>
						</select>
						
						<label>Lugar del Siniestro</label>
						<input maxlength="50" class="input" type="text" name="lugarR" placeholder="Casa, Escuela, Albergue, etc." required>
						
						<div><br>
						<label>Tipo de perdida:</label>
						</div>
						<label>Parcial</label>
						<input type="radio" name="tipoP" value="Parcial" required>
						
						<label>Total</label>
						<input type="radio" name="tipoP" value="Total" required>

						<label>Subir fotografia </label>
						<input type="file" name="imagen" id="files" accept="image/*" >
						<center><output  id="list"></output></center>


						<div>
							<br>Estufa: ($700.00 - $7,000.00)
							<input type="range" min="700" max="7000" id="valor1" name="estufa" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div>
						<div>
							<br>Lavadora: ($1,500.00 - $8,000.00)
							<input type="range" min="1500" max="8000" id="valor2" name="lavadora" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div>
						<div >
							<br>Refrigerador: ($3,000.00 - $10,000.00)
							<input type="range" min="3000" max="10000" id="valor3" name="refrigerador" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div>
						<div>
							<br>Boiler: ($1,500.00 - $6,000.00)
							<input type="range" min="1500" max="6000" id="valor4" name="boiler" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div>
						<div>
							<br>Television: ($2,000.00 - $8,000.00)
							<input type="range" min="2000" max="8000" id="valor5" name="television" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div>
						<div>
							<br>Horno-Microondas: ($1,000.00 - $4,000.00)
							<input type="range" min="1000" max="4000" id="valor6" name="hornoMicro" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div>
						<div>
							<br>Comedor: ($2,500.00 - $10,000.00)
							<input type="range" min="2500" max="10000" id="valor7" name="comedor" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div>
						<div>
							<br>Sala: ($2,500.00 - $8,000.00)
							<input type="range" min="2500" max="8000" id="valor8" name="sala" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div><br><br>
						<textarea name="desGeneral" maxlength="200" rows="4" cols="40" placeholder="Describa otras perdidas"></textarea>
						<div>
						<center>($0.00 - $15,000.00)</center>
						<input type="range" min="0" max="15000" id="valor9" name="general" onchange="sumaInputs()" onkeypress="return valida(event)" />
						</div>
							Total:
							<input type="text" id="total" name="total" readonly />
						<div align="center">
								<input class="btn_submit" type="submit" value="Registrar siniestro" id="upload" href="javascript:registro1();">
								<input class="btn_reset" type="reset" value="Limpiar formulario">
						</div>					
					</form>
				</div>
			</td>
		</tr>
	</table>
	<script>
              function archivo(evt) {
                  var files = evt.target.files; // FileList object
             
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("list").innerHTML = ['<img width="340" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                  }
              }
             
              document.getElementById('files').addEventListener('change', archivo, false);
    </script>
      <script>
	    $(function(){
	        $("#formuploadajax").on("submit", function(e){
	            e.preventDefault();
	            var f = $(this);
	            var formData = new FormData(document.getElementById("formuploadajax"));
	            formData.append("dato", "valor");
	            //formData.append(f.attr("name"), $(this)[0].files[0]);
	            $.ajax({
	                url: "ImprimeRegistro.php",
	                type: "POST",
	                dataType: "html",
	                data: formData,
	                cache: false,
	                contentType: false,
		     		processData: false
	            })
	                .done(function(res){
	                    $("#mensaje").html("Respuesta: " + res);
	                    window.location='ImprimeRegistro.php';
	                });
	        });

	    });
    </script>
    <script>

		    	$(document).on('change','input[type="file"]',function(){
			// this.files[0].size recupera el tamaño del archivo
			// alert(this.files[0].size);
			
			var fileName = this.files[0].name;
			var fileSize = this.files[0].size;

			if(fileSize > 972800){
				alert('El archivo no debe superar los 1MB');
				this.value = '';
				this.files[0].name = '';
			}else{
				// recuperamos la extensión del archivo
				var ext = fileName.split('.').pop();

				// console.log(ext);
				switch (ext) {
					case 'jpg':
					case 'jpeg': break;
					default:
						alert('El archivo no tiene la extensión adecuada (JPG, JPEG)');
						this.value = ''; // reset del valor
						this.files[0].name = '';
				}
			}
		});
		
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
	    $('#upload').bind("click",function() 
	    { 
	        var imgVal = $('#files').val(); 
	        if(imgVal=='') 
	        { 
	            alert("La imagen seleccionada excede el peso admitido"); 
	            return false; 
	        } 


	    }); 
	});
	</script> 
</body>
</html>
<script language="javascript" type="text/javascript"> 
function cerrar() 
{  
   window.location='index.php';
}
</script>


