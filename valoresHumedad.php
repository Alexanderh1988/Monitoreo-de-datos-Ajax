<?php 

$con = mysqli_connect('localhost','base de datos','contraseña bd','usuario bd');

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_example");

if($_GET){
 if(isset($_GET['last'])){
	$sql="SELECT * FROM MedicionHumedadMirs WHERE shown=1 ORDER BY id DESC LIMIT 1 ";
}

if(isset($_GET['A'])){
$tabla1	 = $_GET['A'];
$sql="SELECT * FROM MedicionHumedadMirs WHERE Tabla='".$tabla1."'";	
	}

 	if(isset($_GET['borrar'])){
  	 //$sql="DELETE FROM `MedicionHumedadMirs` WHERE Tabla=""";
  	   	 //$sql="DELETE FROM `MedicionHumedadMirs` WHERE Tabla='def' AND shown=1";
 		$sql="DELETE FROM `MedicionHumedadMirs` WHERE Tabla='' AND shown=1";
  }

  if(isset($_GET['grabar'])){

  	//$sql="UPDATE `MedicionHumedadMirs` SET `shown`=0 WHERE 1 AND Tabla!='def'";
  		$sql="UPDATE `MedicionHumedadMirs` SET `shown`=0 WHERE 1 AND Tabla!=' '";
  }
} else
{
	$sql="SELECT * FROM MedicionHumedadMirs WHERE shown=1";
} 

  
echo '[';

//extraer maximo valor:
//$sqlXmax="SELECT x FROM `MedicionHumedadMirs` WHERE x = (SELECT MAX(x) from MedicionHumedadMirs)";

// $sqlXmax="SELECT MAX(x) from MedicionHumedadMirs";
// //$sqlTable="SELECT * FROM MedicionRuidoMirs";
// $resultMax = mysqli_query($con,$sqlXmax);
// $XArray = mysqli_fetch_assoc($resultMax);
// $XName =implode("", $XArray);
// $xMax = (string)$XName;


$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {

	$x=$row['x'];
	$y=$row['y'];

	echo "[".$x.",".$y."],";

}
echo '['.$x.','.$y.']]';

if($_POST){		

	//if(isset($_POST['x'])){
$ValorX = $_POST['x'];
//}
//if(isset($_POST['y'])){
$ValorY = $_POST['y'];

/*	$result = mysqli_query($con,$sqlTable);
	while($row	 = mysqli_fetch_array($result)) {
	$ValorTable = $row['Tabla'];*/
	//var_dump($ValorTable);
//}

if(isset($_POST['Tabla'])){
$ValorTable = $_POST['Tabla'];
 }
 else
 {

$sqlTable="SELECT Tabla FROM MedicionHumedadMirs WHERE shown=1 ORDER BY id DESC LIMIT 1";
//$sqlTable="SELECT * FROM MedicionRuidoMirs";
$result = mysqli_query($con,$sqlTable);
$TableArray = mysqli_fetch_assoc($result);
$TableName =implode("", $TableArray);
$ValorTable = (string)$TableName;
//}

}

$insertsql="INSERT INTO `MedicionHumedadMirs`(`Tabla`, `x`, `y`) VALUES ('".$ValorTable."','".$ValorX."','".$ValorY."')";
    $con->query($insertsql);
}
	mysqli_close($con);
   		
?>