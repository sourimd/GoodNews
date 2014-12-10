<?php session_start();
ob_start();
include_once ('userFilesParser.php');
?>

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
    <!---div id="content"--->
 		<div id="filterBy">
		    <a href="#openModal">Filter By</a>
			<div id="openModal" class="modalWindow">
		    	<div>
					
					<div class="modalHeader">
		            	<h2>Filter By</h2>
		            	<a href="#close" title="Close" class="close">X</a>
		        	</div>	         
		        	<div class="modalContent">
		            	<a href="index2.php?type=technology">Technology</a></br>
		            	<a href="index2.php?type=top">Top Stories</a></br>
		            	<a href="index2.php?type=sports">Sports</a></br>
		        	</div>		         
		        	<div class="modalFooter">
		            	<a href="#cancel" title="Cancel" class="cancel">Cancel</a>
            			<div class="clear"></div>
        			</div>
    			
    			</div>
			</div>
		</div>



<?php


$technology = array();
//$keyWordsWorld = array();
$sports = array();
$top = array();
//$keyWordsEntertainment = array();
//$keyWordsUS = array();
$alreadyIn = array();
$useUserInfro = false;
open();
//print_r ($top);
$dislikedArticles = array();

//$likedTags = getLikedTags();

//echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";

if (isset($_SESSION['sessionVarUserID'])) {
	//echo "USER SET : " . $_SESSION['sessionVarUserID'] . "</br></br></br>";
	$useUserInfo = true;	
	$dislikedArticles = $_SESSION['dislikedArticles'];
}
//$dislikedTags = getDislikedTags();
//echo "DISLIKED TAGS ARRAY</br></br>";
//print_r($dislikedTags);
//echo "</br></br>";
//echo "<div style=\"width:99%; height:365px;\">";
//echo "<div class=\"divHeaderTable\">";
//	echo "<div class=\"divHeaderRow\">";


if (isset($_REQUEST['type'])) {
	if ($_REQUEST['type'] == 'technology') {
		echo "<div>";
			echo "<h1 style=\"font: 42px Helvetica Neue;color:gray;\">Technology</h1>";
		echo "</div>";
		technologyNews();			
	}
	else if ($_REQUEST['type'] == 'top') {
		echo "<div>";
			echo "<h1 style=\"font: 42px Helvetica Neue;color:gray;\">Top Stories</h1>";
		echo "</div>";
		topNews();
	}
	else {
		echo "<div>";
			echo "<h1 style=\"font: 42px Helvetica Neue;color:gray;\">Sports</h1>";
		echo "</div>";
		sportsNews();
	}	
} else {
	//technologyNews();
	//sportsNews();
	//echo "<div id=\"headLine\">";
	echo "<div>";
		echo "<h1 style=\"font: 42px Helvetica Neue;color:gray;\">Top Stories</h1>";
	echo "</div>";
	topNews();	
}

//echo "<div>";
	//echo "<div id=\"content\">";
	
	//print_r ($dislikedTags);


function technologyNews() {
	global $technology;
	echo "<div id=\"content\">";

	foreach ($technology as $tech => $articles) {	
		//echo count($articles);
		foreach ($articles as $article) {
			$index = str_replace(" ", "", $article['title']);
				if (!isset($alreadyIn[$index])) {
					$temp = $article['title'] . " ------------ technology";
					//if (strcmp($temp, $articleTitle) != 0)  {
					if (!in_array($temp, $dislikedArticles)) {
						echo "<div class=\"wrapper\">";
						echo "<header class=\"DivHeader\">";
						$alreadyIn[$index] = 1;
						//echo "TITLE : " . $article['title'] . "</br>"; 
						$temp = str_replace(array('\'', "\"", "&"), "", $article['title']);
						$link = "<h3><a style=\"text-decoration: none;font:21px HelveticaNeue-Light;color:#3333CC;\" href='";
						$link .= "headline2.php?type=technology&title=" . $temp . "'>";
						$link .=  $article['title'] . "</a></h3>"; 
						echo $link;
						echo "</header>";
						//echo "LINK : " . $article['link'] . "</br>";
						/**echo "IMAGE : " . $article['image'] . "</br>";
						echo "SITE_TITLE : ". $article['site_title'] . "</br>";
						echo "STORY : " . $article['story'] . "</br>";		
						echo "TAGS : " . $article['tags'] . "</br></br>";**/
						
						
						echo "<div class=\"middle\">";
							echo "<div class=\"container\">";
								echo "<main class=\"hello\">";
									echo $article['story'] . "</br>";
									echo "</main>";
							echo "</div>";
							
							$img = $article['image'];
							if ($article['image'] == NULL) {
								$img = "MakerWare.jpg";
							} 
							
							
							echo "<aside class=\"left-sidebar\" style=\"background-image: url(" . $img . ");background-repeat:no-repeat;vertical-align:top;background-size:cover;\">";
							/**echo "<aside class=\"left-sidebar\">";
								$img = "<img width=\"225\" height=\"80\" style=\"margin: 0 auto;\" src='";
								if ($article['image'] == NULL) {
									$img .= "MakerWare.jpg'/></br>";
								} else {
									$img .= $article['image'] . "'/></br>";
								}
								echo $img;**/
					echo "</aside>";
						echo "</div>";
						echo "<footer class=\"DivFooter\">";
							echo "News Source: ". $article['site_title'] . "</br>";
						echo "</footer>";
					echo "</div></br></br>";
				}	
			}
		}	
	}
	echo "</div>";
}


function sportsNews() {
	global $sports, $dislikedTags;
	echo "<div id=\"content\">";
	//print_r ($sports);
	foreach ($sports as $tech => $articles) {
		//echo $tech;
		//echo "</br></br>";
		if (!in_array($tech, $dislikedTags)) {
			foreach ($articles as $article) {
				$index = str_replace(" ", "", $article['title']);
				if (!isset($alreadyIn[$index])) {
					$temp = $article['title'] . " ------------ sports";
					//if (strcmp($temp, $articleTitle) != 0)  {
					if (!in_array($temp, $dislikedArticles)) {
						echo "<div class=\"wrapper\">";
						echo "<header class=\"DivHeader\">";
						$alreadyIn[$index] = 1;
						//echo "TITLE : " . $article['title'] . "</br>"; 
						$temp = str_replace(array('\'', "\"", "&"), "", $article['title']);
						$link = "<h3><a style=\"text-decoration: none;font:21px HelveticaNeue-Light;font:21px HelveticaNeue-Light;color:#3333CC;\" href='";
						$link .= "headline2.php?type=sports&title=" . $temp . "'>";
						$link .=  $article['title'] . "</a><h3>"; 
						echo $link;
						echo "</header>";
						
						//echo "LINK : " . $article['link'] . "</br>";
						//echo "IMAGE : " . $article['image'] . "</br>";
						//echo "SITE_TITLE : ". $article['site_title'] . "</br>";
						
						echo "<div class=\"middle\">";
							echo "<div class=\"container\">";
								echo "<main class=\"hello\">";
									echo $article['story'] . "</br>";
									echo "</main>";
							echo "</div>";
							
							$img = $article['image'];
							if ($article['image'] == NULL) {
								$img = "MakerWare.jpg";
							} 
							
							
							echo "<aside class=\"left-sidebar\" style=\"background-image: url(" . $img . ");background-repeat:no-repeat;vertical-align:top;background-size:cover;\">";
							/**echo "<aside class=\"left-sidebar\">";
								$img = "<img width=\"225\" height=\"80\" style=\"margin: 0 auto;\" src='";
								if ($article['image'] == NULL) {
									$img .= "MakerWare.jpg'/></br>";
								} else {
									$img .= $article['image'] . "'/></br>";
								}
								echo $img;**/
					echo "</aside>";
						echo "</div>";
						echo "<footer class=\"DivFooter\">";
							echo "News Source: ". $article['site_title'] . "</br>";
						echo "</footer>";
					echo "</div></br></br>";
			
					}
				}
			} 
		}
	}
	echo "</div>";
}

function topNews() {
	global $top;
	//print_r($top);
	//echo "<div id=\"story\">";
	echo "<div id=\"content\">";
	foreach ($top as $tech => $articles) {
		//echo $tech;
		//echo "</br></br>";
		foreach ($articles as $article) {
			//echo "$article </br>";
			//print_r ($articles);
			//echo "</br></br>";
			$index = str_replace(" ", "", $article['title']);
			if (!isset($alreadyIn[$index])) {
								
				$temp = $article['title'] . " ------------ top";
					//if (strcmp($temp, $articleTitle) != 0)  {
				
				if (!in_array($temp, $dislikedArticles)) {
					//echo "<div class=\"story\">";
					echo "<div class=\"wrapper\">";
						echo "<header class=\"DivHeader\">";
							$alreadyIn[$index] = 1;
							$temp = str_replace(array('\'', "\"", "&"), "", $article['title']);
							$link = "<h3><a style=\"text-decoration: none;font:21px HelveticaNeue-Light;color:#3333CC;\" href='";
							$link .= "headline2.php?type=top&title=" . $temp . "'>";
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
					//echo "</div>";	
					
						//echo "LINK : " . $article['link'] . "</br>";
						
						
							
						//echo "TAGS : " . $article['tags'] . "</br></br>";
					
				}
			}
		}	
	}
	echo "</div>";
}
//echo "</div>";
function open() {
	global $technology, $sports, $top;
	
	if (file_exists("newsArticles/techNews.txt")) {
		//echo "File exists</br>";
		$technology = unserialize(file_get_contents("newsArticles/techNews.txt")); 
		//$keyWordsWorld = unserialize(file_get_contents("newsArticles/worldNews.txt"));
		$sports = unserialize(file_get_contents("newsArticles/sportsNews.txt"));
		$top = unserialize(file_get_contents("newsArticles/topNews.txt"));
		//$keyWordsEntertainment = unserialize(file_get_contents("newsArticles/entertainmentNews.txt"));
		//$keyWordsUS = unserialize(file_get_contents("newsArticles/usNews.txt"));
		//var_dump($keyWordsTechnology);
	} else {
		echo "File does not exist</br>";	
	}	
}
?>
<!---/div--->
</div>


</body>
</html>