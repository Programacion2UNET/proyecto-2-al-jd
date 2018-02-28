<?php 
session_start();

$conexion = mysqli_connect('localhost','root','');

if (!$conexion) {
	die('No hay conexión a la BD');
}

mysqli_select_db($conexion, 'torneodeportivos');

$sql = "SELECT id, id_torneo, participantes, categoria FROM torneos";
$res = mysqli_query($conexion,$sql);

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
			<h1>Registro de torneos</h1>
		</div>
		<div>
			<?php
			echo "<h3>";
			echo "Bienvenid@ ", $_SESSION['user']['nombre'];;
			echo "</h3>";
			?>

		</div>
		<div class="cuadro-formulario">
			<center>
				<form method="POST">
					<br>
					<select class="seleccion" name="" id="">
						<option  value="">Selecciona un torneo</option>
						<?php 

						while ($row = mysql_fetch_array($res)){
							echo "<option>";
							$row['id'];
							echo "</option>";
							echo "<option>";
							$row['id_torneo'];
							echo "</option>";
							echo "<option>";
							$row['participantes'];
							echo "</option>";
							echo "<option>";
							$row['categoria'];
							echo "</option>";
						} 
						?>
					</select>
					<input id="participantes" type="number" name="participantes" placeholder="Cantidad participantes">
					<div class="formulario">
						<legend id="subtitulo">Categoria</legend>
						<br>
						<label for="">Principiantes</label>
						<input id="categoria" type="radio" name="categoria" value="principiantes">
						<label for="">Aficionados</label>
						<input id="categoria" type="radio" name="categoria" value="aficionados">
						<label for="">Profesionales</label>
						<input id="categoria" type="radio" name="categoria" value="profesionales">
					</div><br>
					<button class="boton" tipe"submit" value="enviar" name="registrar">Registrar</button>
				</form>
			</center>
		</div>
	</center>

	<div id="cerrar">
		<button class="boton" tipe"submit" value="enviar" name="cerrar"><a href="cerrar.php">Cerrar</a></button>
	</div>

	<?php 

	if (isset($_POST["registrar"])) {

		$torneo = filter_input(INPUT_POST, 'torneo', FILTER_SANITIZE_STRING);
		$participantes = filter_input(INPUT_POST, 'participantes', FILTER_SANITIZE_STRING);
		$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);

		$connection = mysqli_connect('localhost', 'root', '');
	 	if(!$connection){
	 		die('No hay conexion a la BD');
	 	}

	 	mysqli_select_db($connection,'torneodeportivos');

	 	$sql = "SELECT * FROM torneos WHERE torneo = '$torneo'";
	 	$res = mysqli_query($connection,$sql);
		$row = mysqli_fetch_assoc($res);

		if ($row) {

			$id_torneo = $row['id'];
			$id_usuario = $_SESSION["user"]["id"];

			$sql = sprintf("INSERT INTO listaTorneos (id_torneo, cantidad, categoria, id_usuario) VALUES ('%s','%s','%i','%s')", $id_torneo, $cantidad, $categoria, $id_usuario);
	 		$res = mysqli_query($connection, $sql);

		} else {

			echo "error";

		}

	} 
	?>

</body>
</html>