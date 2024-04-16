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
	<script src="js/pag.js"></script>
	<meta charset="UTF-8">
	<title>Mascotas</title>
</head>
<body>
	<?php require_once('header.php'); ?>
	<?php require_once('/db/conexion.php'); 
	$conn = dbConexion();
	//Seleccionamos todas las macotas registradas con el id del usuario logeado 
	$sql = "SELECT campaigns.campaignName, pets.id, pets.ownerName, pets.petName, pets.type, pets.race, pets.age FROM pets INNER JOIN campaigns on pets.idCampaign = campaigns.id WHERE campaigns.idUser =".$_SESSION['idUsuario'];
	$result = $conn->query($sql);
	$rows = $result->fetchAll();

	//Cout para saber cuantas mascotas estan registradas
	$sqlCount = "SELECT COUNT(*) FROM pets INNER JOIN campaigns on pets.idCampaign = campaigns.id WHERE campaigns.idUser =".$_SESSION['idUsuario'];
	$resultCount = $conn->query($sqlCount);
	$count = $resultCount->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<!--Listado de las mascotas registradas del id de usuario logeado-->
			<h3 class="text-center">Mascotas Registradas</h3>
			<table id="myTable" class="table table-striped">
				<tr>
					<th class="text-center">Campaña</th>
					<th class="text-center">Nombre Dueño</th>
					<th class="text-center">Nombre Mascota</th>
					<th class="text-center">Tipo</th>
					<th class="text-center">Raza</th>
					<th class="text-center">Edad</th>
					<th class="text-center"></th>
					<th class="text-center"></th>
				</tr>

				

				<?php foreach ($rows as $row) {	?>
					<tr>						
						<td class="text-center"><?php echo $row['campaignName']; ?></td>
						<td class="text-center"><?php echo $row['ownerName']; ?></td>
						<td class="text-center"><?php echo $row['petName']; ?></td>
						<td class="text-center"><?php echo $row['type']; ?></td>
						<td class="text-center"><?php echo $row['race']; ?></td>
						<td class="text-center"><?php echo $row['age']; ?></td>
						<!-- Opción modificar mascota -->						
						<?php print '<td class="text-center"><form action="update-pet.php"><input type="text" value = "'.$row['id'].'" name="idPetUpdate" hidden> <input class="btn btn-warning btn-xs" type="submit" value="Modificar"> </form></td>'; ?>	
						<!-- Opción eliminar mascota -->
						<?php print '<td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modDelPet" data-whatever="'.$row['id'].'">Eliminar</button></td>' ?>
					</tr>
						
						
				<?php } ?>

				<!-- Fin lista mascotas -->

			</table>
			<!-- Mensaje si no hay mascotas registradas -->
			<?php if($count['COUNT(*)'] == 0) {?>
				<div class="jumbotron col-md-6 col-md-offset-3">
				  <h1 class="text-center">Atención</h1>
				  <p class="text-center">Aún no hay mascotas registradas</p>
				  <p class="text-center"><a class="btn btn-success btn-lg" href="#" role="button">Registrar</a></p>
				</div>
			<?php } ?>
		</div>
	</div>

	<!--MODAL ELIMINAR MASCOTA-->
	<div class="modal fade " id="modDelPet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Atención</h4>
	      </div>
	      <div class="modal-body">
	        <form action="db/delete_pet.php">
	          <div class="form-group">
	            <input type="text" id="recipient-name" name="idPetDelete" hidden>
	          </div>
	          <div class="form-group">
	            <h5 class="text-center">¿Esta seguro de eliminar este elemento?</h5>
	          </div>
	          <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-danger">Eliminar</button>
		      </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	<!--FIN MODAL ELIMINAR MASCOTA-->
	<script>
		//SCRIPT MODAL ELIMINAR MASCOTA
		$('#modDelPet').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget);
		  var recipient = button.data('whatever');
		  
		  var modal = $(this);
		  
		  modal.find('.modal-body input').val(recipient);
		})
	</script>
</body>
</html>
<?php }else {
	header('Location: /campaign/login.html');
}
?>