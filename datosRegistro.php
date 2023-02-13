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

	$id_afectadoR=$_POST["id_afectado"];
	$sql = "SELECT id_afectado, nombrea, apellidosa, sexoa, edada, callea, coloniaa, localidada, municipioa, IFNULL(telefonoa,'S/DATOS') AS tel, IFNULL(emaila,'S/DATOS') AS email, FechaRegistro FROM datosafectado WHERE id_afectado='$id_afectadoR'";
	$ConsultaRegis = mysqli_query($con,$sql) or die("Error al cargar");
	$Fila =  mysqli_fetch_array($ConsultaRegis);
	$sqlDatos = "SELECT * FROM danosafectados WHERE id_afectado='$id_afectadoR'";
	$ConsultaRegisDatos = mysqli_query($con,$sqlDatos) or die("Error al cargar");
	$FilaD =  mysqli_fetch_array($ConsultaRegisDatos);

		$sqlImg="SELECT image FROM danosafectados WHERE id_afectado='$id_afectadoR'";
		$ConsultaImgAux = mysqli_query($con,$sqlImg) or die("Error al cargar");
		$rowImgAux =  mysqli_fetch_array($ConsultaImgAux);

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
		<!Cuerpo de la pagina>
		<tr>
			<td bgcolor="F3F3F3" colspan="3">
				<div class="container">
				<form method="POST" class="form_reg" action="ImprimirReporteIn.php" target="_blank" >
					<div class="from_top" align="center">
					<h2>Numero de registro:  <span>"<input size="2" type="text" class="input" name="id_afectado" value="<?php echo $Fila["id_afectado"];?>" required readonly>"</span></h2>
					</div>
					
						Nombre:    
						<input type="text" class="input"  value="<?php echo $Fila["nombrea"]; echo " ".$Fila["apellidosa"]; ?>" required readonly>
						Sexo:    
						<input size="4" type="text" class="input"  value="<?php echo $Fila["sexoa"]; ?>" required readonly>
						Edad:    
						<input size="3" type="text" class="input" name="" value="<?php echo $Fila["edada"];?>" required readonly>
						Calle: 
						<input type="text" class="input" value="<?php echo $Fila["callea"];?>" required readonly>
						Localidad: 
						<input type="text" class="input" value="<?php echo $Fila["localidada"];?>" required readonly>
						Municipio: 
						<input type="text" class="input" value="<?php echo $Fila["municipioa"];?>" required readonly>
					
						Tel: 
						<input type="text" class="input" value="<?php echo $Fila["tel"];?>" required readonly>
						e-mail: 
						<input type="text" class="input" value="<?php echo $Fila["email"];?>" required readonly>
					
					Tipo de Desastre natural:
					<input type="text" class="input" value="<?php echo $FilaD["tipodesastre"];?>" required readonly>
					Lugar del Siniestro
					<input type="text" class="input" value="<?php echo $FilaD["lugardesastre"];?>" required readonly>
					Tipo de perdida: 
					<input  type="text" class="input" value="<?php echo $FilaD["tipoperdida"];?>" required readonly>
					<center><img height="240" src="data:image/jpg;base64,<?php echo base64_encode($rowImgAux["image"]); ?>"></center>
					Estufa:
					<input type="text" class="input" value="<?php echo $FilaD["estufa"];?>" required readonly>
					Lavadora:
					<input type="text" class="input" value="<?php echo $FilaD["lavadora"];?>" required readonly>
					Refriguerador:
					<input type="text" class="input" value="<?php echo $FilaD["refrigerador"];?>" required readonly>
					Boiler:
					<input type="text" class="input" value="<?php echo $FilaD["boiler"];?>" required readonly>
					Television:
					<input type="text" class="input" value="<?php echo $FilaD["television"];?>" required readonly>
					Horno de microondas
					<input type="text" class="input" value="<?php echo $FilaD["hornomicro"];?>" required readonly>
					Comedor:
					<input type="text" class="input" value="<?php echo $FilaD["comedor"];?>" required readonly>
					Sala:
					<input type="text" class="input" value="<?php echo $FilaD["sala"];?>" required readonly>
					Otras perdidas:
					<textarea rows="4" cols="40" class="input" required readonly ><?php echo $FilaD["otrasperdidas"];?></textarea>
					Total:
					<input type="text" class="input" value="<?php echo $FilaD["otrasperdidastotal"];?>" required readonly>
					Total:
					<input type="text" class="input" value="<?php echo $FilaD["total"];?>" required readonly>
					<input type="submit" class="btn_submit" value="Imprimir registro">
				</form>
			</div>
			</td>
		</tr>
		<tr><td height="100%"></td></tr>
	</table>
</body>
</html>