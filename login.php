<?php

session_start();

if ((!isset($_POST['usuario'])) || (!isset($_POST['password']))) {

	echo "<script>alert('Por favor complete todos los campos');</script>";

	echo "<script>window.location.assign('logout.php');</script>";

} elseif ($_POST['usuario'] == "") {

	echo "<script>alert('Por favor complete el usuario');</script>";

	echo "<script>window.location.assign('logout.php');</script>";

}else{

include ('includes/dbconnect.php');

	$username = htmlentities($_POST['usuario']);
	$contra = htmlentities($_POST['password']);

$sql = "SELECT * FROM users_entidades WHERE nombre='$username' AND clave='$contra'";

$result = pg_query($con, $sql);

$fill = pg_num_rows($result);

	if ($fill <= 0) {

		echo "<script>alert('Usuario y contraseña incorrecta o inexistente');</script>";
		echo "<script>window.location.assign('logout.php');</script>";

	}else {

		$row = pg_fetch_array($result, null, PGSQL_BOTH);

			$_SESSION['activo'] = $row['activo'];

		if ($_SESSION['activo'] == "N" ) {

			echo "<script>alert('Su cuenta se encuentra inactiva');</script>";
			echo "<script>window.location.assign('logout.php');</script>";

		}else{

			$_SESSION['id'] = $row['id'];
			$_SESSION['nombre'] = $row['nombre'];
			$_SESSION['cuit'] = $row['cuit'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['fecha_reg'] = $row['fecha_reg'];
			$_SESSION['foto'] = $row['foto'];
			$_SESSION['tel'] = $row['tel'];
			$_SESSION['prestador'] = $row['prestador'];
			$_SESSION['rol_usuario'] = $row['rol_usuario'];
			$_SESSION['logeado'] = true;
			$_SESSION['adm'] = $row['adm'];
			$_SESSION['clave'] = $row['clave'];
			$_SESSION['start'] = time();
			
			$_SESSION['expire'] = time()-$_SESSION['start'];

			echo "<script>window.location.assign('home/index.php');</script>";

		}

	}

	pg_close($con);
unset($result);
unset($row);
unset($fill);
}
?>