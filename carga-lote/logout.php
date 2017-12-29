<?php 
session_start();
session_destroy();
$inactivo = $_SESSION['logeado'] == false;
print $inactivo;
unset($_SESSION);
header("Location: ../index.php");
?>