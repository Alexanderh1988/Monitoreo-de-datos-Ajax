<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

//local:
//$con = mysqli_connect("localhost", "root", "", "chs44206_dbhstech");
//server:
$con = mysqli_connect('localhost','chs44206_hstech','k5m5[1vP^~ZD','chs44206_dbhstech');

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_example");
//$sql="SELECT * FROM tablagraficos WHERE id < '".$q."'";
$sql="SELECT * FROM MedicionHumedadMirs";
//echo $sql;
$result = mysqli_query($con,$sql);

$numberoDeColumnas = "SELECT COUNT(*) FROM MedicionHumedadMirs";
//var_dump($numberoDeColumnas );

// $result="SELECT id FROM MedicionHumedadMirs";
// $rows = mysqli_num_rows($result); 
// echo '$rows';

// $numberoDeColumnas = "SELECT COUNT(*) FROM MedicionHumedadMirs";

// $count = mysqli_query($con,$numberoDeColumnas);

// echo '$count';


  echo "[";
while($row	 = mysqli_fetch_array($result)) {
//   echo "<tr>";
//   echo "<td>" . $row['x'] . "</td>";
//   echo "<td>" . $row['y'] . "</td>";

//   echo "</tr>";
// }
// echo "</table>";

	echo "[".$row['x'].",".$row['y']."],";
}

	mysqli_close($con);
		echo "[0,0]]"


	echo	"[[1,15],[2,16],[3,13],[4,13],[5,14],[6,14],[7,11],[8,12],[9,17],[10,21],[11,22],[12,21],[13,19],[14,17],[15,21],[16,17],[17,16],[18,18],[19,22],[20,23],[21,25],[22,26],[23,22],[24,17],[25,16],[26,21],[27,18],[28,20], [8,12]]"
?>
</body>
</html>