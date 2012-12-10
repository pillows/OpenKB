<?php
$username = "";
$password = "";
$conn = new PDO('mysql:host=localhost;dbname=openkb', $username, $password);
if(!$conn)
{
	die("<div style = 'color:red;font-size:100px;'>Sorry but database details are incorrect</div>");
}

?>
