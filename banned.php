<?php

include "config.php";
$banq = mysql_fetch_assoc(mysql_query("SELECT ip, reason from bans where ip = '" . $_SERVER['REMOTE_ADDR'] . "'"));

if($banq["ip"] == "")
	header("Location: index.php");
?>

<!DOCTYPE html>
<html>
<head>
<style type = "text/css">
div
{
	border-style:solid;
	border-radius:4px;
	border-width:2px;
	width: 500px;
	height:900px;
	display: block;
	margin-left: auto;
	margin-right: auto;
	color:white;
	background-color:black;
	background-image:url('img/trollface.png');
	font-size:20px;
}
</style>
</head>

<body>
	<?php echo "<div>You have been banned for the reason: " . mysql_real_escape_string($banq["reason"]) . "</div>"; ?>
</body>
</html>