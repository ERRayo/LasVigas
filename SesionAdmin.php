<html>
<head>
	<title>Las Vigas Gro</title>
	<link rel="shortcut icon" href="./image/iconoTitle2.png">
	<link rel="stylesheet" type="text/css" href="./css/EstiloIndex.css">
	<link rel="stylesheet" type="text/css" href="./fonts.css">
	<link rel="stylesheet" href="./css/estiloFormu1.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="./js/menu.js"></script>
	<script type="text/javascript" src="./js/jquery.js"></script>
	<style>
	body 
	{
	
	background-image: url("./image/fondoB3.jpg");
	}
</style>
</head>
<body>
<table class="tabla1" border="0">	
	<tr height="220" style="background-color: #024959;">
		<td style="width: 25%" align="center" class="Logo"><img src="./image/logoG.png" width="120"></td>
		<td align="center" ><h1 class="titulo1">L A S &nbsp; V I G A S<br>G U E R R E R O</h1></td>
		<td style="width: 25%" align="center" class="Logo1"><a href="index.php"><img src="./image/logo.png" width="140"></a></td>		
	</tr>
	<tr height="30" style="background-color: #024959;">
		<td colspan="3">
			<a style="color:#FFFFFF; text-decoration: none;" href="http://www.facebook.com"><span class="icon-facebook2"></span>Facebook</a>
			<a style="color:#FFFFFF; text-decoration: none;" href="https://twitter.com"><span class="icon-twitter"></span>Twitter</a>
			<a style="color:#FFFFFF; text-decoration: none;" href="https://www.instagram.com/"><span class="icon-instagram"></span>Instagram</a>
		</td>
	</tr>
	<tr >
		<td align="center" colspan="3" style="border-style: solid; border-color: #FFE3BF;">
			<header>
				<div class="menu_bar" onclick="abrircerrar()">
					<a href="#" class="bt-menu"><span class="icon-menu"></span>Menu</a>
				</div>
				<nav>
					<ul>
						<li><a href="index.php" ><span class="icon-home3"></span>Inicio</a></li>
						<li><a href="problematica.php">Problematica</a></li>
						<li><a href="conciencia.php">Haz conciencia</a></li>
						<li><a href="ComisionS.php">Comision de seguridad</a></li>
						<li><a href="galeria.php">Galeria</a></li>
					</ul>
				</nav>
			</header>
		</td>
	</tr>
		<!Cuerpo de la pagina>
	<tr>
		<td colspan="3">
			<div class="container">
				<div class="from_top" align="center">
					<h2>Inicio de ses<span>ión administrador</span></h2>
				</div>
				<form name="contenido" class="form_reg" method="POST" action="iniciosesion.php">			
					<br>Usuario:
					<input class="input" type="text" name="usuario" placeholder="Usuario..." required>
					Contraseña:
					<input class="input" type="password" name="contrasena" placeholder="Contraseña..." required>
					<div class="btn_form">
						<input type="submit" value="Iniciar Sesion" class="btn_submit">
						<input type="submit" value="Limpiar" class="btn_reset">
					</div>
				</form>
			</div>
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
	</table>
</body>
</html>