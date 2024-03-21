<?php

	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	//Modificación de informacion de campaña
	$stmt = $conn->prepare("UPDATE campaigns SET campaignName = :nomCamp, vaccine = :vac, dateStart = :start, dateEnd = :end, idUser = :idUser WHERE id = :idCampaignUpdate");

	$stmt->bindParam(':nomCamp', $nombreCamp);
	$stmt->bindParam(':vac', $vacuna);
	$stmt->bindParam(':start', $inicia);
	$stmt->bindParam(':end', $termina);
	$stmt->bindParam(':idUser', $idUsuario);
	$stmt->bindParam(':idCampaignUpdate',$idCampUp);

	$nombreCamp = $_REQUEST["campaignName"];
	$vacuna = $_REQUEST["vaccine"];
	$inicia = $_REQUEST["dateStart"];
	$termina = $_REQUEST["dateEnd"];
	$idUsuario = $_REQUEST["idUser"];
	$idCampUp = $_REQUEST["idCampaignUpdate"];

	$stmt->execute();

	$conn = null;
	header('Location: /campaign/campaigns.php');
?>