<?php 
session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logoicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/afi_style.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
     <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
    <link href='http://fonts.googleapis.com/css?family=Spirax' rel='stylesheet' type='text/css'>
  </head>
  <body>

  	<!--audio src="img/jinglebells.mp3" controls autoplay loop></audio-->
  	<?php include 'template/header.php'; ?>
<div id="container">
<h1 style="color: white; padding: 20px; text-align: center;">CAMBIO DE PERIODO</h1>

<div class="container">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-inline" method="POST">
		<select name="mesperiodo" id="" class="form-control w-25">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		<select name="anioperiodo" id="" class="form-control w-25 ml-5">
			<option value="2017">2017</option>
			<option value="2017">2018</option>
			<option value="2017">2019</option>
			<option value="2017">2020</option>
			<option value="2017">2021</option>
			<option value="2017">2022</option>
		</select>
		<input type="submit" class="btn btn-outline-info ml-5" value="Cambiar" name="submit">
	</form>
<?php 
include 'includes/dbconnect.php';
if (isset($_POST['submit'])) {
$mesperiodo = $_POST['mesperiodo'];
$anioperiodo = $_POST['anioperiodo'];

$sql = "UPDATE periodo SET mes_presentacion=".$mesperiodo.", anio_presentacion=".$anioperiodo." WHERE id=1";
$result = pg_query($con, $sql) or die(pg_result_error());



}
$sql = "SELECT * FROM periodo";
$result = pg_query($con, $sql);
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
echo "<br><hr><br><h6>PERIODO ACTUAL: 0".$row['mes_presentacion']."/".$row['anio_presentacion']."</h6>";
?>

</div>
</div>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

  </body>
  </html>