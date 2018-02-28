<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<center>
		<div class="titulos">
			<h1>Iniciar</h1>
		</div>
		<div class="cuadro-formulario">
			
				<form method="POST">
					<input id="usuario" type="text" name="usuario" placeholder="Usuario">
					<input id="clave" type="password" name="clave" placeholder="Contraseña">
					<button class="boton" type="submit" value="enviar" name="iniciar">Iniciar</button>
				</form>
		</div>
	</center>

	<?php 

	if (isset($_POST["iniciar"])) {

		$usuario = $_POST["usuario"];
		$contraseña = $_POST["clave"];

		if ($usuario && $contraseña) {

			$conexion = mysqli_connect('localhost','root','');

			if (!$conexion) {
				die('No hay conexión a la BD');
			}
			
			mysqli_select_db($conexion, 'torneodeportivos');

			$sql = "SELECT * FROM usuario WHERE nombre = '$usuario' AND clave = '$contraseña'";
			$res = mysqli_query($conexion,$sql);
			$row = mysqli_fetch_assoc($res);

			if ($row) {
				$_SESSION['user'] = $row;
				if ($_SESSION['user']['identificador'] == 0) {
					header("location:torneo.php");
				}else if ($_SESSION['user']['identificador'] == 1) {
					header("location:administradores.php");
				}
				
			} else {
				
				echo "<center>";
			 	echo "<br>";
			 	echo "<h2>";
			 	echo "No existe el usuario ", $usuario;
			 	echo "</h2>";
			 	echo "</center>";
			}
		// $id= $_SESSION['user']['id'];
		// $SQL = "SELECT * FROM equipo WHERE id = '$id'";

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