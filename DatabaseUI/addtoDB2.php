<?php
   include("addToDBConfig.php");
   session_start();
   $error = " ";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // check for Numerical values & TypeCasts values to INT
	  $stockInt = (is_numeric($_POST['Stock']) ? (int)$_POST['Stock'] : 0);
	  $importedInt = (is_numeric($_POST['Imported']) ? (int)$_POST['Imported'] : 0);
	  $burnedInt = (is_numeric($_POST['Burned']) ? (int)$_POST['Burned'] : 0);
	  
	  //Sets Values
      $sortCode = mysqli_real_escape_string($db,$_POST['sortCode']);//SortCode is left as String
      $stock = mysqli_real_escape_string($db,$_POST['Stock']);
	  $imported = mysqli_real_escape_string($db,$_POST['Imported']); 
	  $burned = mysqli_real_escape_string($db,$_POST['Burned']); 
	  
	  $sql = "INSERT INTO `stock`(`sortcode`, `stock`, `imported`, `burned`) VALUES (\"".strtoupper($sortCode)."\", '$stock', '$imported', '$burned')";

	  $result = mysqli_query($db,$sql);

      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($result == 1) {
         header("location: SearchSQLwithPHP.php");
      }else {
         $error = "An Error Occured, Check your entries";
      }
   }
?>
<html>
   
   <head>
      <title>Add To Database Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Sign Up</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Sort Code  :</label><input type = "text" name = "sortCode" class = "box"/><br /><br />
                  <label>Stock  :</label><input type = "text" name = "Stock" class = "box" /><br/><br />
				  <label>Imported  :</label><input type = "text" name = "Imported" class = "box"/><br /><br />
                  <label>Burned  :</label><input type = "text" name = "Burned" class = "box" /><br/><br />
                  <input type = "submit" value = " Add Data"/><br /><?php echo $error ?><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>