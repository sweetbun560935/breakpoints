<?php
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	//Borrado de campaña 

	$stmt = $conn->prepare("DELETE FROM campaigns WHERE id = :idCamp ");

	$stmt->bindParam(':idCamp', $idCamp);

	$idCamp = $_REQUEST["idCampaignDelete"];


	$stmt->execute();

	$conn = null;
	header('Location: ../campaigns.php');
?>