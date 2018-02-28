<?php  

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modulo de administradores</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<div class="titulos">
		<h1>Administrador</h1>
	</div>
	<center>
		<div>
			<?php
			echo "<h3>";
			echo "Bienvenid@ ", $_SESSION['user']['nombre'];;
			echo "</h3>";
			?>

		</div>
		<div id="opciones">
			<br>
			<h3><a href="registrarTorneo.php">Registrar torneo</a></h3>
			<br>
		</div>
		<div id="tabla">
			<table>
				<caption>Equipos inscritos en el torneo</caption>
				<thead>
					<tr class="fila">
						<td>Torneo</td>
						<td>Categoria</td>
						<td>Nombre del equipo</td>
						<td>Cantidad de participantes</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="detalles.php">Detalles</a></td>
						<td><a href="editar.php">Editar</a></td>
						<td><a href="eliminar.php">Eliminar</a></td>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</center>
	<div id="cerrar">
		<button class="boton" tipe"submit" value="enviar" name="cerrar"><a href="cerrar.php"><h2>Cerrar</h2></a></button>
	</div>
</body>
</html>