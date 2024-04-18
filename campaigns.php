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
	<title>Campañas</title>
</head>
<body>
	<?php require_once('header.php'); ?>
	<?php require_once('/db/conexion.php'); 
	$conn = dbConexion();
	//Cargamos todas las campañas del usuario logeado
	$sql = "SELECT `id`, `campaignName`, `vaccine`, `dateStart`, `dateEnd` FROM `campaigns` WHERE `idUser` = ".$_SESSION['idUsuario'];
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	?>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="text-center">Campañas Registradas</h3>
			<table class="table table-striped">
				<tr>
					<th>Nombre</th>
					<th>Vacuna</th>
					<th>Inicia</th>
					<th>Finaliza</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<!--Aqui mostramos las campañas creadas por el usuario logeado-->				
				<?php foreach ($rows as $row) {	?>
					<tr>						
						<td><?php echo $row['campaignName']; ?></td>
						<td><?php echo $row['vaccine']; ?></td>
						<td><?php echo $row['dateStart']; ?></td>
						<td><?php echo $row['dateEnd']; ?></td>
						<?php print '<td class="text-center"><form action="pets-campaign.php"><input type="text" value = "'.$row['id'].'" name="idSeePetsCampaign" hidden> <input class="btn btn-success btn-xs" type="submit" value="Ver"> </form></td>'; ?>
						<?php print '<td class="text-center"><form action="update-campaign.php"><input type="text" value = "'.$row['id'].'" name="idCampaignUpdate" hidden> <input class="btn btn-warning btn-xs" type="submit" value="Modificar"> </form></td>'; ?>	
						<?php print '<td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modDelCamp" data-whatever="'.$row['id'].'">Eliminar</button></td>' ?>

					</tr>
				<?php } ?>
				<!-- Fin -->
			</table>
		</div>
	</div>

	<!--MODAL OPCIÓN ELIMINAR-->
	<div class="modal fade" id="modDelCamp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Atención</h4>
	      </div>
	      <div class="modal-body">
	        <form action="db/delete_campaign.php">
	          <div class="form-group">
	            <input type="text" id="recipient-name" name="idCampaignDelete" hidden> <!-- ID de la campaña a eliminar -->
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
	<!--FIN MODAL ELIMINAR-->
	<script>
		//Script modal eliminar
		$('#modDelCamp').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget);
		  var recipient = button.data('whatever');

		  var modal = $(this);

		  modal.find('.modal-body input').val(recipient); //Agregamos a modal el id de la campaña a eliminar
		})
	</script>
</body>
</html>
<?php }else {
	header('Location: /campaign/login.html');
}
?>

