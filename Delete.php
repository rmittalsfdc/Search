<?php include('postgredb.php');
$dbname = "df8k1m58fmo0qg";
	$host = "ec2-54-83-36-176.compute-1.amazonaws.com";
	$port = 5432;
	$user = "fcjoasuytuksub";
	$password = "w4xmCijZpUq1EEmpY00RiFyjeH";
	$persistent = 0;
	$conn=new PostgreDB ($dbname, $host, $port, $user, $password, $persistent);
	$conn->Begin();

	
	if(isset($_POST) && !empty($_POST['Name']))
	{
		$Name = $_POST['Name'];
		$ID 	 = $_POST['ID'];
		$sql  	 = "DELETE FROM company_names WHERE ID='$ID'";
		$res 	 = pg_query($conn,$sql) or die("Could Not Update");
		echo "<meta http-equiv='refresh' content='0;url=Searching.php'>";
		exit;
	}
	
	if(isset($_GET['ID']))
	{
		$id = $_GET['ID'];
		$query = "SELECT * FROM company_names WHERE ID='$id'";
		$result = pg_query($conn,$query);
		//$res = mysqli_query($conn,"SELECT * FROM company_names WHERE ID='$id'");
		//$row = mysqli_fetch_array($res);
		$row = pg_fetch_array($result);
	}
	if(isset($_GET) && empty($_GET['ID']))
	{
		echo "<meta http-equiv='refresh' content='0;url=Searching.php'>";
		exit;
	}
?>
<form action="Delete.php" method="POST">
Name: <input type="text" name="Name" value="<?php echo $row["Name"];?>"><br />
<input type="hidden" name="ID" value="<?php echo $row["ID"];?>"><br />
<input type="Submit" value="Delete">
</form>