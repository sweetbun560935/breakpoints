<?php
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	//Modificación de informacion de campaña
	
	$stmt = $conn->prepare("UPDATE pets SET ownerName = :owner, petName = :pet, type = :type, race = :race, age = :age, idCampaign = :idCampaign WHERE id = :idpet");

	$stmt->bindParam(':owner', $dueño);
	$stmt->bindParam(':pet', $mascota);
	$stmt->bindParam(':type', $tipo);
	$stmt->bindParam(':race', $raza);
	$stmt->bindParam(':age', $edad);
	$stmt->bindParam(':idCampaign',$idCampaña);
	$stmt->bindParam(':idpet',$idmascota);

	$dueño = $_REQUEST["ownerName"];
	$mascota = $_REQUEST["petName"];
	$tipo = $_REQUEST["type"];
	$raza = $_REQUEST["race"];
	$edad = $_REQUEST["age"];
	$idCampaña = $_REQUEST["idcamp"];
	$idmascota = $_REQUEST["idPetUpdate"];

	$stmt->execute();

	$conn = null;
	header('Location: ../pets.php');
?>