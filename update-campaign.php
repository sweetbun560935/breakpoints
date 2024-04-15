<?php
session_start();
?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="js/jquery.min.js"></script>	
	<link rel="stylesheet" href="css/css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<meta charset="UTF-8">
	<title>Nueva Campaña</title>
</head>
<body>
	<?php require_once('header.php'); ?>
	<?php require_once('/db/conexion.php'); 
	$conn = dbConexion();

	//Seleccionamos informacion de campaña con id campaña
	$sql = "SELECT * FROM campaigns WHERE id = ".$_REQUEST['idCampaignUpdate'];
	$result = $conn->query($sql);
	$rows = $result->fetch(PDO::FETCH_ASSOC);
	
	?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<!-- Cargamos informacion de campaña en Inputs -->
			<h1 class="text-center">Modifica Una Campaña de Vacunación</h1>
			<form action="db/update_campaign.php">
			<div class="form-group">
				<label for="">Nombre de Campaña</label>
				<?php print '<input class="form-control" type="text" name="campaignName" value="'.$rows['campaignName'].'" required>'; ?>
			</div>
			<div class="form-group">
				<label for="">Vacuna a Aplicar</label>
				<?php print '<input class="form-control" type="text" name="vaccine" value="'.$rows['vaccine'].'" required>'; ?>
			</div> 
			<div class="form-group">
				<label for="">Fecha de Inicio</label>
				<?php print '<input class="form-control" type="date" name="dateStart" value="'.$rows['dateStart'].'" required>'; ?>
			</div>
			<div class="form-group">
				<label for="">Fecha de Culminación</label>
				<?php print '<input class="form-control" type="date" name="dateEnd" value="'.$rows['dateEnd'].'" required>'; ?>
			</div>
			<!-- Input oculto con id de usuario logeado -->
			<?php print '<input type="text" name="idUser" value="'.$_SESSION['idUsuario'].'" hidden>';  ?>
			<!-- Input oculto con id de campaña de usuario logeado -->
			<?php print '<input type="text" name="idCampaignUpdate" value="'.$_REQUEST['idCampaignUpdate'].'" hidden>';  ?>
			<div class="form-group">
				<label for=""></label>
				<!-- Input para guardar lo modificaciones -->
				<input class="form-control btn btn-warning" type="submit" value="Guardar">
			</div>
		</form>
		</div>
	</div>
</body>
</html>
<?php }else {
	header('Location: /campaign/login.html');
}
?>