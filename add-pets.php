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
	<title>Alta Mascotas</title>
</head>
<body>
	<?php require_once('header.php'); ?>
	<?php require_once('/db/conexion.php'); 
	$conn = dbConexion();
	//Buscamos campañas existentes
	$sql = "SELECT `id`,`campaignName`, `vaccine`, `dateStart`, `dateEnd` FROM `campaigns` WHERE `idUser` = ".$_SESSION['idUsuario'];
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-center">Alta Mascotas</h1>
			<br>
			<form action="db/connpet.php">
			<div class="form-group">				
				<input class="form-control" type="text" name="ownerName" required placeholder="Nombre del Dueño">
			</div>
			<div class="form-group">				
				<input class="form-control" type="text" name="petName" required placeholder="Nombre de la Mascota">
			</div> 
			<div class="form-group">
				<label for="">Tipo de Mascota: </label>
				<select id="" class="form-control" name="type">
					<option value="Perro">Perro</option>
					<option value="Gato">Gato</option>
				</select>
			</div>
			<div class="form-group">		
				<input class="form-control" type="text" name="race" required placeholder="Raza de la Mascota">
			</div>
			<div class="form-group">		
				<input class="form-control" type="number" name="age" required placeholder="Edad de la Mascota">
			</div>
			<div class="form-group">
				<label for="">Campaña:</label>
				<!-- Menu con campañas existentes -->
				<select id="" class="form-control" name="idcamp">
				<?php foreach ($rows as $row) {	?>
					<?php print '<option value="'.$row['id'].'">'.$row['campaignName'].'</option>'; ?>						
				<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for=""></label>
				<input class="form-control btn btn-primary" type="submit" value="Registrar">
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