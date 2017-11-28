<?php

$con = pg_connect("host=localhost dbname=odontopraxis user=postgres password=Odon1234")
    or die('No se ha podido conectar: ' . pg_last_error());

$q=$_POST['q'];

$sql="SELECT * FROM cod_prestacion WHERE cod_prestacion='".$q."'";
$res=pg_query($con, $sql);

if(pg_num_rows($res)==0){

echo '<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i>';

}else{

while($fila=pg_fetch_array($res)){

echo $fila['descripcion'];

}

}

?>