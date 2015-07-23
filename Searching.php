<?php include('postgredb.php');

$conn = pg_connect("host=ec2-54-83-36-176.compute-1.amazonaws.com port=5432 dbname=df8k1m58fmo0qg user=fcjoasuytuksub password=w4xmCijZpUq1EEmpY00RiFyjeH");
	
	if(isset($_POST['name']))
	{
		$name = $_POST['name'];
		//$search_query = mysqli_query($conn,"SELECT * FROM company WHERE Name = '$name'");
		$search_query = "SELECT * FROM company_names WHERE name = '$name'";
		$searchresult = pg_query($search_query);
		$v = pg_num_rows($searchresult);
		if($v > 0)
		{
			echo "<b><span style='color:#FF0000;text-align:center;'>Record already exists. Please enter the different name</span></b>";
		}else{
			$insert_query = pg_query("INSERT INTO company_names (name) 
									VALUES ('$name')");
			echo "<b><span style='color:#009933;text-align:center;'>Record inserted Successfully</span></b>";	
		}
	}
	$sql = "SELECT * FROM company_names ORDER BY id ASC";
	$result = pg_query($sql);
	/*
	switch (isset($_POST['test1'])) 
	{
			case 'Insert':
					$insert_query = pg_query("INSERT INTO company_names (name) 
									VALUES ('$name')");
					break;
	}*/
		
?>

<form action="Searching.php" method="POST">
<h3 style="color:6600FF">Company Name:</h3> <input type="text" name="name" placeholder="Enter company name">
<input type="Submit" name="test1" value="Insert" style="background-color:#00CC33; color:#000000;">
</form>

<h1 style="color:663300"> List of Companies... </h1>

<table border=1 style="width:50%" BORDERCOLOR=CC9966>
	<tr>
		<th bgcolor='orange'>ID</th>
		<th bgcolor='orange'>Company Name</th>
		<th bgcolor='orange'>Action</th>
			
	</tr>
	
	<?php	
	//while($row = $result->fetch_array())
		//echo "count of companies: "
		for ($row=0; $row = pg_fetch_assoc($result); $row++)
		{
		//echo " ".$row["ID"]." " .$row["Name"]." <br />";
	?>
	
	<tr>
		<td align="center" ><?php echo $row["id"]?></td>
		<td align="center"><?php echo $row["name"]?></td> 
		<td align="center" ><a href="Update.php?ID=<?php echo $row["id"]?>"><FONT COLOR="#339900">Edit</FONT> / <a href="Delete.php?ID=<?php echo $row["id"]?>" ><FONT COLOR="#CC3333 ">Delete</FONT></a></a></td>
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
