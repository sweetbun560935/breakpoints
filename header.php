<!-- HEADER CON OPCIONES DE NAVEGACION -->
<?php require_once('/db/conexion.php'); 
  $conn = dbConexion();
  //Seleccionamos el nombre del usuario logeado
  $sqlU = "SELECT name FROM user  WHERE id =".$_SESSION['idUsuario']." ";
  $resultU = $conn->query($sqlU);
  $uName = $resultU->fetch(PDO::FETCH_ASSOC);
  ?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Campañas de Vacunación</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <a class="btn btn-warning navbar-btn" href="add-campaign.php">Crear Campaña</a>
        <a class="btn btn-success navbar-btn" href="add-pets.php">Alta Mascota</a>
          <!-- Mostramos nombre de usuario logeado -->
          <a href="#" class="btn btn-danger navbar-btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php print $uName['name']  ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="profile.php">Perfil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="exit.php">Salir</a></li>
          </ul>
      </ul>
    </div>
  </div>
</nav>
