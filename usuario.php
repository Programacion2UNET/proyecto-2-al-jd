<!DOCTYPE html>
<html>
<head>
	<title>Registro de usuarios</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<center>
		<div class="titulos">
			<h1>Registro de usuarios</h1>
		</div>
		<div class="cuadro-formulario">
			<br>
				<form method="post" action="">
					<input id="nombre" type="text" name="equipo" placeholder="Nombre del equipo">
					<input id="corto" type="text" name="corto" maxlength="5" placeholder="Nombre Corto">
					<input id="fecha" type="date" name="fecha">
					<input id="direccion" type="text" name="direccion" placeholder="Direccion (Opcional)">
					<input id="correo" type="email" name="correo" placeholder="Correo">
					<input id="web" type="url" name="web" placeholder="Sitio Web (Opcional)">
					<input id="usuario" type="text" name="usuario" placeholder="Usuario">
					<input id="clave" type="password" name="clave" placeholder="Contraseña">
					<button class="boton" type="submit" name="registrar" value="enviar">Registrar</button>
				</form>
		</div>
	</center>
	<?php
	if (isset($_POST["registrar"])) {

		$nombre = filter_input(INPUT_POST, 'equipo', FILTER_SANITIZE_STRING);
		$corto = filter_input(INPUT_POST, 'corto', FILTER_SANITIZE_STRING);
		$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
		$direccion = filter_input(INPUT_POST,'direccion', FILTER_SANITIZE_STRING);
		$correo = filter_input(INPUT_POST,'correo', FILTER_SANITIZE_STRING);
		$usuario = filter_input(INPUT_POST,'usuario', FILTER_SANITIZE_STRING);
		$clave = filter_input(INPUT_POST,'clave', FILTER_SANITIZE_STRING);
		$web = filter_input(INPUT_POST,'web', FILTER_SANITIZE_STRING);
	 
	 	if ($nombre && $corto && $fecha && $correo && $usuario && $clave) {

	 		$connection = mysqli_connect('localhost', 'root', '');
		 	if(!$connection){
		 		die('No hay conexion a la BD');
		 	}

		 	mysqli_select_db($connection,'torneodeportivos');

		 	$sql = "SELECT * FROM usuario WHERE nombre = '$usuario'";
		 	$res = mysqli_query($connection,$sql);
			$row = mysqli_fetch_assoc($res);


			if ($row) {

				echo "<center>";
				echo "<br>";
				echo "<h3>";
				echo "El usuario ", $usuario, " ya existe";
				echo "</h3>";
				echo "</center>";

			} else {
				//INICIAMOS CONEXION CON LA BAE DE DATOS
				$connection = mysqli_connect('localhost', 'root', '');
			 	if(!$connection){
			 		die('No hay conexion a la BD');
			 	}

			//SELECCION DE LA BASE DE DATOS
			 	mysqli_select_db($connection,'torneodeportivos');

			 	$sql = sprintf("INSERT INTO usuario (nombre, clave, identificador) VALUES ('%s','%s','%i')", $usuario, $clave, 0);
			 	$res = mysqli_query($connection, $sql);

			 	$sql = sprintf("SELECT * FROM usuario WHERE nombre = '$usuario' LIMIT 1");
			 	$res = mysqli_query($connection, $sql);

			 	if (mysqli_num_rows($res) > 0) {
			    // output data of each row
				   	$row = mysqli_fetch_assoc($res);
				   	$id = $row['id'];
				   	$sql = sprintf( "INSERT INTO equipos ( nombre, corto, fecha, direccion, correo, id_usuario, web) VALUES ('%s', '%s', '%s', '%s', '%s', '%s' , '%s')", $nombre, $corto, $fecha, $direccion, $correo, $id , $web);
					$res = mysqli_query($connection, $sql);

				} else {
				    echo "0 results";
				}

				header("location:inicio.php");
			}

		

		 //PREPARAR SENTENCIA SQL
		 // 	$sql = sprintf( "INSERT INTO equipo ( nombre, corto, fecha, direccion, correo, usuario, clav) VALUES ('%s', '%s', '%s', '%s', '%s', '%s' , '%s')", $nombre, $corto, $fecha, $direccion, $correo, $usuario, $clave) ;
			// $res = mysqli_query($connection, $sql);
			
			//mysqli_free_result($res); //cierra la conexion de datos
			// var_dump($res);  
		 } else {
		 	echo "<center>";
		 	echo "<br>";
		 	echo "<h2>";
		 	echo "Datos incompletos";
		 	echo "</h2>";
		 	echo "</center>";
		 }
	}

	?>
</body>
</html>	