 <?php
 if( $user == "" || $pass == "")
    {
        echo '<div id ="errormsg">Please fill in all fields</div>';
    }

    else 
    {
        $query = mysqli_query($dbcon, "SELECT * FROM users WHERE username = '$user'
        and password = '$pass' and admin = '$admin' ") or die ("Can't query the database");
        $count = mysqli_num_rows($query);

        if($count == 1) 
        {
            if ($admin == 1)
            {
                $_SESSION['username'] = $user;
                header("location: admin.php");
            }
            else if ($admin == 0)
            {
                $_SESSION['username'] = $user;
                header("location: users.php");
            }
            else
            {
                echo '<div id="errormsg">No matches, try again</div>';
            }
        }
    }
}
?>