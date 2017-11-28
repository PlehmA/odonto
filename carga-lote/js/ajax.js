
function loadXMLDoc() {
var xmlhttp;

var n=document.getElementById('bus').value;

if(n==''){
document.getElementById("myDiv").innerHTML="";
return;
}

if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else {// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function(){ 

	if (xmlhttp.readyState==4 && xmlhttp.status==200){

		document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
	}
}
xmlhttp.open("POST","proc.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+n);

if (n=="01.01") {
	pieza = document.getElementById("piezanum");
	carad = document.getElementById("carad");
	caraio = document.getElementById("caraio");
	caram = document.getElementById("caram");
	carapl = document.getElementById("carapl");
	carav = document.getElementById("carav");
	pieza.style.display='none';
	carad.style.display='none';
	caraio.style.display='none';
	caram.style.display='none';
	carapl.style.display='none';
	carav.style.display='none';
}else if (n=="05.01") {
	pieza = document.getElementById("piezanum");
	carad = document.getElementById("carad");
	caraio = document.getElementById("caraio");
	caram = document.getElementById("caram");
	carapl = document.getElementById("carapl");
	carav = document.getElementById("carav");
	pieza.style.display='none';
	carad.style.display='none';
	caraio.style.display='none';
	caram.style.display='none';
	carapl.style.display='none';
	carav.style.display='none';
}else if (n=="07.01") {
	pieza = document.getElementById("piezanum");
	carad = document.getElementById("carad");
	caraio = document.getElementById("caraio");
	caram = document.getElementById("caram");
	carapl = document.getElementById("carapl");
	carav = document.getElementById("carav");
	pieza.style.display='none';
	carad.style.display='none';
	caraio.style.display='none';
	caram.style.display='none';
	carapl.style.display='none';
	carav.style.display='none';
}else if (n=="02.01") {
	pieza = document.getElementById("piezanum").required=true;
}else if (n=="02.02") {
	pieza = document.getElementById("piezanum").required=true;
}else if (n=="10.01") {
	pieza = document.getElementById("piezanum").required=true;
	carad = document.getElementById("carad");
	caraio = document.getElementById("caraio");
	caram = document.getElementById("caram");
	carapl = document.getElementById("carapl");
	carav = document.getElementById("carav");
	carad.style.display='none';
	caraio.style.display='none';
	caram.style.display='none';
	carapl.style.display='none';
	carav.style.display='none';
}else {
	pieza = document.getElementById("piezanum");
	carad = document.getElementById("carad");
	caraio = document.getElementById("caraio");
	caram = document.getElementById("caram");
	carapl = document.getElementById("carapl");
	carav = document.getElementById("carav");
	pieza.style.display='initial';
	carad.style.display='initial';
	caraio.style.display='initial';
	caram.style.display='initial';
	carapl.style.display='initial';
	carav.style.display='initial';
}

}