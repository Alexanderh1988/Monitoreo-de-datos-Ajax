<!DOCTYPE HTML>
<html>
<head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- necesarios para post ajax: -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

<script type="text/javascript">
	   
var dataPoints1 = [];
var dataPoints2 = [];
var chart1;
var chart2;
var tabla1;
var tabla2;

 function graph() {


 			const queryString = window.location.search;
			//console.log(queryString);

			const urlParams = new URLSearchParams(queryString);

			tabla1 = urlParams.get('A')
			

			 tabla2 = urlParams.get('B')
			

 chart1 = new CanvasJS.Chart("chartContainer1",{
	title:{
	//	text:"Valores de humedad de tierra"
	},
	data: [{
		type: "line",
		dataPoints : dataPoints1,
	}]
});

 if(tabla1 == null){
 	$.getJSON("http://hstech.cl/graficos/valoresHumedad.php", function(data) {  

//$.getJSON("http://hstech.cl/graficos/puntos.php", function(data) {  

		$.each(data, function(key, value){
			dataPoints1.push({x: value[0], y: parseInt(value[1])});
	});	
	chart1.render();
		console.log("RenderChart1");
});
 } else{
 	$.getJSON("http://hstech.cl/graficos/valoresHumedad.php?tabla1=".tabla1, function(data) {  

//$.getJSON("http://hstech.cl/graficos/puntos.php", function(data) {  

		$.each(data, function(key, value){
			dataPoints1.push({x: value[0], y: parseInt(value[1])});
	});	
	chart1.render();
		console.log("RenderChart1");
});
 }


 chart2 = new CanvasJS.Chart("chartContainer2",{
	title:{
		//text:"Valores de sonido"
		//text:"Valores de sonido"
	},
	data: [{
		type: "line",
		dataPoints : dataPoints2,
	}]
});
	
if(tabla2==true){
	 $.getJSON("http://hstech.cl/graficos/valoresSonido.php", function(data) {  

//$.getJSON("http://localhost/realtimegraph3/prueba4.html", function(data) {  
	$.each(data, function(key, value){
		dataPoints2.push({x: value[0], y: parseInt(value[1])});
 	});	
chart2.render();
console.log("RenderChart2");
 });
} else{
	 $.getJSON("http://hstech.cl/graficos/valoresSonido.php?tabla2=".tabla2, function(data) {  

//$.getJSON("http://localhost/realtimegraph3/prueba4.html", function(data) {  
	$.each(data, function(key, value){
		dataPoints2.push({x: value[0], y: parseInt(value[1])});
 	});	
chart2.render();
console.log("RenderChart2");
 });
}


if(tabla1==null && tabla2==null){
 UpdateCharts();
}

}

function UpdateCharts(){

console.log("UpdateChart1");

$.getJSON("http://hstech.cl/graficos/valoresHumedad.php?last=true", function(data) {  

//$.getJSON("http://hstech.cl/graficos/puntos.php", function(data) {  
try{
		$.each(data, function(key, value){
			dataPoints1.push({x: value[0], y: parseInt(value[1])});
	});	
	chart1.render();
}
	catch(err){
	console.log("no hay nuevos datos"+err);
}	
});

console.log("UpdateChart2");
	 	
$.getJSON("http://hstech.cl/graficos/valoresSonido.php?last=true", function(data) {  

		try{
	$.each(data, function(key, value){
		dataPoints2.push({x: value[0], y: parseInt(value[1])});
	});	
	chart2.render();
}
	catch(err){
	console.log("no hay nuevos datos"+err);
}	

	 }
);

UpdateTableInfo();

setTimeout(function(){UpdateCharts()},1000);

}

function UpdateTableInfo(){

	  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("medicionHum").innerHTML = this.responseText;
      }
    };
//    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.open("GET","TablasInfo.php?hum=true",true);
    xmlhttp.send();

      var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("medicionRuido").innerHTML = this.responseText;
      }
    };
//    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.open("GET","TablasInfo.php?ruid=true",true);
    xmlhttp.send();

}

function borrarHum(){

	  var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET","valoresHumedad.php?borrar=true",true);
      xmlhttp.send();

}

function borrarSon(){

	  var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET","valoresSonido.php?borrar=true",true);
      xmlhttp.send();

}

function desaparecerValoresGrabadosHum(){


		  var xmlhttp = new XMLHttpRequest();
       	 xmlhttp.open("GET","valoresHumedad.php?grabar=true",true);
     xmlhttp.send();
}

function desaparecerValoresGrabadosRui(){


 	  var xmlhttp = new XMLHttpRequest();
       	 xmlhttp.open("GET","valoresSonido.php?grabar=true",true);
     xmlhttp.send();

}



</script>

</head>

 <body onload="graph();"> 
	<!-- <body onload="function1(); function2();"> -->
<!-- <body onload="function1(); function2();"> -->
 <!-- <div id="chartContainer1" style="height: 300px; width: 80%;"></div>  -->
 <div  style="height: 20px; width: 80%;  margin-left:5%;">
 	<h1> Valores de humedad de tierra</h1>
 </div>  <br><br>
 <div id="chartContainer1" style="height: 250px; width: 80%; margin-left:5%;"></div>  
<br>
<br><br>

 <form id="humForm" action="#" method="post">
<div class="btn-group" style="width: 80%;  margin-left:5%;" >
<!-- <button  type="button" class="btn btn-success" style="width: 160px;">Grabar</button> -->
<button onclick="desaparecerValoresGrabadosHum()" type="button" class="btn btn-info" style="width: 160px;">Terminar grabacion</button>
<!-- <button onclick="GrabarHum()"  class="btn btn-warning" style="width: 160px;">Nueva medicion</button>	 -->
<button type="submit" value="submit" class="btn btn-warning" style="width: 160px;">Nueva medicion</button> 
<button onclick="borrarHum()" class="btn btn-primary" style="width: 160px;">Reset </button> 
</div>
<br><br>

  <div class="input-group" style="width: 30%;  margin-left:5%;">
    <span class="input-group-addon">Nombre tabla:</span>
    <input name="valorTablaHum" id="msg" type="text" class="form-control" placeholder="Escribir nombre antes de nueva medicion">

    <span id="medicionHum" class="input-group-addon">Grabado :</span> 
  </div>
</form>
<!-- <div onload="function2();" style="height: 300px; width: 80%; left:20%"></div> -->
<div   style="height: 30px; width: 80%; margin-left:5%; ">
 	<h1> Valores de sonido</h1>
 </div>  
 
 <div id="chartContainer2" style="height: 250px; width: 80%;  margin-left:5%; top:20px;padding-top: 20px;"></div> 

<br>
<br>
 <form id="humForm" action="#" method="post">
<!-- <div class="btn-group" style="width: 80%;  margin-left:5%;" > -->
	<div class="btn-group" style="width: 80%;  margin-left:5%;" >
<!-- <button type="button" class="btn btn-success" style="width: 160px;">Grabar</button> -->
<button onclick="desaparecerValoresGrabadosRui()" class="btn btn-info" >Terminar grabacion</button>
<button type="submit" name="submit" class="btn btn-warning" >Nueva medicion</button>
<button onclick="borrarSon()" class="btn btn-primary" style="width: 160px;">Reset</button> 

</div>
<br><br>
 
  <div class="input-group" style="width: 30%;  margin-left:5%;">
    <span class="input-group-addon">Nombre tabla:</span>
    <input name="valorTablaRuido" id="msg" type="text" class="form-control" placeholder="Escribir nombre antes de nueva medicion">
     <span id="medicionRuido" class="input-group-addon">Nombre Grabado:</span> 
  </div>
  </form>
  <br><br>

</body>
</html>

<?php 

if($_POST){

$con = mysqli_connect('localhost','aqui tu nombre base de datos','clave de tu bd','Aqui tu usuario de bd');

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

if(isset($_POST['valorTablaRuido'])){

	$valorTablaRuido = $_POST['valorTablaRuido'];
	
	$UpdateLastTablesql= "UPDATE `MedicionRuidoMirs` SET Tabla='".$valorTablaRuido."'  ORDER BY ID DESC LIMIT 1";
}

if(isset($_POST['valorTablaHum'])){

$valorTablaHum = $_POST['valorTablaHum'];

$UpdateLastTablesql="UPDATE `MedicionHumedadMirs` SET Tabla='".$valorTablaHum."' ORDER BY ID DESC LIMIT 1";

}

 $con->query($UpdateLastTablesql);
	mysqli_close($con);
}
?>