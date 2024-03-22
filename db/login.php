<?php
//INICIO DE SESIÓN
session_start();
?>

<?php

require_once('conexion.php');

$conn = dbConexion(); 

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
 

$sql = "SELECT * FROM user WHERE username = '$username'";

$result = $conn->query($sql);
$rows = $result->fetchAll();
//Verificaón de existencia y validacion de usuario

foreach ($rows as $row){

	if($username == $row['username'] && $password == $row['password']){

    $_SESSION['loggedin'] = true;
    $_SESSION['idUsuario'] = $row['id'];
    $_SESSION['username'] = $username;
    print $_SESSION['idUsuario'];
    header('Location: /campaign/');
	}
	else{
        print "Usuario o contraseña incorrectos";
    } 
}
 $conn = null;

 ?>
