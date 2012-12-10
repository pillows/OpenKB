<?php
error_reporting(0);
$url = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $url);
$file = $break[count($break) - 1];
$action = $_GET["a"];
$username = $_POST["username"];
$password = $_POST["password"];
$question = $_POST["question"];
$title = $_POST["title"];
$guserq = mysql_fetch_assoc(mysql_query("SELECT max(id) as id from questions"));
$cid = $guserq["id"] + 1;
$pageName = basename($_SERVER[PHP_SELF]);
$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$urlArray = parse_url($url);

$currentURL = $urlArray["path"] . "?" . $urlArray["query"];

$banq = mysql_fetch_assoc(mysql_query("SELECT ip, reason from bans where ip = '" . $_SERVER['REMOTE_ADDR'] . "'"));

if($banq["ip"] == $_SERVER['REMOTE_ADDR'])
	header("Location: banned.php");

$currentURI = $urlArray["path"];
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
    	$result = mysql_query("SELECT * FROM users WHERE username = '" . $username . "' AND password = sha1('" . $password . "')");
			 if(mysql_num_rows($result) == 1) 
			 {
				 session_start();
				 $_SESSION["is_logged_in"] = 1;
				 $_SESSION["username"] = $username;
			 }
			 else
				$logine = "Either the username or password is wrong";
	}
	
	if($currentURL == "sections.php?" and $username == "") 
	{
		 header("Location:index.php");
		 die();  
	}
	
	/*if(empty($_SESSION["is_logged_in"]) and $currentURL == "/sections.php?" . $urlArray["query"] .  "") 
	{
		 header("Location:index.php");
		 die();  
	}*/
	
	
	if($guserq["id"] == "")
    	$cid = "0";
		

	if(strlen($title) < 5 and strlen($question) < 10 and $title != "" and $question != "")
		echo "Either your title or question is not specific enough";
	
	#$wordList = file("badwords.txt", FILE_SKIP_EMPTY_LINES)
?>