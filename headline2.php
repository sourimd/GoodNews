<? session_start(); 
ob_start();
include 'userFilesParser.php';
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
       			echo "<a style=\"position:absolute; TOP:30px; LEFT:185px;\" href=\"index2.php\"><img src=\"logo.png\" height=\"42\" width=\"242\"/></a>";       			//echo "<input type=\"button\" value=\"friends\" onclick=\"window.location='login.html'\"/>";
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:735px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"findFriends.php\">Friends</a>"; 
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:635px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"userHomePage.php\">Your Page</a>"; 
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:815px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"logout.php\">Log Out</a>"; 
       			
       			//echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";
       			//echo "<input type=\"button\" value=\"your page\" onclick=\"window.location='logout.php'\"/>";

       			
       		} else {
       			//echo "Good news App ";
       			echo "<a style=\"position:absolute; TOP:30px; LEFT:185px;\" href=\"index2.php\"><img src=\"logo.png\" height=\"42\" width=\"242\"/></a>";       			//echo "<input type=\"button\" value=\"sign in/create\" onclick=\"window.location='login.html'\"/>";
       			echo "<a style=\"position:absolute; TOP:25px; LEFT:775px;font: 18px HelveticaNeue-Light;text-decoration: none;\"href=\"login.html\">Sign In/Create</a>"; 
       		}
       			       ?>

    </div>

<div id="container">
    <div id="content" style="overflow-y:hidden">
<?php


//Previous Article
//Next Article
//People Also liked
//Like button
//Dislike Button

//echo "HEADLINE.php";


//echo "</br>" . $_REQUEST['type'];
//echo "</br>" . $_REQUEST['title'];


$mainArticles = open($_REQUEST['type']);

$articleTitle = $_REQUEST['title'];
//echo "</br></br></br> GET ARTICLE : " . $_GET['title'] . "</br></br></br>";

if (isset($_REQUEST['m'])) {
	echo "<div class=\"notification-bar\">";  
    //echo "<input id=\"hide\" type=\"radio\" name=\"bar\" value=\"hide\">";  
    //echo "<input id=\"show\" type=\"radio\" name=\"bar\" value=\"show\" checked=\"checked\">";  
      
    //echo "<label for=\"hide\">hide</label>";  
    //echo "<label for=\"show\">show</label>";  
      
    echo "<div class=\"notification-text\">Sent</div>";  
	echo "</div>";  
}

if (isset($_REQUEST['l'])) {
	
	if (isset($_SESSION['sessionVarUserID'])) {
		//echo "USER SET : " . $_SESSION['sessionVarUserID'] . "</br></br></br>";
		//echo "LIKED </br></br></br>";
		/**$liked = getLikedArticles();
		echo "LIKED BEFORE ADDITION : ";
		print_r($liked);
		$liked[count($liked)] = $_REQUEST['title'] . " ------------ " . $_REQUEST['type'];
		echo "</br></br></br>LIKED AFTER ADDITION : ";
		print_r($liked);
		//setLikedArticles($liked);
		$liked = getLikedArticles();
		echo "</br></br></br>NEW ARTICLE SAVED : ";
		print_r($liked);**/
		
		$liked = $_SESSION['likedArticles'];
		$liked[count($liked)] = $_REQUEST['title'] . " ------------ " . $_REQUEST['type'];
		$_SESSION['likedArticles'] = $liked;
		
		echo "<div class=\"notification-bar\">";  
    //echo "<input id=\"hide\" type=\"radio\" name=\"bar\" value=\"hide\">";  
    //echo "<input id=\"show\" type=\"radio\" name=\"bar\" value=\"show\" checked=\"checked\">";  
      
    //echo "<label for=\"hide\">hide</label>";  
    //echo "<label for=\"show\">show</label>";  
      
    echo "<div class=\"notification-text\">Liked</div>";  
	echo "</div>";  
		
		
	} else {
		echo "user not set";
		header('Location: login.html');
		die();
		
	}
	//we'll store updates in the session variable
}

if (isset($_REQUEST['d'])) {
	
	if (isset($_SESSION['sessionVarUserID'])) {
		//echo "USER SET : " . $_SESSION['sessionVarUserID'] . "</br></br></br>";
		/**$liked = getLikedArticles();
		echo "LIKED BEFORE ADDITION : ";
		print_r($liked);
		$liked[count($liked)] = $_REQUEST['title'] . " ------------ " . $_REQUEST['type'];
		echo "</br></br></br>LIKED AFTER ADDITION : ";
		print_r($liked);
		//setLikedArticles($liked);
		$liked = getLikedArticles();
		echo "</br></br></br>NEW ARTICLE SAVED : ";
		print_r($liked);**/
		
		$disliked = $_SESSION['dislikedArticles'];
		$disliked[count($disliked)] = $_REQUEST['title'] . " ------------ " . $_REQUEST['type'];
		$_SESSION['dislikedArticles'] = $disliked;
		
		echo "<div class=\"notification-bar\">";  
    //echo "<input id=\"hide\" type=\"radio\" name=\"bar\" value=\"hide\">";  
    //echo "<input id=\"show\" type=\"radio\" name=\"bar\" value=\"show\" checked=\"checked\">";  
      
    //echo "<label for=\"hide\">hide</label>";  
    //echo "<label for=\"show\">show</label>";  
      
    echo "<div class=\"notification-text\">Disliked</div>";  
	echo "</div>";  
		
		
	} else {
		echo "user not set";
		header('Location: login.html');
		die();
		
	}
	//we'll store updates in the session variable
}

if (isset($_REQUEST['r'])) {
	
	if (isset($_SESSION['sessionVarUserID'])) {
		//echo "USER SET : " . $_SESSION['sessionVarUserID'] . "</br></br></br>";
		/**$liked = getLikedArticles();
		echo "LIKED BEFORE ADDITION : ";
		print_r($liked);
		$liked[count($liked)] = $_REQUEST['title'] . " ------------ " . $_REQUEST['type'];
		echo "</br></br></br>LIKED AFTER ADDITION : ";
		print_r($liked);
		//setLikedArticles($liked);
		$liked = getLikedArticles();
		echo "</br></br></br>NEW ARTICLE SAVED : ";
		print_r($liked);**/
		
		$disliked = $_SESSION['readLater'];
		$disliked[count($disliked)] = $_REQUEST['title'] . " ------------ " . $_REQUEST['type'];
		$_SESSION['readLater'] = $disliked;
		
		echo "<div class=\"notification-bar\">";  
    //echo "<input id=\"hide\" type=\"radio\" name=\"bar\" value=\"hide\">";  
    //echo "<input id=\"show\" type=\"radio\" name=\"bar\" value=\"show\" checked=\"checked\">";  
      
   // echo "<label for=\"hide\">hide</label>";  
    //echo "<label for=\"show\">show</label>";  
      
    echo "<div class=\"notification-text\">Saved For Later</div>";  
	echo "</div>";  
		
		
	} else {
		echo "user not set";
		header('Location: login.html');
		die();
		
	}
	//we'll store updates in the session variable
}



//echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";
$prevArticle = "";
$nextArticle = "";
$found = false;
//echo "<a href='HCCProject/newsStories.php/?type='" . $_REQUEST['type'] . "'>Back Button</a></br>";
$link = "<a href='index2.php?type=";
 $link .=  $_REQUEST['type'] . "'>Back Button</a></br>";
echo $link;
$index = 0;


foreach ($mainArticles as $tech => $articles) {
	//foreach ($articles as $article) {
	//echo "</br></br></br>TECH : $tech</br></br></br>";
	for ($i = 0; $i < count($articles); $i++) {
		$temp = str_replace(array('\'', "\"", "&"), "", $articles[$i]['title']);
		$_SESSION['LikeArticles'] = $articles;
		
		if ($i == 0) {
			$index = count($articles)-1;
			$prevArticle = $articles[$index]['title'];			
		} else {
			$index = $i - 1;
			$prevArticle = $articles[$index]['title'];	
		}
		
		//echo "</br></br></br>PREVIOUS INDEX : $index </br></br></br>";
		$prevArticle = str_replace(array('\'', "\"", "&"), "", $prevArticle);
		//echo "</br></br></br>ARTICLES SIZE : " . count($articles) . "</br></br></br>";
		
		//echo "</br></br></br>TEMP : $temp    ARTICLETITLE : $articleTitle</br></br></br>";
		if (strcmp($temp, $articleTitle) == 0) {
			
					echo "<div class=\"wrapper\">";
						echo "<header class=\"DivHeader\" style=\"background: #F0F0F0;\">";
						
							$t = str_replace(array('\'', "\"", "&"), "", $articles[$i]['title']);
							$link = "<h3><a style=\"text-decoration: none;font:22px HelveticaNeue-Light;color:#3333CC;\" href='";
							$link .=  $articles[$i]['link'] . "'>";
							$link .=  $articles[$i]['title'] . "</a></h3>"; 
							//echo "</br></br>headline.php?type=top&title=" . $temp . "</br></br>";
							echo $link;
							
							$_SESSION['peopleLike'] = $link;
							$_SESSION['peopleType'] = $_REQUEST['type'];
						echo "</header>";
						echo "<div class=\"middle\">";
							echo "<div class=\"hello\">";
								echo "<main class=\"content\">";
									echo $articles[$i]['story'] . "</br>";
								echo "</main>";
							echo "</div>";
							
							$img = $articles[$i]['image'];
							if ($articles[$i]['image'] == NULL) {
								$img = "MakerWare.jpg";
							} 
							
							
							echo "<aside class=\"left-sidebar\" style=\"background-image: url(" . $img . ");background-repeat:no-repeat;vertical-align:top;background-size:cover;\">";
							/**echo "<aside class=\"left-sidebar\">";
								$img = "<img width=\"225\" height=\"80\" style=\"margin: 0 auto;\" src='";
								if ($articles[$i]['image'] == NULL) {
									$img .= "MakerWare.jpg'/></br>";
								} else {
									$img .= $articles[$i]['image'] . "'/></br>";
								}
								echo $img;
								//echo "IMAGE : " . $article['image'] . "</br>";
								**/
							echo "</aside>";
							echo "</div>";
							echo "<footer class=\"DivFooter\" style=\"height:700px;\">";
								echo "News Source: ". $articles[$i]['site_title'] . "</br>";
								$iframe = "<iframe src=\""; 
			$iframe .= $articles[$i]['link'] . "\" sandbox=\"allow-forms allow-scripts\" width=\"700\" height=\"700\"></iframe>";
			
			
			
			echo $iframe;
							echo "</footer>";
						echo "</div></br></br>";

					
					//echo "<h1>" . $articles[$i]['title'] . "</h1>";
			
					//echo "TITLE : " . $articles[$i]['title'] . "</br>";   
					
			//echo "LINK : " . $article['link'] . "</br>";
			
								//echo "IMAGE : " . $articles[$i]['image'] . "</br>";
					//echo "SITE_TITLE : " . $article['site_title'] . "</br>";
						/**$img = "<img width=\"200\" height=\"250\" src='";
						if ($articles[$i]['image'] == NULL) {
							$img .= "MakerWare.jpg'/>";
						} else {
							$img .= $articles[$i]['image'] . "'/>";
						}
						echo $img;**/
					
				
				
			
		
			/**echo "<div class=\"divRow\">";
				echo "<div class=\"divColumn\">";
			$link = "<a href='";
			$link .= $articles[$i]['link'] . "' target='_blank'>";
			$link .=  $articles[$i]['site_title'] . "</a></br>"; 
			echo $link; 
			echo "</div>";
	
			echo "<div class=\"divColumn\">";**/
			//echo "STORY : " . $articles[$i]['story'] . "</br>";		
			$_SESSION['shareArticleTitle'] = $articles[$i]['title'];
			$_SESSION['shareArticleLink'] = $articles[$i]['link'];
			$_SESSION['shareType'] = $_REQUEST['type'];
			$found = true; 
			/**echo "</div>";
			echo "</div>";
			echo "</div>";**/
			//break;
		}
		$index = $i + 1;
		if ($index == count($articles)) {
			$nextArticle = $articles[0]['title'];
			//echo "</br></br></br>NEXT INDEX : 0 </br></br></br>";			
		}else {
			$nextArticle = $articles[$index]['title'];
			//echo "</br></br></br>NEXT INDEX : $index </br></br></br>";	
		}
		$nextArticle = str_replace(array('\'', "\"", "&"), "", $nextArticle);
		
		if ($found) break;
	}	
	if ($found) break;
}

//$query = http_build_query($tags);
//$url = urlencode(serialize($tags));

/**echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&l=y" . "\">Like</a></br>";
echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&d=y" . "\">DisLike</a></br>";
echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&r=y" . "\">Read Later</a></br>";

echo "<a href=\"peopleAlsoLiked.php?key=$tech&type=" . $_REQUEST['type'] . "\">People Who Read This Also Read</a></br>";
echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $prevArticle . "\">Previous Article</a></br>";
echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $nextArticle . "\">Next Article</a></br>";

echo "<a href=\"mailtofriends.html\">Share</a></br>";**/


function open($choice) {
	
	if ($choice == 'technology') {
		$var = unserialize(file_get_contents("newsArticles/techNews.txt"));
	} else if ($choice == 'top') {
		$var = unserialize(file_get_contents("newsArticles/topNews.txt"));
	} else {
		$var = unserialize(file_get_contents("newsArticles/sportsNews.txt"));
	}
	
	return $var;
}

?>
</div>
</div>

<div id="footer_container">

		
    <div id="footer">
    	<!--div class="fire-check"--->
       <?php
      // echo "<div class=\"footContainer\">";
				
			//	echo "<div class=\"left\">";
			//	echo "</div>";
				
				//echo "<div class=\"divFooterColumn\">";
				
						//echo "<div class=\"divRow\">";
		//echo "<div class=\"divColumn\">";
		//echo "<div class=\"center\">";
		echo "<a style=\"position:absolute; TOP:6px; LEFT:195px;\" href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $prevArticle . "\"><img src=\"background.png\" height=\"43\" width=\"44\" /></a>";

		
	//echo "<a href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $prevArticle . "\">Previous</a></br>";
			//	echo "</div>";
				
			//		echo "<div class=\"divRow\">";
			
			
	echo "<a style=\"position:absolute; TOP:6px; LEFT:245px;\" href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&l=y" . "\"><img src=\"thumbsUp.png\" height=\"43\" width=\"44\" /></a>";
       
       //echo "<a class=\"fire\" href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&l=y" . "\">Like</a></br>";
       	//		echo "</div>";
       			
       	//			echo "<div class=\"divRow\">";
       			//echo "<div class=\"divColumn\">";
      		
       			
       	echo "<a style=\"position:absolute; TOP:6px; LEFT:305px;\" href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&d=y" . "\"><img src=\"thumbsDown.png\" height=\"43\" width=\"44\" /></a>";
       			
	//echo "<a href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&d=y" . "\">DisLike</a></br>";
		//		echo "</div>";
				
			//echo "<div class=\"divColumn\">";

			
		//		echo "<div class=\"divRow\">";
		
		echo "<a style=\"position:absolute; TOP:6px; LEFT:355px;\" href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $nextArticle . "\"><img src=\"forward.png\" height=\"43\" width=\"44\" /></a>";
		
			//echo "<a href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $nextArticle . "\">Next</a></br>";
			
					//echo "</div>";
				//echo "</div>";
			
			
				
				
				
				
		//echo "<div class=\"right\">";
		
					
	echo "<a style=\"position:absolute; TOP:6px; LEFT:641px;text-decoration: none;\" href=\"peopleAlsoLiked.php?key=$tech&type=" . $_REQUEST['type'] . "\">People Also Read</a></br>";
				
					echo "<a style=\"position:absolute; TOP:6px; LEFT:777px;text-decoration: none;\" href=\"headline2.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&r=y" . "\">Read Later</a></br>";
				
       echo "<a style=\"position:absolute; TOP:6px; LEFT:865px;text-decoration: none;\" href=\"mailtofriends.php\">Share</a></br>";
       		//echo "</div>";
       		//echo "</div>";
       ?>
    <!--/div>
    </div>
       
    <!---input type="checkbox" class="fire-check" />
		<button class="fire">Activate me</button>
			
			<section>
			
	            <div class="tn-box tn-box-color-2">
					<p>Your settings have been saved successfully!</p>
					<div class="tn-progress"></div>
				</div>
				
				<!---div class="tn-box tn-box-color-2">
					<p>Yummy! I just ate your settings! They were delicious!</</p>
					<div class="tn-progress"></div>
				</div>
				
				<div class="tn-box tn-box-color-3">
					<p>Look at me! I take much longer!<p>
					<div class="tn-progress"></div>
				</div--->
				
			<!---/section--->

   </div>
</div>

<? ob_end_flush(); ?>
</body>
</html>