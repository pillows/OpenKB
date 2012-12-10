<?php

include "config.php";
include "global.php";

function listQuestions()
{
	$id = $_GET["id"];
$myquery = "SELECT questions, section, id from questions where section = " . $id . " order by section desc";

$result = mysql_query($myquery);

	while ($ar = mysql_fetch_assoc($result)) 
	{
		echo "<div class='category_box'><a href='questions.php?id=" . $ar["id"] . "'>" . htmlentities($ar["questions"]) . "</a></div>\n";
	}
	
	echo mysql_fetch_row($result);
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />
</head>

<body>
<div id = "wrap"> 
		<div id = "logo"><a href = "index.php">OpenKB</a> Sections
		</div> 
			<div id = "content"> 
				<div id = "content_text_area"> 
		        <?php echo listQuestions(); ?>
				</div> 
			</div> 
		</div>
</body>
</html>