<html>
<head>
	<title>Registros Sinistros</title>
	<link rel="shortcut icon" href="./image/iconoTitle2.png">
	<link rel="stylesheet" type="text/css" href="./css/EstiloIndex.css">
	<link rel="stylesheet" type="text/css" href="./fonts.css">
	<link rel="stylesheet" href="./css/estiloFormu2.css">
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
			<td colspan="3" height="50" align="center">
				<h3>Registros de las perdidas ocacionadas por un desastre natural</h3>
			</td>
		</tr>
		<tr>
			<td colspan="3" bgcolor="8290F9" align="right" height="25">
				<h3><a style="text-decoration: none; color: #2A2B2E" class="link1" href="ImprimirReporteGeneral.php" target="_blank" >Generara reporte de todos los registros</a></h3>
			</td>
		</tr>
		<!Estructura datos>
			<?php

				$regitros_pagina=10;//<---- registros mostrados por pagina

				if(isset($_GET["Pagina"]))
				{
					if($_GET["Pagina"]==1)
					{
						header("location:MenuAdmin.php");
					}else{ 
						$pagina=$_GET["Pagina"];
					}
				}else{
					$pagina=1;//<-- pagina inicual
				}

				$empezar_desde=($pagina-1)*$regitros_pagina;//Pimer dato del limite

				$sql = "SELECT id_afectado, nombrea, apellidosa, edada, callea, coloniaa, municipioa, IFNULL(telefonoa,'S/DATOS') AS tel, IFNULL(emaila,'S/DATOS') AS email, FechaRegistro FROM datosafectado";
				$ConsultaRegis = mysqli_query($con,$sql) or die("Error al cargar 1");

				///---------------------------------------

				$num_registros= mysqli_num_rows($ConsultaRegis);//<---- numero total de registros

				$total_paginas=ceil($num_registros/$regitros_pagina);//<---- paginas total

				$sql_limite="SELECT id_afectado, nombrea, apellidosa, sexoa, edada, callea, coloniaa, localidada, municipioa, IFNULL(telefonoa,'S/DATOS') AS tel, IFNULL(emaila,'S/DATOS') AS email, FechaRegistro FROM datosafectado limit $empezar_desde,$regitros_pagina";
				$ConsultaRegisAux = mysqli_query($con,$sql_limite) or die("Error al cargar 2");

				//---------------------------------------

				while ($Fila =  mysqli_fetch_array($ConsultaRegisAux)) 
				{
			?>
		<tr>
			<td colspan="3" bgcolor="F3F3F3">
				<div class="container">
					<form method="POST" class="form_reg" action="datosRegistro.php" >
						<div class="from_top" align="center">
						<h2>Numero de registro:  <span>"<input size="1" type="text" class="input" name="id_afectado" value="<?php echo $Fila["id_afectado"];?>" required readonly>"</span></h2>
						</div>
						<div align="center">
							Nombre:    
							<input size="40" type="text" class="input"  value="<?php echo htmlspecialchars($Fila["nombrea"]); echo " ".$Fila["apellidosa"]; ?>" required readonly>
							Sexo:    
							<input size="4" type="text" class="input"  value="<?php echo $Fila["sexoa"]; ?>" required readonly>
							Edad:    
							<input size="3" type="text" class="input" name="" value="<?php echo $Fila["edada"];?>" required readonly>
						</div>	
						<div align="center">
							Calle: 
							<input type="text" class="input" value="<?php echo $Fila["callea"];?>" required readonly>
							Localidad: 
							<input type="text" class="input" value="<?php echo $Fila["localidada"];?>" required readonly>
							Municipio: 
							<input type="text" class="input" value="<?php echo $Fila["municipioa"];?>" required readonly>
						</div>
						<div align="center">
							Tel: 
							<input type="text" class="input" value="<?php echo $Fila["tel"];?>" required readonly>
							e-mail: 
							<input type="text" class="input" value="<?php echo $Fila["email"];?>" required readonly>
						</div>
						<div class="btn_form">
							<input type="submit" class="btn_submit" value="Ver datos"></td>
						</div>
					</form>
			<?php
			}
			?>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" bgcolor="FFFFFF">
				<div class="paginaA" align="center">
				Página: <?php echo " ".$pagina; ?>
				</div>
			</td>
		</tr>
		<tr>
		<tr>
			<td colspan="3" align="center" bgcolor="FFFFFF"> 
				<?php 
				for($i=1;$i<=$total_paginas;$i++)
				{

					echo "  <a class='paginado' href='?Pagina=".$i."'>  ".$i."   </a>";
				}
				?>
			</td>
		</tr>
		<tr><td height="100%"></td></tr>
</table>
</body>
</html>