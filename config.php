<?php
$sqluser = "root";
$sqlpass = "xoxolacy";
$sqldb = "openkb";
$sqlserver = "localhost";

$openkb_connect = mysql_connect($sqlserver, $sqluser, $sqlpass);


if(!$openkb_connect)
{
	die("<div style = 'color:red;font-size:100px;'>Sorry but database details are incorrect</div>");
}
mysql_select_db($sqldb) or die(mysql_error());

?>
