<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio de sesión</title>
	<link rel="icon" href="img/logoicon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>
<body>
<style>
	@import url(http://fonts.googleapis.com/css?family=Roboto:400);
body {
  background-image: url('./img/DSC_0066.JPG');
  background-attachment: fixed;
  background-repeat: no-repeat;
  -webkit-font-smoothing: antialiased;
  font: normal 14px Roboto,arial,sans-serif;
}

.container {
    padding: 10px;
}

.form-login {
    background-color: #E2F9FF;
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 15px;
    padding-right: 15px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
    

}

h3 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}

.form-control {
    border-radius: 10px;
}

.wrapper {
    text-align: center;
}

</style>

<div class="container" style="color: white;">
    
</style>
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
<img src="img/logo.png" alt="Odontopraxis americana S.A." class="img-rounded img-responsive center-block">
</div>
<div class="col-md-offset-2 col-lg-offset-2 col-sm-offset-2 col-xs-offset-2 col-md-9 col-lg-9 col-sm-9 col-xs-9">
    <h3 class="text-center" style="padding-right: 7%;">Configuración de perfil</h3>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-offset-3 col-lg-offset-3 col-sm-offset-3 col-xs-offset-3 col-md-6 col-lg-6 col-sm-6 col-xs-6">
        <div class="form-login">
            <h3 style="color: black;">Ingreso</h3>
            <form action="login.php" method="POST">
            <input type="text" id="userName" class="form-control input-sm chat-input text-center" placeholder="username"  name="usuario" required="" />
            </br>
            <input type="password" id="userPassword" class="form-control input-sm chat-input text-center" placeholder="password" name="password" required="" />
            </br>
            <div class="text-center">
                <a href="olvidoPassEntidad.php" style="color: grey;">Olvidé mi contraseña </a>
            </div>
            <hr>
            <div class="wrapper">
            <span class="group-btn">
               <input type="submit" class="btn btn-primary btn-md" name="submit" value="Entrar">
               </span>
            </div>
            </form>
        </div>
    </div>      
</div>
<br>
<br>
<br>
<hr>
    <div class="bottom-right">
            <div class="row col-12">
                <div class="col-sm-6">
                    <p>Odontopraxis Americana <?php date_default_timezone_set('America/Argentina/Buenos_Aires'); echo date('Y'); ?>® Todos los derechosreservados.</p>
                </div>
            </div>
            
    </div>
</div>

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
</body>
</html>