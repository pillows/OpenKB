<?php 
include "config.php";
include "global.php";
$question = $_POST["question"];
    $title = $_POST["title"];
?>

<!DOCTYPE html>
<html>
<head>

<title>Untitled Document</title>
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />

</head>

<body>
<?php 


    if(strlen($title) > 5 and strlen($question) > 10)
    {
    	$dbh->prepare("INSERT INTO questions (id, questions, answers, title, author, admina, section, allowusercomment) VALUES (NULL, :question, NULL, :title, NULL, NULL, :aSelect, ' 1 ')";
    	$dbh->bindParams(":question",$question);
    	$dbh->bindParam(":title",$title);
    	$dbh->bindParam(":aSelect",$aSelect);
    	$dbh->execute();
    }
	if(strlen($title) < 5 and strlen($question) < 10 and $title != "" and $question != "")
    	echo "Either your title or question is not specific enough";
function repeatSections()
{
$myquery = "SELECT id as id, title from sections group by id order by id desc";

$result = mysql_query($myquery);

	while ($ar = mysql_fetch_assoc($result)) 
	{
		echo "<option value = '" . $ar["id"] . "'>" . $ar["title"] . "</option>";
	}
}	
	echo "<div id  = \"wrap\">\n"; 
		echo "	<div id = \"logo\"><a href = \"index.php\">OpenKB</a> Create Question</div>\n"; 
		echo "    	<div id = \"content\">\n"; 
		echo "        	<div id = \"content_text_area\">\n"; 
		echo "                <div id = \"submit\">\n"; 
		echo "                    <form method = \"post\" action = \"create.php\" />\n"; 
		echo "                        <label>Title</label>\n"; 
		echo "                            <br />\n"; 
		echo "                        <input type = \"text\" name = \"title\"/>\n"; 
		echo "                            <br />\n"; 
		echo "                        <div>Choose the section that best fits your question:</div>\n"; 
		echo "                            <br />\n"; 
		echo "                        <select name = \"options\">\n"; 
		echo repeatSections();
		echo "                        </select>\n"; 
		echo "                            <br />\n"; 
		echo "                        <label>Question</label>\n"; 
		echo "                            <br />\n"; 
		echo "                        <textarea name  = \"question\" cols = \"30\" rows = \"10\"></textarea>\n"; 
		echo "                            <br />\n"; 
		echo "                        <input type = \"submit\" />\n"; 
		echo "                    </form>\n"; 
		echo "            	</div>\n"; 
		echo "            </div>\n"; 
		echo "		</div>\n"; 
		echo "</div>\n";

?>
</div>

</body>
</html>
