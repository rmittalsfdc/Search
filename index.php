<?php
include_once('postgredb.php');
$output = '<div>No Result found.</div>';
if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	//$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	
	$dbname = "df8k1m58fmo0qg";
	$host = "ec2-54-83-36-176.compute-1.amazonaws.com";
	$port = 5432;
	$user = "fcjoasuytuksub";
	$password = "w4xmCijZpUq1EEmpY00RiFyjeH";
	$persistent = 0;

	$dbdrv=new PostgreDB ($dbname, $host, $port, $user, $password, $persistent);
	/* construct connection to database $dbname, with URL: $host, username is $user, password is $pass. If $persistent!=0 then function pg_pconnect is used otherwise pg_connect. */
	$dbdrv->Begin();// Begin transaction block 
	echo $sql="SELECT * FROM Company Where First_Name LIKE '%$searchq%' OR Last_Name LIKE '%$searchq%'";
	if (!$dbdrv->ExecQuery($sql)) // Execute query or die if error is occured
	    die ($dbdrv->Error());
	for ($row=0; $result=$dbdrv->FetchResult($row, PGSQL_BOTH); $row++)
	{
	    $fname = $row['first_name'];
		$lname = $row['last_name'];
		$age = $row['age'];
		$address = $row['address'];
		$id = $row['id'];
		
		$output .= '<div>'.$id.' '.$fname.' '.$lname.' '.$age.' '.$address.'</div>';
	}
	$dbdrv->Commit();// Commit transaction
	$dbdrv->DBClose();// Close connection with database
}
/*
$conn_string = "host= port= dbname= user= password=";
$dbconn4 = pg_connect($conn_string);
	if(!$dbconn4){
      echo "Error : Unable to open database\n";
	  exit();
*/
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
/*
$output ='';
if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	echo "before the query";
	$sql = "SELECT * FROM company Where First_Name LIKE '%$searchq%' OR Last_Name LIKE '%$searchq%'";
	$count = $conn->query($sql);
	echo "Count of records= ". $count;
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
	echo $output;
}*/
?>

<form action="index.php" method="post">
	<input type="text" name="search" placeholder="Search for members" />
	<input type="submit" value="Search" /> 
</form>

<h3><?php echo $output;?></h3>
