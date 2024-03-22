<?php
	
	//Insertando un nuevo usuario
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	$stmt = $conn->prepare("INSERT INTO user (name, lastName, username, password) VALUES (:nomU, :apeU, :uName, :pass)");

	$stmt->bindParam(':nomU', $nombre);
	$stmt->bindParam(':apeU', $apellido);
	$stmt->bindParam(':uName', $alias);
	$stmt->bindParam(':pass', $contra);

	$nombre = $_REQUEST["nameU"];
	$apellido = $_REQUEST["lastNameU"];
	$alias = $_REQUEST["aliasU"];
	$contra = $_REQUEST["passU"];

	$stmt->execute();

	$conn = null;
	header('Location: /campaign/login.html');
?>