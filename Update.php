<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "companies";

$conn = new mysqli($servername, $username, $password, $dbname);

	
	if(isset($_POST) && !empty($_POST['newName']))
	{
		$newName = $_POST['newName'];
		$ID 	 = $_POST['ID'];
		$sql  	 = "UPDATE company_names SET Name='$newName' WHERE ID='$ID'";
		$res 	 = mysqli_query($conn,$sql) or die("Could Not Update".mysqli_error());
		echo "<meta http-equiv='refresh' content='0;url=Searching.php'>";
		exit;
	}
	
	if(isset($_GET['ID']))
	{
		$id = $_GET['ID'];
		$query = "SELECT * FROM company_names WHERE ID='$id'";
		$result = $conn->query($query);
		//$res = mysqli_query($conn,"SELECT * FROM company_names WHERE ID='$id'");
		//$row = mysqli_fetch_array($res);
		$row = $result->fetch_array();
	}
	if(isset($_GET) && empty($_GET['ID']))
	{
		echo "<meta http-equiv='refresh' content='0;url=Searching.php'>";
		exit;
	}
?>
<form action="Update.php" method="POST">
Name: <input type="text" name="newName" value="<?php echo $row["Name"];?>"><br />
<input type="hidden" name="ID" value="<?php echo $row["ID"];?>"><br />
<input type="Submit" value="Update">
</form>