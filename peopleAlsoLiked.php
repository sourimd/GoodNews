<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<div id="header_container">
    <div id="header">
       <?php
       		if (isset($_SESSION['sessionVarUserID'])) {
       			//echo "Good news App ";
       			//echo "<img style=\"position:absolute; TOP:30px; LEFT:185px;\" src=\"logo.png\" alt=\"Good News App\" height=\"42\" width=\"242\">"; 
       			echo "<a style=\"position:absolute; TOP:30px; LEFT:185px;\" href=\"index2.php\"><img src=\"logo.png\" height=\"42\" width=\"242\"/></a>";
       			//echo "<input type=\"button\" value=\"friends\" onclick=\"window.location='login.html'\"/>";
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:735px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"findFriends.php\">Friends</a>"; 
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:635px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"userHomePage.php\">Your Page</a>"; 
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:815px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"logout.php\">Log Out</a>"; 
       			
       			//echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";
       			//echo "<input type=\"button\" value=\"your page\" onclick=\"window.location='logout.php'\"/>";

       			
       		} else {
       			//echo "Good news App ";
       			//echo "<img style=\"position:absolute; TOP:30px; LEFT:185px;\" src=\"logo.png\" alt=\"Good News App\" height=\"42\" width=\"242\">";
       			echo "<a style=\"position:absolute; TOP:30px; LEFT:185px;\" href=\"index2.php\"><img src=\"logo.png\" height=\"42\" width=\"242\"/></a>";
       			//echo "<input type=\"button\" value=\"sign in/create\" onclick=\"window.location='login.html'\"/>";
       			echo "<a style=\"position:absolute; TOP:25px; LEFT:775px;font: 18px HelveticaNeue-Light;text-decoration: none;\"href=\"login.html\">Sign In/Create</a>"; 
       		}
       ?>

    </div>
</div>

<div id="container">

<div id="content">
<?php

//echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";
//$var = unserialize(urldecode($_GET['url']);

//$_REQUEST['type']

$articles = $_SESSION['LikeArticles'];



echo "<div>";

echo "<div>";
	echo "People who liked " . $_SESSION['peopleLike'] . " also liked</br>";
echo "</div>";
foreach ($articles as $article) {
	$index = str_replace(" ", "", $article['title']);
	if (!isset($alreadyIn[$index])) {
		/**$alreadyIn[$index] = 1;
		//echo "TITLE : " . $article['title'] . "</br>"; 
		//$temp = str_replace(array('\'', '"'), "", $article['title']);
		$temp = str_replace(array('\'', "\"", "&"), "", $article['title']);
		$link = "<a href='";
		$link .= "headline2.php?type=" . $_REQUEST['type'] ."&title=" . $temp . "'>";
		$link .=  $article['title'] . "</a></br>"; 
		echo $link;
		echo "LINK : " . $article['link'] . "</br>";
		echo "IMAGE : " . $article['image'] . "</br>";
		echo "SITE_TITLE : ". $article['site_title'] . "</br>";
		echo "STORY : " . $article['story'] . "</br>";		
		echo "TAGS : " . $article['tags'] . "</br></br>";**/
		
		
		echo "<div class=\"wrapper\">";
						echo "<header class=\"DivHeader\">";
							$alreadyIn[$index] = 1;
							$temp = str_replace(array('\'', "\"", "&"), "", $article['title']);
							$link = "<h3><a style=\"text-decoration: none;font:21px HelveticaNeue-Light;font:21px HelveticaNeue-Light;color:#3333CC;\" href='";
							$link .= "headline2.php?type=" . $_SESSION['peopleType'] . "&title=" . $temp . "'>";
							$link .=  $article['title'] . "</a></h3>"; 
							//echo "</br></br>headline.php?type=top&title=" . $temp . "</br></br>";
							echo $link;
						echo "</header>";
						
						echo "<div class=\"middle\">";
							echo "<div class=\"container\">";
								echo "<div class=\"hello\">";
									echo $article['story'] . "</br>";
								echo "</div>";
							echo "</div>";
							
							$img = $article['image'];
							if ($article['image'] == NULL) {
								$img = "MakerWare.jpg";
							} 
							
							
							echo "<aside class=\"left-sidebar\" style=\"background-image: url(" . $img . ");background-repeat:no-repeat;vertical-align:top;background-size:cover;\">";
								/**$img = "<img width=\"225\" height=\"80\" style=\"margin: 0 auto;\" src='";
								if ($article['image'] == NULL) {
									$img .= "MakerWare.jpg'/></br>";
								} else {
									$img .= $article['image'] . "'/></br>";
								}**/
								//echo $img;
								//echo "IMAGE : " . $article['image'] . "</br>";
								
							echo "</aside>";
						echo "</div>";
						echo "<footer class=\"DivFooter\">";
							echo "News Source: ". $article['site_title'] . "</br>";
						echo "</footer>";
					echo "</div>";
		
		
	}			
}
echo "</div>";
?>

</div>
</div>

</body>
</html>







