<html>
<head>
	<title>Las Vigas Gro</title>
	<link rel="shortcut icon" href="./image/iconoTitle2.png">

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
<body>
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
						<h2>Registro  <span>Denuncia</span></h2>
					</div>
					<form name="contenido" class="form_reg" method="POST" action="ImprimirRegistroSiniestro.php">
							<div class="bordeEstilo" align="left">
								<br>
								Nombre de la victima
								<input class="input" maxlength="50" class="input" type="text" name="nombreS" placeholder="Nombre..." required>
								<input class="input" maxlength="50" type="text" name="apellidoS" placeholder="Apellidos...">
								Sexo:
								<input style="position: absolute; top:32px; left:2%;" type="radio" name="tipoSexo" value="Mujer" required>
								&nbsp;Mujer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hombre
								<input style="position: absolute; top:2px; left:15%;" type="radio" name="tipoSexo" value="Hombre" required>
								<br>
								<input class="input" maxlength="2" type="text" name="edadS" placeholder="Edad(aproximada)..." onkeypress="return valida(event)" required>
								<textarea class="input" maxlength="254" name="caracVictima" rows="4" cols="40" placeholder="Caracteristicas de la victima..." required></textarea>
							</div>
								<br><br>
								Tipo de Denuncia:
								<input class="input" maxlength="20" type="text" name="tipoS" placeholder="Secuestro, extorcion, extravio..." required>
								Lugar del siniestro:
								Calle:
								<input class="input" maxlength="20" type="text" name="calleS" placeholder="Calle..." >
								Localidad:
								<input class="input" maxlength="20" type="text" name="localidadS" placeholder="Las Vigas" value="Las Vigas" readonly/>
								Minicipio:
								<input class="input" maxlength="20" type="text" name="municipioS" placeholder="San Marcos" value="San Marcos" readonly/>
								<textarea class="input" maxlength="254" name="desSiniestro" rows="4" cols="40" placeholder="Descriccion del siniestro..." required></textarea>
							<div class="bordeEstilo" ><br>
								<p align="justify">El denunciante puede ser una persona anónima, si desea hacerlo de esta manera dejar los siguientes campos vacíos.<br><br></p>
								Datos del Denunciante
								<input class="input" maxlength="50" type="text" name="nombreD" placeholder="Nombre...">
								<input class="input" maxlength="50" type="text" name="apellidosD" placeholder="Apellidos..." >
								<input class="input" maxlength="10" type="tel" name="telD" placeholder="Telefono/Celular..." onkeypress="return valida(event)" >
								<input class="input" maxlength="50" type="email" name="emailD" placeholder="Correo electronico..." >
							</div>

								<div align="center">
										<input class="btn_submit" type="submit" value="Registrar siniestro">
										<input class="btn_reset" type="reset" value="Limpiar formulario">
								</div>
					</form>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>
<script language="javascript" type="text/javascript"> 
function cerrar() 
{  
   window.location='index.php';
} 
</script>