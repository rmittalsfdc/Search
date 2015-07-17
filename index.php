<?php

$conn_string = "host=ec2-54-83-36-176.compute-1.amazonaws.com port=5432 dbname=df8k1m58fmo0qg user=fcjoasuytuksub password=w4xmCijZpUq1EEmpY00RiFyjeH";
    $dbconn4 = pg_connect($conn_string);
	if(!$dbconn4){
      echo "Error : Unable to open database\n";
	  exit();

/*$servername = "ec2-54-83-36-176.compute-1.amazonaws.com";
$username = "fcjoasuytuksub";
$password = "w4xmCijZpUq1EEmpY00RiFyjeH";
$dbname = "df8k1m58fmo0qg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */
$output ='';
//collect
if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	print("before the query");
	$sql = "SELECT * FROM company Where First_Name LIKE '%$searchq%' OR Last_Name LIKE '%$searchq%'";
	$count = $conn->query($sql);
	print("Count of records= $count");
	if($count->num_rows == 0){
		$output = 'There were no search records';
	}else{
		while($row = $count->fetch_assoc()){
			$fname = $row['First_Name'];
			$lname = $row['Last_Name'];
			$age = $row['Age'];
			$address = $row['Address'];
			$id = $row['id'];
			
			$output .= '<div>'.$id.' '.$fname.' '.$lname.' '.$age.' '.$address.'</div>';
		}
	}
	print("$output");
}
?>

<form action="index.php" method="post">
	<input type="text" name="search" placeholder="Search for members" />
	<input type="submit" value="Search" /> 
</form>

<h3><?php print("$output");?><h3>
