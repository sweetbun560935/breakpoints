<?php
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	//Modificación de informacion de usuario
	$stmt = $conn->prepare("UPDATE user SET name = :na, lastName = :last, username = :usn, password = :ps WHERE id = :idUser");

	$stmt->bindParam(':na', $nombre);
	$stmt->bindParam(':last', $apellido);
	$stmt->bindParam(':usn', $usuario);
	$stmt->bindParam(':ps', $contra);
	$stmt->bindParam(':idUser', $id);

	$nombre = $_REQUEST["nameU"];
	$apellido = $_REQUEST["lastNameU"];
	$usuario = $_REQUEST["aliasU"];
	$contra = $_REQUEST["passU"];
	$id = $_REQUEST["idUser"];

	$stmt->execute();

	$conn = null;
	header('Location: ../profile.php');
?>