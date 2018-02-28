<?php

	$nombre = filter_input(INPUT_POST, 'equipo', FILTER_SANITIZE_STRING);
	$corto = filter_input(INPUT_POST, 'corto', FILTER_SANITIZE_STRING);
	$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
	$direccion = filter_input(INPUT_POST,'direccion', FILTER_SANITIZE_STRING);
	$correo = filter_input(INPUT_POST,'correo', FILTER_SANITIZE_STRING);
	$usuario = filter_input(INPUT_POST,'usuario', FILTER_SANITIZE_STRING);
	$clave = filter_input(INPUT_POST,'clave', FILTER_SANITIZE_STRING);
	$web = filter_input(INPUT_POST,'web', FILTER_SANITIZE_STRING);
 
 if ($nombre && $corto && $fecha && $correo && $usuario && $clave) {
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

?>

 
