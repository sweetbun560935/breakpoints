<?php
//Destruimos la sesión iniciada
session_start();
unset($_SESSION['loggedin']);
unset ($_SESSION['username']);
unset($_SESSION['idUsuario']);
session_destroy();

header('Location: /campaign/login.html');

?>