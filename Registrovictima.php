<html>
<head>
	<title>Las Vigas Gro</title>
	<link rel="shortcut icon" href="./image/iconoTitle2.png">
	<link rel="stylesheet" type="text/css" href="./css/EstiloIndex.css">
	<link rel="stylesheet" type="text/css" href="./fonts.css">
	<link rel="stylesheet" href="./css/estiloFormu3.css">
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
	<?php
		include("Conexion.php");
		$con=conectar();
		session_start();

		if (isset($_SESSION["u_usuario"])) 
		{
			$datoU=$_SESSION['u_usuario'];
			echo "
	<table width='60%'>
		<tr>
			<td align='right'>
				Sesión iniciada - Usuario: $datoU
			</td>
			<td align='center'>
				<a href='cerrarsesion.php' style='text-decoration: none;'> Cerrar sesion</a>
			</td>
		</tr>
	</table>";			
		}
		else{
			echo"<script type=\"text/javascript\">alert('Es necesario iniciar sesion para aceder a esta pagina'); window.location='SesionAdmin.php';</script>";
		}
		//Comprobamos si esta definida la sesión 'tiempo'.
    if(isset($_SESSION['tiempo']) ) {

        //Tiempo en segundos para dar vida a la sesión.
        $inactivo = 2400;//40min en este caso.

        //Calculamos tiempo de vida inactivo.
        $vida_session = time() - $_SESSION['tiempo'];

            //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
            if($vida_session > $inactivo)
            {
                //Removemos sesión.
                session_unset();
                //Destruimos sesión.
                session_destroy();              
                //Redirigimos pagina.
                echo"<script type=\"text/javascript\">alert('La sesión ha caducado'); window.location='SesionAdmin.php';</script>";

                exit();
            }

    }
    $_SESSION['tiempo'] = time();

	$id_victimaR=$_POST["id_victima"];

	$sql = "SELECT * FROM datosvictimas WHERE id_victima='$id_victimaR'";
	$ConsultaRegis = mysqli_query($con,$sql) or die("Error al cargar victima");
	$Fila =  mysqli_fetch_array($ConsultaRegis);

	$sqlDatos = "SELECT * FROM datossiniestro WHERE id_victima='$id_victimaR'";
	$ConsultaRegisDatos = mysqli_query($con,$sqlDatos) or die("Error al cargar sinisetro");
	$FilaS =  mysqli_fetch_array($ConsultaRegisDatos);

	$sqlDatosD = "SELECT id_victima, nombredenu, apellidosdenu, IFNULL(telefonodenu,'S/DATOS') AS telD, IFNULL(emaildenu,'S/DATOS') AS emailD FROM datosdenunciante WHERE id_victima='$id_victimaR'";
	$ConsultaRegisDatosD = mysqli_query($con,$sqlDatosD) or die("Error al cargar denunciante");
	$FilaD =  mysqli_fetch_array($ConsultaRegisDatosD);

	?>
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
							<li><a href="MenuAdmin.php">Registros de perdidas</a></li>
							<li><a href="denuncias.php">Registro de denuncias</a></li>
							<li><a href="reportescivicos.php">Reportes Cívicos</a></li>
						</ul>
					</nav>
				</header>
			</td>
		</tr>
		<!Cuerpo pagina>
		<tr>
			<td colspan="3" bgcolor="F3F3F3">
				<div class="container">
					<form method="POST" class="form_reg" action="ImprimirReporteSiniestroIn.php" target="_blank" >
						<div class="from_top" align="center">
						<h2>Numero de registro:  <span>"<input size="2" type="text" class="input" name="id_victima" value="<?php echo $Fila["id_victima"];?>" required readonly>"</span></h2>
						</div>
						
							Nombre:    
							<input type="text" class="input"  value="<?php echo $Fila["nombrev"]; echo " ".$Fila["apellidosv"]; ?>" required readonly>

							Edad:    
							<input size="3" type="text" class="input"  value="<?php echo $Fila["edadv"];?>" required readonly>

							Sexo:    
							<input size="3" type="text" class="input"  value="<?php echo $Fila["sexo"];?>" required readonly>

							Caracteristicas:<br> 
							<textarea class="input"  rows="3" cols="25" required readonly><?php echo $Fila["caracteristicasv"];?></textarea>

							Tipo de siniestro: 
							<input type="text" class="input" value="<?php echo $FilaS["tiposiniestro"];?>" required readonly>

							Calle:
							<input type="text" class="input" value="<?php echo $FilaS["calles"];?>" required readonly>

							Localidad: 
							<input type="text" class="input" value="<?php echo $FilaS["localidads"];?>" required readonly>

							Municipio: 
							<input type="text" class="input" value="<?php echo $FilaS["municipios"];?>" required readonly>

							Descripcion del siniestro: 
							<textarea class="input" rows="3" cols="25" required readonly><?php echo $FilaS["descripcionsiniestro"];?></textarea>

							<h2 align="center">Denunciante</h2>
						
							Nombre:    
							<input type="text" class="input"  value="<?php echo $FilaD["nombredenu"]; echo " ".$FilaD["apellidosdenu"]; ?>" required readonly>

							Tel: 
							<input type="text" class="input" value="<?php echo $FilaD["telD"];?>" required readonly>

							e-mail: 
							<input type="text" class="input" value="<?php echo $FilaD["emailD"];?>" required readonly>

							<input type="submit" class="btn_submit" value="Imprimir registro">
					</form>
				</div>
			</td>
		</tr>
		<tr><td height="100%"></td></tr>
	</table>	
</body>
</html>
