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
	<div class="">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-center">Crea Una Campaña de Vacunación</h1>
			<form action="db/conncamp.php">
			<div class="form-group">				
				<input class="form-control" type="text" name="campaignName" required placeholder="Nombre de Campaña">
			</div>
			<div class="form-group">				
				<input class="form-control" type="text" name="vaccine" required placeholder="Vacuna a Aplicar">
			</div> 
			<div class="form-group">
				<label for="">Fecha de Inicio</label>
				<?php print '<input id="myDateStart" class="form-control" type="date" name="dateStart" required value ="'.date("Y-m-d").'" min ="'.date("Y-m-d").'" onchange="myDate()"> '; ?>
			</div>
			<div class="form-group">
				<label for="">Fecha de Culminación</label>
				<!--<input class="form-control" type="date" name="dateEnd" required >-->
				<?php print '<input id="myDateEnd" class="form-control" type="date" name="dateEnd" required value ="'.date("Y-m-d").'" min ="'.date("Y-m-d").'">'; ?>
			</div>
			<?php print '<input type="text" name="idUser" value="'.$_SESSION['idUsuario'].'" hidden>';  ?>
			<div class="form-group">
				<label for=""></label>
				<input class="form-control btn btn-primary" type="submit" value="Crear">
			</div>
		</form>
		</div>
	</div>
	<script>
	//Validar fecha inicio/fin de campaña
	function myDate(){
		var minVal = document.getElementById("myDateStart").value;
		document.getElementById("myDateEnd").value = minVal;
		document.getElementById("myDateEnd").min = minVal;


	}
	</script>
</body>
</html>
<?php }else {
	header('Location: /campaign/login.html');
}
?>