<?php include('postgredb.php');
$output = "<div>No Result found.</div>";
if((isset($_POST['ifirstname']) && !empty($_POST['ifirstname'])) || (isset($_POST['ilastname']) && !empty($_POST['ilastname'])) || (isset($_POST['iage']) && !empty($_POST['iage'])) || (isset($_POST['iaddress']) && !empty($_POST['iaddress']))){
	$searchfirstname = trim($_POST['ifirstname']);
	$searchlastname = trim($_POST['ilastname']);
	$searchage = trim($_POST['iage']);
	$searchaddress = trim($_POST['iaddress']);
	//$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	$dbname = "df8k1m58fmo0qg";
	$host = "ec2-54-83-36-176.compute-1.amazonaws.com";
	$port = 5432;
	$user = "fcjoasuytuksub";
	$password = "w4xmCijZpUq1EEmpY00RiFyjeH";
	$persistent = 0;

	$dbdrv=new PostgreDB ($dbname, $host, $port, $user, $password, $persistent);
	$dbdrv->Begin();
	$sql= "SELECT * FROM company Where LOWER(First_Name) LIKE LOWER('%$searchfirstname%') OR LOWER(Last_Name) LIKE LOWER('%$searchlastname%') OR LOWER(Age) LIKE LOWER('%$searchage%') OR LOWER(Address) LIKE LOWER('%$searchaddress%')";
	if (!$dbdrv->ExecQuery($sql)){
	    die ($dbdrv->Error());
	}
	$query = "INSERT INTO company(first_name, last_name, age, address) VALUES('" . $searchfirstname . "', '" . $searchlastname . "', '" . $searchage . "', '" . $searchaddess . "')";
	if (!$dbdrv->ExecQuery($query)){
		die ($dbdrv->Error());
	}
	else{
		echo "Record Inserted";
	}
}
?>

<form action="index.php" method="post">
	<p><label for="ifirstname">First Name:</label> 
	<input type="text" name="ifirstname" placeholder="Search for first name" id="ifirstname"/>
	
	<label for="ilastname">Last Name:</label> 
	<input type="text" name="ilastname" placeholder="Search for last name" id="ilastname"/>
	
	<label for="iage">Age:</label> 
	<input type="text" name="iage" placeholder="Search for age" id="iage"/>
	
	<label for="iaddress">Address:</label> 
	<input type="text" name="iaddress" placeholder="Search for address" id="iaddress"/>
	<input type="submit" value="Search" /> 
	<input type="submit" value="Insert" /> 
	</p>
</form>
<table border="1" style="width:100%">
<tr>
   <th>First Name</th>
   <th>Last Name</th> 
   <th>Age</th>
	<th>Address</th>
 </tr>

 
<?php 
if($dbdrv->NumRows() > 0){
		$output = "";
		for ($row=0; $result=$dbdrv->FetchResult($row, PGSQL_BOTH); $row++)
		{ 
?>
<tr>
   <td align="center"><?php echo $result["first_name"]?></td>
   <td align="center"><?php echo $result["last_name"]?></td> 
   <td align="center"><?php echo $result["age"]?></td>
	<td align="center"><?php echo $result["address"]?></td>
 </tr>
		
<?php
	}
		
	}
	
	$dbdrv->Commit();// Commit transaction
	$dbdrv->DBClose();// Close connection with database
?> 
 
</table>