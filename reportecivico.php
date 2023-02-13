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
		<!cuerpo Formulario>
		<tr>
			<td colspan="3">
				<div class="container">
					<div class="from_top" align="center">
						<h2>Reporte <span>Cívico</span></h2>
					</div>
					<form enctype="multipart/form-data" name="contenido" class="form_reg" method="POST" action="ImprimirReporteCivico.php"  data-ajax = "false" />
						
						<label>Tipo de Reporte:</label>
						<select name="menuR" required>
							<option selected="true" disabled="disabled">-------</option>
							<option value="Fuga de agua">Fuga de agua</option>
							<option value="Bache">Bache</option>
							<option value="Árbol caído o rama caída">Árbol caído o rama caída</option>
							<option value="Deslave en carretera">Deslave en carretera</option>
							<option value="Incendio forestal">Incendio forestal</option>
							<option value="Otros">Otros</option>
						</select>
						<textarea name="desGeneral" rows="4" cols="40" placeholder="Describa la situación "></textarea>

						<br><label>A partir cuando se observo el problema</label>
						<input type="date" name="fechaO" required  value="<?php echo date('Y-m-d'); ?>">

						<br><label>Subir fotografia </label>
						<input type="file" name="imagen" id="files" accept="image/*" required>
						<center><output  id="list"></output></center>

						<div><br>
						<center><label>Lugar</label> </center>
						<label>Calle:</label>
						<input maxlength="20" class="input" type="text" name="calleR" placeholder="Calle..." required>
						
						<label>Localidad:</label>
						<input maxlength="20" class="input" type="text" name="localidadR" placeholder="Las Vigas" value="Las Vigas"  readonly>
						
						<label>Minicipio:</label>
						<input maxlength="20" class="input" type="text" name="municipioR" placeholder="San Marcos" value="San Marcos" readonly >
						</div>

						<br><label>Datos ciudadano</label>
						<input maxlength="50" class="input" type="text" name="nombreR" placeholder="Nombre(s)..." required>
						<input maxlength="50" class="input" type="text" name="apellidosR" placeholder="Apellidos..." required>

						<br><label>Edad:</label> 
						<input maxlength="2" class="input" type="text" name="edadR" min="18" max="99" onkeypress="return valida(event)"  required>

						<label>Sexo:</label> 
						
						<label>Mujer</label>
						<input  type="radio" name="tipoSexo" value="Mujer" required>
						
						<lable>Hombre</lable>
						<input  type="radio" name="tipoSexo" value="Hombre" required>
						
						<br><label>Telefono</label>
						<input maxlength="10" class="input" type="tel" name="telR" placeholder="Telefono/Celular..." onkeypress="return valida(event)" >

						<label>Correo electronico</label>
						<input maxlength="50" class="input" type="email" name="emailR" placeholder="Correo electronico..." >
						
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
		    $(document).on('change','input[type="file"]',function()
		    {
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
</body>
</html>
<script language="javascript" type="text/javascript"> 
	function cerrar() 
	{  
	   window.location='index.php';
	}
</script>