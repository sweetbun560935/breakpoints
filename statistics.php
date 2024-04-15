<?php
session_start();
?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>

<?php require_once('/db/conexion.php'); 
  $conn = dbConexion();
  /// COUNT PARA CANTIDAD DE PERROS REGISTRADOS
  $sqlD = "SELECT COUNT(*) FROM pets INNER JOIN campaigns on pets.idCampaign = campaigns.id WHERE pets.type = 'Perro' and campaigns.idUser =".$_SESSION['idUsuario'];
  $resultD = $conn->query($sqlD);
  $dog = $resultD->fetch(PDO::FETCH_ASSOC);
  ///FIN PERROS

  /// COUTS PARA CANTIDAD DE GATOS REGISTRADOS
  $sqlC = "SELECT COUNT(*) FROM pets INNER JOIN campaigns on pets.idCampaign = campaigns.id WHERE pets.type = 'Gato' and campaigns.idUser =".$_SESSION['idUsuario'];
  $resultC = $conn->query($sqlC);
  $cat = $resultC->fetch(PDO::FETCH_ASSOC);
  ///FIN GATOS

  ///INFORMACION PARA GRAFICA 2

  //Seleccionamos todas las campañas creadas por el usuario logeado
  $sqlCamp = "SELECT campaigns.id FROM `campaigns` where campaigns.idUser =".$_SESSION['idUsuario'];
  $resultCamp = $conn->query($sqlCamp);
  $rowsCamp = $resultCamp->fetchAll();

  $datoCant[] = array();
  $datoNomCam = array();
  $cont = 0;
  $i = 0;
  //ciclo para seleccionar informacion de campaña
  foreach ($rowsCamp as $camp) {

  	//Guardado en array el nombre de campaña y la cantidad de mascotas pertenecientes a la campaña
  	$sqlTotal = "SELECT campaigns.campaignName, COUNT(*) FROM pets INNER JOIN campaigns on pets.idCampaign = campaigns.id where campaigns.id = ".$camp['id'];
  	$resultTotal = $conn->query($sqlTotal);
  	$total = $resultTotal->fetch(PDO::FETCH_ASSOC);

  	$datoCant[$cont] = $total['COUNT(*)']; //cantidad de animales en campaña
  	$datoNomCam[$cont] = $total['campaignName'] ; //nombre de campaña
  	$cont++;

  }
  ///FIN INFORMACIÓN GRAFICA 2
  

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<meta charset="UTF-8">
	<title>Statistics</title>
	<style>
	</style>
	    <script type="text/javascript">
	    //GOOGLE CHARTS API https://developers.google.com/chart/

	      google.charts.load("current", {packages:["corechart"]});
	      google.charts.setOnLoadCallback(drawChart1);
	      google.charts.setOnLoadCallback(drawChart2);
	      //Grafica 1
	      function drawChart1() {
	        var data = google.visualization.arrayToDataTable([
	          ['', ''],
	          ['Perros',     <?php print $dog['COUNT(*)'] ?>],
	          ['Gatos',      <?php print $cat['COUNT(*)'] ?>],
	        ]);

	        var options = {
	          title: 'Mascotas Registradas',
	          pieHole: 0.4,
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
	        chart.draw(data, options);
	         
	      }
	      //Fin grafica 1
	      ////////////////////////////////////////////////////////////////////
	      //Grafica 2 
	      function drawChart2() {
	        var data = google.visualization.arrayToDataTable([
	          ['', ''],
	          <?php for($i; $i<$cont; $i++){ ?>
	          ['<?php print $datoNomCam[$i]?>', <?php print $datoCant[$i] ?>],
	          <?php } ?>	
	        ]);

	        var options = {
	          title: 'Mascotas por Campaña'
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	        chart.draw(data, options);
	      }
	      //Fin grafica 2

	      //FIN GRAFICADO
	    </script>
</head>
<body>
	<?php require_once('header.php'); ?>
	<div class="">
		<!--CONTENEDOR GRAFICA 1 -->
		<div class="col-md-6">
			<div id="donutchart" style="width: 100%; height: 500px;"></div>
		</div>
		<!-- CONTENEDOR GRAFICA 2 -->
		<div class="col-md-6">
			<div id="chart_div" style="width: 100%; height: 500px;"></div>
		</div>
	</div>

	<script>

	</script>
	
</body>
</html>

<?php }else {
	header('Location: /campaign/login.html');
}
?>
