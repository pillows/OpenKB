<?php 

include "config.php";
include "global.php";
$id = mysql_real_escape_string($_GET["id"]);
$comment = $_POST["comment"];
session_start();
$questions = mysql_fetch_assoc(mysql_query("SELECT questions,title from questions where id = '" . $id . "'"));
$questionhtml = htmlentities($questions["questions"]);
$titlehtml = htmlentities($questions["title"]);
$maxidq = mysql_fetch_assoc(mysql_query("SELECT max(id) as id from questions"));

if($maxidq = "")
	$qid = 1;
$qid = $maxidq["id"] + 1;

if(strlen($comment) > 1)
	mysql_query("INSERT INTO comments (id, cid, comment, username) VALUES ('" . $qid++ . "', '" . $id . "', '" . $comment . "', '" . $_SESSION["username"] . "')");
	
$countq = mysql_fetch_assoc(mysql_query("SELECT COUNT(cid) as cid from comments where cid = '" . $_GET["id"] . "'"));
function repeatComments()
{
	global $id;
	$commentsql = mysql_query("SELECT cid, comment, username from comments where cid = " . mysql_real_escape_string($id) ." order by cid desc");
	while ($ar = mysql_fetch_assoc($commentsql)) 
	{
		echo "<div class=\"article\"><strong style=\"border-bottom:1px dotted;\">" . htmlentities($ar["username"]) . "</strong>\n"; 
		echo "                    	<div style=\"padding:3px;\">\n"; 
		echo "                        </div>\n"; 
		echo htmlentities($ar["comment"]);
		echo "                    </div>\n";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />
</head>

<body>
<div id  = "wrap">
	<div id = "logo"><a href = "index.php">OpenKB</a></div>
    	<div id = "content">
        	<div id = "content_text_area">
            	<div class="title"><?php echo $titlehtml; ?></div>
                	<div class="article" style="padding:10px;">
                    	<?php echo $questionhtml; ?>
                    </div>
                    
                    <div class="title" style="margin-top:10px; margin-bottom:0px;">
                    	Comments (<?php echo $countq["cid"]; ?>)
                    </div>
                    
                    <?php repeatComments(); ?>
                   	
                    <div class="box">
                    	<form action="<?php echo "questions.php?id=" . mysql_real_escape_string($_GET["id"]) ?>" method="post">
                            	<br /><br />Your Comment<br />
                            <textarea name="comment" cols="50" rows="5" maxlength="250" style="resize:none;"></textarea>
                            <br /><br />
                            <input type="submit" value="Submit Comment">
                       </form>
                   </div>
            	</div>
            </div>
             <?php echo "Logged in as: \n" . htmlentities($_SESSION["username"]);
		echo "<br />";
		echo "<a href = \"index.php?a=logout\">" . "Click here to logout." . "</a>"; ?>
		</div>
	</div>
</div>
</body>

<!--<body style = "background-image:url("img/bg.png");background-repeat:repeat-x;">
	<div style = "border-style:solid;border-radius:10px;border-width:1px;background-color:whitewidth: 300px;
   height: 300px;
   position: absolute;
   left: 50%;
   top: 50%;
   margin-left: -150px;
   margin-top: -150px;">
		Question by: root
			<br />
			<br />
		<div style = "border-style:none;border-width:1px;border-radius:2px;font-size:14px;margin-bottom:5px;font-weight:bold;border-bottom:1px dotted #D8D8D8;">
		Question: Style
			<br />
			<br />
		Comments (x):
		<fieldset length = "5">
		<div style = "border-width:1px;border-style:solid;">
		Posted By Root:
			<br />
		Test Comment
		</div>
			<br />
		<div style = "border-width:1px;border-style:solid;">
		Posted By Root:
			<br />
		Test Comment
		</div>
		</fieldset>
			<br />
			<fieldset length = "5">
			<form method = "post" action = "<?php #echo "questions.php?id=" . $_GET["id"] ?>">
				Logged in as <?php #echo "root"; ?>
					<br />
				Comments:
					<br />
				<textarea name = "comments"></textarea>
			</form>
			</fieldset>
		</div>
	</div>
</body>-->

</html>
