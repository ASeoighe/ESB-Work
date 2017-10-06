<?php
   include("config.php");
   session_start();
   $error = " ";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $uname = mysqli_real_escape_string($db,$_POST['username']);
      $pass = mysqli_real_escape_string($db,$_POST['password']);
	  $admin = mysqli_real_escape_string($db,$_POST['admin']);

	  $pass = md5($pass);
      
	  if(empty($uname) || empty($pass))
		  $result = 0;
	  else if(!empty($uname) || !empty($pass)){
		  $sql = "INSERT INTO `users`(`admin`, `username`, `passcode`) VALUES ('$admin', '$uname','$pass')";
		  $result = mysqli_query($db,$sql);
	  }
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($result == 1) {
         header("location: splashScreen.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>New User Page</title>
      
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


				<form action = "" method = "post" name  ="Form">
				  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
				  <input style="align:center" type = "submit" value = " Add User "/><br /><br />
				  <strong>Admin </strong><input style="align:center" class="cb" name="admin" type="checkbox" id="adminCB" value = 'y' onchange="cbChange(this)"/><a> | </a>
				  <strong>Regular User </strong><input style="align:center" class="cb"  name="admin" type="checkbox" id="userCB" value = ' ' onchange="cbChange(this)" checked/>
				</form>
			     <script type="text/javascript">
					function cbChange(obj) {
						var cbs = document.getElementsByClassName("cb");
						for (var i = 0; i < cbs.length; i++) {
							cbs[i].checked = false;
						}
						obj.checked = true;
					}
					function validateForm()
					{
					  var name=document.forms["Form"]["username"].value;
					  var pass=document.forms["Form"]["password"].value;

					  if (name==null || name=="",pass==null || pass=="")
					  {
						alert("Please Fill All Required Field");
						return false;
					  }
					}
					document.getElementById("error").innerHTML = validateForm();
				</script>
               
               <div style = "font-size:20px; color:#cc0000; margin-top:20"></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>