<!DOCTYPE html>
<html>
<head>
	<title>Registro de torneos</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<center>
		<div class="titulos">
			<h1>Iniciar</h1>
		</div>
		<div class="cuadro-formulario">
			
				<form method="POST">
					<input id="torneo" type="text" name="torneo" placeholder="Nombre del torneo">
					<input id="fecha" type="date" name="fecha" placeholder="">
					<button class="boton" type="submit" value="enviar" name="registrar">Registrar</button>
				</form>
		</div>
	</center>

	<?php 

	if (isset($_POST["registrar"])) {

		$torneo = filter_input(INPUT_POST, 'torneo', FILTER_SANITIZE_STRING);
		$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);

		$connection = mysqli_connect('localhost', 'root', '');
	 	if(!$connection){
	 		die('No hay conexion a la BD');
	 	}

	 	mysqli_select_db($connection,'torneodeportivos');

	 	$sql = "SELECT * FROM torneos WHERE torneo = '$torneo'";
	 	$res = mysqli_query($connection,$sql);
		$row = mysqli_fetch_assoc($res);

		if ($row) {
			echo "<center>";
			echo "<br>";
			echo "<h3>";
			echo "El torneo ", $torneo, " ya existe";
			echo "</h3>";
			echo "</center>";
		} else {
			$sql = sprintf("INSERT INTO torneos (torneo, fecha) VALUES ('%s','%s')", $torneo, $fecha);
	 		$res = mysqli_query($connection, $sql);

		}

	}

	?>
</body>
</html>