// This file is for inserting the new members into the database

<?php include('postgredb.php');
$db = pg_connect("host=ec2-54-83-36-176.compute-1.amazonaws.com port=5432 dbname=df8k1m58fmo0qg user=fcjoasuytuksub password=w4xmCijZpUq1EEmpY00RiFyjeH");

$searchfirstname = trim($_POST['ifirstname']);
$searchlastname = trim($_POST['ilastname']);
$searchage = trim($_POST['iage']);
$searchaddress = trim($_POST['iaddress']);

$sql= "INSERT INTO company (First_Name,Last_Name,Age,Address) 
			VALUES ('$searchfirstname','$searchlastname','$searchage','$searchaddress')";
			
/*$output = "<div>No Result found.</div>";
if((isset($_POST['ifirstname']) && !empty($_POST['ifirstname'])) || (isset($_POST['ilastname']) && !empty($_POST['ilastname'])) || (isset($_POST['iage']) && !empty($_POST['iage'])) || (isset($_POST['iaddress']) && !empty($_POST['iaddress']))){
$searchfirstname = trim($_POST['ifirstname']);
$searchlastname = trim($_POST['ilastname']);
$searchage = trim($_POST['iage']);
$searchaddress = trim($_POST['iaddress']);

echo "first name: $searchfirstname";
echo "last name: $searchlastname";


	//$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	$dbname = "df8k1m58fmo0qg";
	$host = "ec2-54-83-36-176.compute-1.amazonaws.com";
	$port = 5432;
	$user = "fcjoasuytuksub";
	$password = "w4xmCijZpUq1EEmpY00RiFyjeH";
	$persistent = 0;
	$dbdrv=new PostgreDB ($dbname, $host, $port, $user, $password, $persistent);
	$dbdrv->Begin();
	$sql= "INSERT INTO company (First_Name,Last_Name,Age,Address) 
			VALUES ('$searchfirstname','$searchlastname',$searchage,'$searchaddress')";
	echo "insert query: $sql";
	
	if (!$dbdrv->EXECUTE ($sql)){
	    //die ($dbdrv->Error());
		echo "error: $dbdrv->Error()";
	}
	
}*/

$result = pg_query($sql);

?>
<form action="index1.php" method="post">
	<p><label for="ifirstname">First Name:</label> 
	<input type="text" name="ifirstname" placeholder="Search for first name" id="ifirstname"/>
	
	<label for="ilastname">Last Name:</label> 
	<input type="text" name="ilastname" placeholder="Search for last name" id="ilastname"/>
	
	<label for="iage">Age:</label> 
	<input type="text" name="iage" placeholder="Search for age" id="iage"/>
	
	<label for="iaddress">Address:</label> 
	<input type="text" name="iaddress" placeholder="Search for address" id="iaddress"/>
	
	<input type="submit" value="Insert" /> 
	</p>
	
</form>