<?php
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$db_database = 'coalyard';

// Database Connection String
global $con;
$con = mysql_connect($db_hostname,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_database, $con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<title></title>
		
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
			padding: 10px;
			background: url(img/bg.jpg) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			}
         
         label {
            font-weight:bold;
            width:100px;
            font-size:16px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
		 .myTable { 
		  width: 50%;
		  text-align: center;
		  background-color: lightgrey;
		  border-collapse: collapse; 
		  }
		.myTable th { 
		  background-color: grey;
		  color: white; 
		  }
		.myTable td, 
		.myTable th { 
		  padding: 10px;
		  border: 1px solid black; 
		  }
		  
		.searchBar {
		 height: 80px;
		 width: 100px;
		}
      </style>
	  <link href="css/bootstrap.css" rel="stylesheet"> 
	  <form action="" method="post"> 
		<h2>Enter Sort Code You Want To Find</h2>
		Search: <input type="text" class="searchBar" name="term" /><br />  
		<input type="submit" value="Search" />  
		<a href = "logout.php">Sign Out</a>
	</form>
	<hr><br />
	<script>
		function myFunction() {
			alert("No Results Found!");
			window.location = "searchPage.php";
		}
	</script>
	  
</head>
<body>
	
<?php
include('session.php');
if (!empty($_REQUEST['term'])) {
	$term = mysql_real_escape_string($_REQUEST['term']);     
	$sql = "SELECT * FROM `stock` WHERE `sortcode` = \"".$term."\"";
	$tableHeader = "<center><table class=\"myTable myTable-hover\"><tr><th>Stock</th><th>Imported</th><th>Burned</th></tr>";	
	$r_query = mysql_query($sql); 

	//To Table Details
	if(mysql_num_rows($r_query) > 0){
		//prints StackerReclaimer_StatusTable;
		include("SR_TableStatus.php");
		// starts the Table HTML
		echo $tableHeader;
		//was in a while loop, but ince there should only be one entry it was causing errors, if more than one was there
		$row = mysql_fetch_array($r_query);	
		echo "<center>";
		echo '<h2>All Details for Sort key: <mark>' .$row['sortcode']."</mark></h2>";  
		echo "<tr><td >".$row["stock"]."</td><td>".$row["imported"]."</td><td>".$row["burned"]."</td></tr>";
			
		echo "</table><h1> <a href= searchPage.php>Back</a></h1></center>";		
	}else 
		echo" <script>myFunction()</script>";
} 
else {
	include("InfoPage.php");
}

?>
    </body>
</html>