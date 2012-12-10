
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />

<script type = "text/javascript">
</script>

<style type = "text/css">
fieldset
{
	dislay:block;
}
</style>
</head>

<body>
	<?php
include "config.php";
include "global.php";
session_start();
$title = $_POST["title"];
$description = $_POST["description"];

$reason = $_POST["reason"];
$ip = $_POST["ip"];

	if(isset($_POST["reason"]))
	{
		$conn -> prepare("INSERT INTO bans (id, ip, reason) VALUES (NULL, :ip, :reason)");
		$conn -> bindParam(':ip', $ip);
		$conn -> bindParam(':reason', $reason);
		$conn -> execute();
	}

	if(strlen($title) > 5 and strlen($description) > 10)
	{
		$conn -> prepare("INSERT INTO sections (id, title, description) VALUES (NULL, :title, :description)");
		$conn -> bindParam(':title', $title);
		$conn -> bindParam(':description', $description);
		$conn -> execute();	
	}
	
	$webadmin = mysql_fetch_assoc(mysql_query("SELECT username, webadmin from users where username = '" . $_SESSION["username"] . "'"));
	if($webadmin["webadmin"] == 0)

	{

		echo "You're not allowed here. <a href = \"index.php\">Click here</a> to go home";
	}
	else
	{
		echo "<div id  = \"wrap\">\n"; 
		echo "	<div id = \"logo\"><a href = \"index.php\">OpenKB</a> Admin Panel</div>\n"; 
		echo "    	<div id = \"content\">\n"; 
		echo "        	<div id = \"content_text_area\">\n"; 
		echo "<fieldset length = \"1\" style = \"text-align:left;\">\n"; 
		echo "    <legend>Add Section</legend>\n"; 
		echo "        <form action = \"admin.php\" method = \"post\">\n"; 
		echo "            Section Title\n"; 
		echo "            <br />\n"; 
		echo "                <input type='text' name='title' size='30' maxlength='30' value=''>\n"; 
		echo "            <br />\n"; 
		echo "            <br />\n"; 
		echo "            Section Description\n"; 
		echo "            <br />\n"; 
		echo "                <textarea name='description' cols='50' rows='5'></textarea>\n"; 
		echo "            <br /><br />\n"; 
		echo "                <input type='submit' value='Save Category'>\n"; 
		echo "        </form>\n"; 
		echo "	</fieldset>\n"; 
		echo "<fieldset length = \"1\" style = \"text-align:left;\">\n"; 
		echo "    <legend>Manage Bans</legend>\n"; 
		echo "        <form action = \"admin.php\" method = \"post\">\n"; 
		echo "        	IP Address: \n"; 
		echo "            	<br />	\n"; 
		echo "                <br />\n"; 
		echo "            <input type = \"text\" name = \"ip\" />\n"; 
		echo "            	<br />\n"; 
		echo "            Reason:	\n"; 
		echo "            	<br />\n"; 
		echo "            <textarea name = \"reason\" cols='50' rows='5'></textarea>\n"; 
		echo "            	<br />\n"; 
		echo "                <br />\n"; 
		echo "            <input type = \"submit\" value = \"Ban da skid!\" />\n"; 
		echo "        </form>\n"; 
		echo "	</fieldset>\n";
		echo "<br />";
		echo "Logged in as: \n" . $_SESSION["username"];
		echo "<br />";
		echo "<a href = \"index.php?a=logout\">" . "Click here to logout." . "</a>"; 
		echo "            </div>\n"; 
		echo "		</div>\n"; 
		echo "</div>\n";
	}
	
?>
</body>
</html>
