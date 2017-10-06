<?php	

function adminCheck($db, $username, $password){
	
		//sends query to DB looking for admin column of the USER
		$sql = "SELECT admin FROM users WHERE username = '$username' and passcode = '$password'";
		//result is false if nothin is found or $sql query bounces
		$result = mysqli_query($db,$sql);
		
		/*$row turns the DB row into array[] index are DB Table column name)*/
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		/*row finds number of rows the query returns 
		(should only be one since usernames are unique)*/
		$count = mysqli_num_rows($result);
		$adminPriv = $row['admin'];//makes it easier to call
		if($count == 1) { //if there is an account found 
			return $adminPriv; //return the admin value for the account (y/null)
		}
		else //if theres no account found just cancl everything.
			die();
	}
function defineUser($db){
	if($_SERVER["REQUEST_METHOD"] == "POST") { //Checks server Return Type POST/GET
	
	/***USERNAME & PASSWORD Returned from HTML Form***/
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$mypassword = mysqli_real_escape_string($db,$_POST['password']);
		$password = md5($mypassword);//MD5 hashes Password for Encryption
		
		/**# Calls to Check Admin PRIV (y/null) retuned #**/
		$admin = adminCheck($db, $username, $password);

		if ($admin == 'y')
		{
			//This assigns a session to ADMINuser in AdminSession.php
			$_SESSION['admin_user'] = $username;//sets login session to username
			header("location: adminSearch.php"); //if user has admin set directs->admin page
			die();
		}
		else if ($row[admin] == null)
		{
			//if user doesnt have admin set directs-> regular Database Page
			$_SESSION['login_user'] = $username;//sets login session to username
			header("location: searchPage.php");
			die();
		}
		else
		{	//if anything else other than y/null received then echo an error
			echo '<div id="errormsg">Username / Password Incorrect, try again</div>';
		}
	}
}
session_start();
include("config.php"); // sets the Database to send User Queries
defineUser($db); // calls to define which user is logging in
include("index.html");// calls the HTML for UI
?>

