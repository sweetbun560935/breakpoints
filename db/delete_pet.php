<?php
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	//Borrado de mascota
	
	$stmt = $conn->prepare("DELETE FROM pets WHERE id = :idPet ");

	$stmt->bindParam(':idPet', $idMasc);

	$idMasc = $_REQUEST["idPetDelete"];


	$stmt->execute();

	$conn = null;
	header('Location: ../pets.php');
?>