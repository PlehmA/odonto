<?php 
session_start();
session_destroy();
$inactivo = $_SESSION['logeado'] == false;
print $inactivo;
header("Location: ../index.php");
?>