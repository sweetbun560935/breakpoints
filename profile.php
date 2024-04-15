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
	<title>Perfil</title>
</head>
<body>
	<?php require_once('header.php'); ?>
	<?php require_once('/db/conexion.php'); 
	$conn = dbConexion();
	//Seleccionamos informacion del usuario logeado
	$sqlU = "SELECT * FROM user WHERE id = ".$_SESSION['idUsuario'];
	$resultU = $conn->query($sqlU);
	$rowU = $resultU->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<!-- Desplegamos información de usuario logeado en los inputs -->
			<h1 class="text-center">Mis Datos</h1>
			
			<form action="db/update_profile.php">
			<div class="form-group">
				<label for="">Nombre</label>
				<?php print '<input class="form-control" type="text" name="nameU" value="'.$rowU['name'].'" required>'; ?>
			</div>
			<div class="form-group">
				<label for="">Apellido(s)</label>
				<?php print '<input class="form-control" type="text" name="lastNameU" value="'.$rowU['lastName'].'" required>'; ?>
			</div> 

			<div class="form-group">
				<label for="">Nombre de Usuario</label>
				<?php print '<input class="form-control" type="text" name="aliasU" value="'.$rowU['username'].'" required>'; ?>
			</div>
			<div class="form-group">
				<label for="">Contraseña</label>
				<?php print '<input class="form-control" type="password" name="passU" value="'.$rowU['password'].'" required>'; ?>
			</div>
			<?php print '<input type="text" value ="'.$_SESSION['idUsuario'].'" name="idUser" hidden'; ?>
			<div class="form-group">
				<a href="/campaign" class="form-control btn btn-primary"> Cancelar </a>
				<br>
				<br>
				<!-- Si se modifica algun dato, se procedera a la modificación en BD -->
				<input class="form-control btn btn-danger" type="submit" value="Guardar">
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