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
	//Seleccionamos informacion de la mascota con su id
	$sql1 = "SELECT * FROM pets WHERE id = ".$_REQUEST['idPetUpdate'];
	$result1 = $conn->query($sql1);
	$rows1 = $result1->fetch(PDO::FETCH_ASSOC);
	
	//Seleccionado de campañas disponibles creadas por el usuario
	$sql2 = "SELECT `id`,`campaignName`, `vaccine`, `dateStart`, `dateEnd` FROM `campaigns` WHERE `idUser` = ".$_SESSION['idUsuario'];
	$result2 = $conn->query($sql2);
	$rows2 = $result2->fetchAll();
	?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<!-- Despliege de informacion de la mascota en Inputs -->
			<h1 class="text-center">Modificar Datos Mascota</h1>
			<form action="db/update_pet.php">
			<div class="form-group">
				<label for="">Nombre del Dueño</label>
				<?php print '<input class="form-control" type="text" name="ownerName" value="'.$rows1['ownerName'].'" required>'; ?>
			</div>
			<div class="form-group">
				<label for="">Nombre de la Mascota</label>
				<?php print '<input class="form-control" type="text" name="petName" value="'.$rows1['petName'].'" required>'; ?>
			</div> 
			<div class="form-group">
				<label for="">Tipo de Mascota</label>
				<select id="" class="form-control" name="type" required>
					<option value=""></option>
					<option value="Perro">Perro</option>
					<option value="Gato">Gato</option>
				</select>
			</div>
			<div class="form-group">
				<label for="">Raza de la Mascota</label>
				<?php print '<input class="form-control" type="text" name="race" value="'.$rows1['race'].'" required>'; ?>
			</div>
			<div class="form-group">
				<label for="">Edad de la Mascota</label>
				<?php print '<input class="form-control" type="number" name="age" value="'.$rows1['age'].'" required>'; ?>
			</div>
			<div class="form-group">
				<!-- Cargamos las campañas disponibles -->
				<label for="">Campaña:</label>
				<select id="" class="form-control" name="idcamp" required>
					<option value=""></option>
				<?php foreach ($rows2 as $row2) {	?>
					<?php print '<option value="'.$row2['id'].'">'.$row2['campaignName'].'</option>'; ?>						
				<?php } ?>
				</select>
			</div>
			<!-- Input oculto con  el id de la mascota -->
			<?php print '<input type="text" value ="'.$_REQUEST['idPetUpdate'].'" name="idPetUpdate" hidden>'; ?>
			<div class="form-group">
				<label for=""></label>
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