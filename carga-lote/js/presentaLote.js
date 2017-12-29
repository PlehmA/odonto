function presentaLote(){
    	if (window.confirm("¿Seguro desea presentar el lote?")) {
        if (window.confirm("Recuerde que es un Lote por Periodo")) {
        	window.open('compropresenta.php');
    		document.location.href = "presentalote.php";
  }
}
}