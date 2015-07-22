<?php include('postgredb.php');

$conn = pg_connect("host=ec2-54-83-36-176.compute-1.amazonaws.com port=5432 dbname=df8k1m58fmo0qg user=fcjoasuytuksub password=w4xmCijZpUq1EEmpY00RiFyjeH");

	if(isset($_POST['name']))
	{
		$name = $_POST['name'];
		//$search_query = mysqli_query($conn,"SELECT * FROM company WHERE Name = '$name'");
		$search_query = "SELECT * FROM company WHERE Name = '$name'";
		$result = pg_query($search_query);
		if($result)
		{
			echo "Please try again";
		}
	}
	
	switch (isset($_POST['test1'])) 
	{
			case 'Insert':
					$insert_query = pg_query("INSERT INTO company_names (Name) 
									VALUES ('$name')");
					break;
			/*case 'Delete':
					if(isset($_GET['ID']))
					{
					$id=mysqli_real_escape_string($_GET['ID']);
					mysqli_query($conn,"DELETE FROM company_names WHERE ID='$id'");
					}
					//$delete_query = mysqli_query($conn,"DELETE FROM company_names WHERE ID=$row[ID]");
					break;*/
	}
	
	$sql = "SELECT * FROM company_names";
	$result = pg_query($sql);
	//$res = mysqli_query($conn,"SELECT * FROM company_names") or die("Error: ".mysqli_error($conn));
	
?>

<form action="Searching.php" method="POST">
Company Name: <input type="text" name="name">
<input type="Submit" name="test1" value="Insert">
</form>

<h1> List of Companies... </h1>

<table border=1 style="width:50%">
	<tr>
		<th bgcolor='orange'>ID</th>
		<th bgcolor='orange'>Company Name</th>
		<th bgcolor='orange'>Action</th>
			
	</tr>
	
	<?php	
	//while($row = $result->fetch_array())
		for ($row=0; $row = pg_fetch_array($result); $row++)
		{
		//echo " ".$row["ID"]." " .$row["Name"]." <br />";
	?>
	
	<tr>
		<td align="center"><?php echo $row["ID"]?></td>
		<td align="center"><?php echo $row["Name"]?></td> 
		<td align="center"><a href="\Update.php?ID=<?php echo $row["ID"]?>">Edit / <a href="\Delete.php?ID=<?php echo $row["ID"]?>">Delete</a></a></td>
		<!--<td align="center"><input type="Submit" name="test1" value="Delete"></td>-->
		<!--<td align="center"><a href="\Delete.php?ID=<?php echo $row["ID"]?>">Delete</a></td>-->
	</tr>
		<?php
		}
		/*if(isset($_GET['ID']))
					{
					$id=mysqli_real_escape_string($_GET['ID']);
					mysqli_query($conn,"DELETE FROM company_names where ID='$id'");
					}*/
		?>
</table>
