<?php
include "config.php";
include "global.php";
function register()
{
	$userpost = $_POST["username"];
	$passpost = $_POST["password"];
	$fnamepost = $_POST["fname"];
	$lnamepost = $_POST["lname"];
	$login = mysql_fetch_assoc(mysql_query("SELECT max(id) as id from openkb.users"));
	$iddb = $login["id"] + 1;
	
	if(strlen($userpost) > 1 and strlen($passpost) > 1 and strlen($fnamepost) > 1 and strlen($lnamepost) > 1)
	{
		$result = mysql_query("SELECT username FROM users WHERE username = '" . $userpost . "'");
			 if(mysql_num_rows($result) == 0) 
			 {
			mysql_query("INSERT INTO users (username, password, id, fname, lname, ip, webadmin) VALUES ('" . $userpost . "', '" . sha1($passpost) . "', '" . $iddb++ . "', '" . $fnamepost . "', '" . $lnamepost . "', '" . $_SERVER['REMOTE_ADDR'] . "', '0')");
		header('Location: index.php');
			 }
			 else
			 	echo "<div id = \"error\">&nbsp; &nbsp; &nbsp; &nbsp;Username is already taken</div>";
	}
}

echo mysql_error();
?>

<!DOCTYPE html>
<html>
<head>
<title>OpenKB Register</title>
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />
<style type = "text/css">
#error
{
	border-width:1px;
	border-radius:5px;
	background-color:#C30;
	color:white;
	display:inline;
	padding:10px;
	background-image:url('img/redb.png');
	background-repeat:no-repeat;
}
</style>
</head>

<body>
<div id = "wrap"> 
		<div id = "logo">OpenKB Register
		</div> 
		<div id = "content"> 
		<div id = "content_text_area"> 
    	<form action = "register.php" method = "post">
        <?php register() ?>
        	<br />
        	<br />
            First Name
                <br />
            <input type = "text" name = "fname" />
                <br />
            Last Name
                <br />
            <input type = "text" name = "lname"/>
                <br />
		Username
		<br />
            <input type = "text" name = "username" />
		
		<br />
		Password
		<br />
			<input type = "password" name = "password"/>
		
		<br />
		<input type = "submit" value = "Register" />
	    	</form>
     </div>
	</div>   
</body>
</html>






