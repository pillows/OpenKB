<?php

include "config.php";
include "global.php";


$login = mysql_fetch_assoc(mysql_query("SELECT username, password from users where username = '" . $username . "' and password = '" . sha1($password) . "'"));
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<title> OpenKB Home </title>
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />
</head>

<body>
<?php 

function listSections()
{
$myquery = "SELECT id as id, title from sections group by id order by id desc";


$result = mysql_query($myquery);

	while ($ar = mysql_fetch_assoc($result)) 
	{
		$articlevalue = mysql_fetch_assoc(mysql_query("SELECT COUNT(section) as c from questions where section = '" . $ar["id"] . "'"));
		echo "<div class='category_box'><a href='sections.php?id=" . $ar["id"] . "'>" . $ar["title"] . "</a> (" . $articlevalue["c"] . " Articles)</div>\n";
	}
}

$webadmin = mysql_fetch_assoc(mysql_query("SELECT username, webadmin from users where username = '" . $_SESSION["username"] . "'"));
	if($action == "" || $_SESSION["is_logged_in"] == "")
	{
		echo "<div id = \"border\">\n"; 
		echo $logine;
		echo "        <form action = \"index.php\" method = \"post\">\n"; 
		echo "            <label>Username:\n"; 
		echo "                <br />\n"; 
		echo "            <input type = \"text\" name = \"username\"/></label>\n"; 
		echo "                <br />\n"; 
		echo "            <label>Password:\n"; 
		echo "                <br />\n"; 
		echo "            <input type = \"password\" name = \"password\"/></label>\n"; 
		echo "                <br />\n"; 
		echo "            <input type = \"submit\" value = \"Login\" />\n"; 
		echo "                <input type = \"button\" value = \"Register\" onclick = \"window.location.href='register.php'\"/>\n"; 
		echo "        </form>\n"; 
		echo "\n"; 
		echo "        </div>\n"; 
		if($_SESSION["is_logged_in"] == 1)
		{
			header("Location:index.php?a=questions");
		}
	}
	
	if($username == $login["username"] and sha1($password) == $login["password"]) 
		header("Location: index.php?a=questions");

	if($action == "questions")
	{
		echo "<div id = \"wrap\">\n"; 
		echo "            <div id = \"logo\"><a href = \"index.php\">OpenKB</a> Home\n"; 
		echo "            </div>\n"; 
		echo "        <div id = \"content\">\n"; 
		echo "        	<div id = \"content_text_area\">\n"; 
		echo listSections();
		echo "        	</div>\n"; 
		echo "<a href = \"create.php\">" . "Click here to create a question" . "</a>";
		if($webadmin["webadmin"] == 1)
		{
			echo "<br />";
			echo "<a href = \"admin.php\">" . "Admin Panel" . "</a>";
			
		}
		echo "        </div>\n"; 
		echo "Logged in as: \n" . $_SESSION["username"];
		echo "<br />";
		echo "<a href = \"index.php?a=logout\">" . "Click here to logout." . "</a>";
		echo "    </div>\n";
	}
	
	if($action == "logout")
	{
		
		session_destroy();
		header("Location: index.php");
	}	
	
	
?>
</body>
</html>


