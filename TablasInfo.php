<?php
// $q = intval($_GET['q']);

if(isset($_GET)){

$con = mysqli_connect('localhost','nombre BD','clave bd','usuario bd');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_example");

if(isset($_GET['hum'])){
		$sql="SELECT * FROM MedicionHumedadMirs ORDER BY id DESC LIMIT 1";
}
 if(isset($_GET['ruid'])){
			$sql="SELECT * FROM MedicionRuidoMirs ORDER BY id DESC LIMIT 1";
	}


//echo $sql;
$result = mysqli_query($con,$sql);

  
while($row = mysqli_fetch_array($result)) {
    echo "Nombre tabla:" . $row['Tabla'] ;
   
}

mysqli_close($con);

}
?>