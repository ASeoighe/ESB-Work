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
<html lang="en">
<style type = "text/css">
		body {
		font-family:Arial, Helvetica, sans-serif;
		font-size:16px;
		padding: 10px;
		background: url(img/bg.jpg) no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}
		.myTable { 
		width: 55%;
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
		
		td:hover.t-hover{
		  background-color: #c6c6c6;
		   border-style:dotted;
		   border-color:white;
		   border-left-style:dotted;
		   border-right-style:dotted;
		}	
	</style>
<head class="titleBox">
<title></title>
	
		 
			<!-- <h2>Enter Sort Code You Want To Find</h2> -->
<!---------->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <form class="navbar-form navbar-left" action="" method="post">
        <div class="form-group">
			<img src="img/esb.jpg" width="65" height="40"  hspace="5"><!-- Just an image -->
          <input id="searchBox" class="form-control" type="text" name="term" placeholder="Enter Sort Code" />
        </div>
        <input id="searchButton" class="btn btn-default" type="submit" value="Search" />
      
	<div class="navbar-form btn-group dropdown">
    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Admin Options
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="signup.php">Add New User</a></li>
      <li><a href="addToDatabase.php">Add to DataBase</a></li>
    </ul>
	</div>
	 </form> 
      <ul class="navbar-form nav navbar-nav navbar-right">
        <li><a class = "btn btn-default" href = "logout.php">Log Out</a></li>
      </ul>
    
  </div><!-- /.container-fluid -->
</nav>
<!----------->
	<script>
		function myFunction() {
			alert("No Results Found!");
			window.location = "adminSearch.php";
		}

	</script>
	  
</head>
<body>
	
<?php
include('adminSession.php');
if (!empty($_REQUEST['term'])) {
	$term = mysql_real_escape_string($_REQUEST['term']);     
	$sql = "SELECT * FROM `stock` WHERE `sortcode` = \"".$term."\"";
	$tableHeader = "<center><table id=\"tableId\" class=\"myTable\"><tr><th>Stock</th><th>Imported</th><th>Burned</th></tr>";	
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
		
		echo "</table><h1><a class=\"btn btn-default\" href= adminSearch.php>Back</a></h1></center>";	
		
	}else 
		echo" <script>myFunction()</script>";
} 
else {
	include("InfoPage.php");
}

?>
<script>
function focusFunction() {
    // Focus = Changes the background color of input to yellow
    document.getElementById("searchBox").style.background = "#f5f0f0";
	document.getElementById("searchBox").value = "";
}

function blurFunction() {
    // No focus = Changes the background color of input to red
	document.getElementById("searchBox").style.background = "white";
    document.getElementById("searchBox").value = "Enter Sort Code:";
}
</script>

    </body>
</html>