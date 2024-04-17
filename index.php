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
	<title>Control</title>
	<style>
	body{
		background-color: #dbdde0;
	}
	.sizeCtrl{
		max-height: 250px;
		
	}
	.bk1, .bk2, .bk3{
		max-height: 250px;
		margin: 10px;
		background-color: #FFFFFF;
		border-radius: 10px;
		text-align: center;
		
	}
	/*Color borde opc menú*/
	.bk1{
		border: solid rgb(255,128,0);
	}
	.bk2{
		border: solid rgb(73,153,0);
	}
	.bk3{
		border: solid rgb(0,128,255);
	}
	.imgCtrlIndex{
		max-width: 100%;
		max-height: 120px;
		border-radius: 10px;
	}
	/*Efecto hover imagenes menú*/
	.bk1:hover{
		margin: 0px;
		border-radius: 10px;
		border: solid rgb(255,128,0);
	}
	.bk2:hover{
		margin: 0px;
		border-radius: 10px;
		border: solid rgb(73,153,0);
	}
	.bk3:hover{
		margin: 0px;
		border-radius: 10px;
		border: solid rgb(0,128,255);
	}
	/*Fin efecto hover*/
	</style>
</head>
<body>
	<?php require_once('header.php'); ?>
	<div class="">
		<div class="col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-1">
			<h1 class="text-center">Control de Campañas de Vacunación</h1>
			<br>
			<br>
			<!--Menu central de opciones-->
			<div class="col-md-4 sizeCtrl">
				<div class="bk1">
					<h3 class="text-center">Campañas</h3>
					<a href="campaigns.php"><img class="imgCtrlIndex" src="img/campain.jpg" alt=""></a>
				</div>
			</div>

			<div class="col-md-4 sizeCtrl">
				<div class="bk2">
					<h3 class="text-center">Mascotas</h3>
					<a href="pets.php"><img class="imgCtrlIndex" src="img/pets.jpg" alt=""></a>
				</div>
			</div>

			<div class="col-md-4 sizeCtrl">
				<div class="bk3">
					<h3 class="text-center">Estadisticas</h3>
					<a href="statistics.php"><img class="imgCtrlIndex" src="img/sta.jpg" alt=""></a>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>


<?php }else {
	header('Location: /campaign/login.html');
}
?>
