<?php 

$con = mysqli_connect('localhost','chs44206_hstech','k5m5[1vP^~ZD','chs44206_dbhstech');

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_example");
//$sql="SELECT * FROM tablagraficos WHERE id < '".$q."'";

if($_GET){
 if(isset($_GET['last'])){
	$sql="SELECT * FROM MedicionRuidoMirs WHERE shown=1 ORDER BY id DESC LIMIT 1";
} 
if(isset($_GET['B'])){
$tabla2	 = $_GET['B'];
$sql="SELECT * FROM MedicionRuidoMirs WHERE Tabla='".$tabla2."'";	
	}

 if(isset($_GET['borrar'])){
 	 //$sql="DELETE FROM `MedicionRuidoMirs` WHERE Tabla=""";
 	  	 //$sql="DELETE FROM `MedicionRuidoMirs` WHERE Tabla='def' AND shown=1";
 	  	 $sql="DELETE FROM `MedicionRuidoMirs` WHERE Tabla='' AND shown=1";
 	}

  if(isset($_GET['grabar'])){

  	//$sql="UPDATE `MedicionRuidoMirs` SET `shown`=0 WHERE 1 AND Tabla!='def'";
  		$sql="UPDATE `MedicionRuidoMirs` SET `shown`=0 WHERE 1 AND Tabla!=''";
  }
 	}
 	else
{
 $sql="SELECT * FROM MedicionRuidoMirs WHERE shown=1";
}


echo '[';

$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {

	echo '['.$row['x'].','.$row['y'].'],';

	$x=$row['x'];
	$y=$row['y'];
}

echo '['.$x.','.$y.']]';

//if(true){	
if($_POST){

//if(isset($_POST['x'])){
$ValorX = $_POST['x'];
//}
//if(isset($_POST['y'])){
$ValorY = $_POST['y'];
//}

//if(isset($_POST['Tabla']) &&  !empty($_POST['Tabla'])){

if(isset($_POST['Tabla'])){
$ValorTable = $_POST['Tabla']; 
}
else {

$sqlTable=("SELECT Tabla FROM MedicionRuidoMirs ORDER BY id DESC LIMIT 1");
//$sqlTable="SELECT * FROM MedicionRuidoMirs";
$result = mysqli_query($con,$sqlTable);
$TableArray = mysqli_fetch_assoc($result);
$TableName =implode("", $TableArray);
$ValorTable = (string)$TableName;

}

$insertsql="INSERT INTO `MedicionRuidoMirs`(`Tabla`, `x`, `y`) VALUES ('".$ValorTable."','".$ValorX."','".$ValorY."')";

// else
// {
// 	$insertsql="INSERT INTO `MedicionRuidoMirs`( `x`, `y`) VALUES ('".$ValorX."','".$ValorY."')";
// }
        $con->query($insertsql);
}
 		
   		mysqli_close($con);
?>