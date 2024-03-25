<?php
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	//Insertado de informacion tabla pets
	//Formulario add-pets.php

	$stmt = $conn->prepare("INSERT INTO pets (ownerName, petName, type, race, age, idCampaign) VALUES (:owner, :pet, :type, :race, :age, :idCampaign)");

	$stmt->bindParam(':owner', $dueño);
	$stmt->bindParam(':pet', $mascota);
	$stmt->bindParam(':type', $tipo);
	$stmt->bindParam(':race', $raza);
	$stmt->bindParam(':age', $edad);
	$stmt->bindParam(':idCampaign',$idCampaña);

	$dueño = $_REQUEST["ownerName"];
	$mascota = $_REQUEST["petName"];
	$tipo = $_REQUEST["type"];
	$raza = $_REQUEST["race"];
	$edad = $_REQUEST["age"];
	$idCampaña = $_REQUEST["idcamp"];

	$stmt->execute();

	$conn = null;
	header('Location: ../pets.php');
?>