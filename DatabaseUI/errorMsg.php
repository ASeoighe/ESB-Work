<?php
	if(sizeof($_POST) == 0)
		$error = "Enter Values";
	else if(($_POST['username']) == null || ($_POST['password']) == null )
		$error = "Enter a Username Or Password";
	else 
		$error = " ";



?>