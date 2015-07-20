// This file is for searching the members in the database.

<?php include('postgredb.php');
$output = "<div>No Result found.</div>";
if(isset($_POST['search']) && !empty($_POST['search'])){
	$searchq = trim($_POST['search']);
	//$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	$dbname = "df8k1m58fmo0qg";
	$host = "ec2-54-83-36-176.compute-1.amazonaws.com";
	$port = 5432;
	$user = "fcjoasuytuksub";
	$password = "w4xmCijZpUq1EEmpY00RiFyjeH";
	$persistent = 0;
	$dbdrv=new PostgreDB ($dbname, $host, $port, $user, $password, $persistent);
	$dbdrv->Begin();
	$sql= "SELECT * FROM company Where LOWER(First_Name) LIKE LOWER('%$searchq%') OR LOWER(Last_Name) LIKE LOWER('%$searchq%')";
	if (!$dbdrv->ExecQuery($sql)){
	    die ($dbdrv->Error());
	}
	
}
?>

<form action="index.php" method="post">
	<input type="text" name="search" placeholder="Search for members" />
	<input type="submit" value="Search" /> 
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