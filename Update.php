<?php include('postgredb.php');

$conn = pg_connect("host=ec2-54-83-36-176.compute-1.amazonaws.com port=5432 dbname=df8k1m58fmo0qg user=fcjoasuytuksub password=w4xmCijZpUq1EEmpY00RiFyjeH");

	if(isset($_POST) && !empty($_POST['newName']))
	{
		$newName = $_POST['newName'];
		$ID 	 = $_POST['ID'];
		$sql  	 = "UPDATE company_names SET name='$newName' WHERE id='$ID'";
		$res 	 = pg_query($sql) or die("Could Not Update");
		echo "<meta http-equiv='refresh' content='0;url=Searching.php'>";
		exit;
	}
	
	if(isset($_GET) && !empty($_GET['ID']))
	{
		$id = $_GET['ID'];
		$query = "SELECT * FROM company_names WHERE id='$id'";
		$result = pg_query($query);
		$row = pg_fetch_array($result);
	}
	if(isset($_GET) && empty($_GET['ID']))
	{
		echo "<meta http-equiv='refresh' content='0;url=Searching.php'>";
		exit;
	}
?>
<form action="Update.php" method="POST">
Name: <input type="text" name="newName" value="<?php echo $row["name"];?>"><br />
<input type="hidden" name="ID" value="<?php echo $row["id"];?>"><br />
<input type="Submit" value="Update">
</form>