<?php
	
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	//Insertado de informacion tabla campañas
	//Formulario add-campaign.php
	$stmt = $conn->prepare("INSERT INTO campaigns (campaignName, vaccine, dateStart, dateEnd, idUser) VALUES (:nomCamp, :vac, :start, :end, :idUser)");

	$stmt->bindParam(':nomCamp', $nombreCamp);
	$stmt->bindParam(':vac', $vacuna);
	$stmt->bindParam(':start', $inicia);
	$stmt->bindParam(':end', $termina);
	$stmt->bindParam(':idUser', $idUsuario);

	$nombreCamp = $_REQUEST["campaignName"];
	$vacuna = $_REQUEST["vaccine"];
	$inicia = $_REQUEST["dateStart"];
	$termina = $_REQUEST["dateEnd"];
	$idUsuario = $_REQUEST["idUser"];

	$stmt->execute();

	$conn = null;
	header('Location: /campaign/campaigns.php');
?>