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
	<title>Campaña</title>
	<style>
	body{
		background-color: #E9EBEE;
	}
	.colDiv{
		background-color: #FFFFFF;
	}

	</style>
</head>
<body>
	<?php require_once('header.php'); ?>
	<?php require_once('/db/conexion.php'); 
	$conn = dbConexion();
	//Se llama a todas las mascotas  pertenecientes a la campaña seleccionada

	//Informacion de la campaña
	$sqlCamp = "SELECT * FROM campaigns WHERE id = ".$_REQUEST['idSeePetsCampaign']."  AND idUser =".$_SESSION['idUsuario']." ";
	$resultCamp = $conn->query($sqlCamp);
	$rowCamp = $resultCamp->fetch(PDO::FETCH_ASSOC);

	//Todas las mascotas de la campaña
	$sqlPets = "SELECT * FROM pets WHERE idCampaign = ".$_REQUEST['idSeePetsCampaign'];
	$resultPets = $conn->query($sqlPets);
	$rowPets = $resultPets->fetchAll();

	?>

	<!-- DATOS DE CAMPAÑA -->
	<div class="row">
		<div class="col-md-3 col-md-offset-1 colDiv">
			<h2 class="text-center">Datos de Campaña</h2>
			<div class="list-group">
				<div class="list-group-item active">
					<h5 class="list-group-item-heading">Campaña</h5>
				</div>
				<div class="list-group-item">
					<p class="list-group-item-text"><?php print $rowCamp['campaignName']; ?></p>
				</div>
				<div class="list-group-item active">
					<h5 class="list-group-item-heading">Vacuna</h5>
				</div>
				<div class="list-group-item">
					<p class="list-group-item-text"><?php print $rowCamp['vaccine']; ?></p>
				</div>
				<div class="list-group-item active">
					<h5 class="list-group-item-heading">Inicia</h5>
				</div>
				<div class="list-group-item">
					<p class="list-group-item-text"><?php print $rowCamp['dateStart']; ?></p>
				</div>	
				<div class="list-group-item active">
					<h5 class="list-group-item-heading">Finaliza</h5>
				</div>
				<div class="list-group-item">
					<p class="list-group-item-text"><?php print $rowCamp['dateEnd']; ?></p>
				</div>			  
			</div>
		</div>
		<!-- Fin datos campaña -->

		<!-- DATOS DE MASCOTAS-->
		<div class="col-md-6 col-md-offset-1">
			<h2 class="text-center">Mascotas Registradas</h2>
			<table class="table table-striped">
				<tr>			
					<th>Nombre Dueño</th>
					<th>Nombre Mascota</th>
					<th>Tipo</th>
					<th>Raza</th>
					<th>Edad</th>
					<th></th>
					<th></th>
				</tr>
				<!--Aqui mostramos las mascotas con el idDel usuario logeado y de la campaña-->
				<?php foreach ($rowPets as $pets) {	?>
					<tr>						
						<td class="text-center"><?php echo $pets['ownerName']; ?></td>
						<td class="text-center"><?php echo $pets['petName']; ?></td>
						<td class="text-center"><?php echo $pets['type']; ?></td>
						<td class="text-center"><?php echo $pets['race']; ?></td>
						<td class="text-center"><?php echo $pets['age']; ?></td>
						<!-- Opción modificar -->						
						<?php print '<td class="text-center"><form action="update-pet.php"><input type="text" value = "'.$pets['id'].'" name="idPetUpdate" hidden> <input class="btn btn-warning btn-xs" type="submit" value="Modificar"> </form></td>'; ?>							
						<!-- Opción eliminar -->
						<?php print '<td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modDelPet" data-whatever="'.$pets['id'].'">Eliminar</button></td>' ?>
					</tr>
						
						
				<?php } ?>
				<!-- Fin Info mascota -->

			</table>
		</div>
	</div>
	<!--MODAL ELIMINAR MASCOTA-->
	<div class="modal fade" id="modDelPet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
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