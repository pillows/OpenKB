<?php

include "config.php";
$banq = mysql_fetch_assoc(mysql_query("SELECT ip, reason from bans where ip = '" . $_SERVER['REMOTE_ADDR'] . "'"));

$conn->prepare("SELECT ip, reason from bans where ip = :ip");
$conn->bindParam(":ip", $_SERVER['REMOTE_ADDR']);
$conn->execute();

$banq = $conn->fetch();
if(!isset($banq["ip"]))
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
	<?php echo "<div>You have been banned for the reason: " . htmlentities($banq["reason"]) . "</div>"; ?>
</body>
</html>
