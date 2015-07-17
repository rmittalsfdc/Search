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
	if($dbdrv->NumRows() > 0){
		$output = "";
		for ($row=0; $result=$dbdrv->FetchResult($row, PGSQL_BOTH); $row++)
		{
			$output .= " ".$result["first_name"]. " ".$result["last_name"]." ".$result["age"]. " ".$result["address"]."<br/>";
		}
		
	}
	
	$dbdrv->Commit();// Commit transaction
	$dbdrv->DBClose();// Close connection with database
}
?>

<form action="index.php" method="post">
	<input type="text" name="search" placeholder="Search for members" />
	<input type="submit" value="Search" /> 
</form>
<?php echo $output; ?>
