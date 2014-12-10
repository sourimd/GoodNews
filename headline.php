<? session_start(); 
ob_start();
include 'userFilesParser.php';
?>

<!DOCTYPE html>
<html>
 <head> 
 

<body>


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
echo "</br></br></br> GET ARTICLE : " . $_GET['title'] . "</br></br></br>";

if (isset($_REQUEST['l'])) {
	
	if (isset($_SESSION['sessionVarUserID'])) {
		echo "USER SET : " . $_SESSION['sessionVarUserID'] . "</br></br></br>";
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
		
		
	} else {
		echo "user not set";
		header('Location: login.html');
		die();
		
	}
	//we'll store updates in the session variable
}

if (isset($_REQUEST['d'])) {
	
	if (isset($_SESSION['sessionVarUserID'])) {
		echo "USER SET : " . $_SESSION['sessionVarUserID'] . "</br></br></br>";
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
		
		
	} else {
		echo "user not set";
		header('Location: login.html');
		die();
		
	}
	//we'll store updates in the session variable
}

if (isset($_REQUEST['r'])) {
	
	if (isset($_SESSION['sessionVarUserID'])) {
		echo "USER SET : " . $_SESSION['sessionVarUserID'] . "</br></br></br>";
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
		
		
	} else {
		echo "user not set";
		header('Location: login.html');
		die();
		
	}
	//we'll store updates in the session variable
}



echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";
$prevArticle = "";
$nextArticle = "";
$found = false;
//echo "<a href='HCCProject/newsStories.php/?type='" . $_REQUEST['type'] . "'>Back Button</a></br>";
$link = "<a href='newsStories.php?type=";
 $link .=  $_REQUEST['type'] . "'>Back Button</a></br>";
echo $link;
$index = 0;


foreach ($mainArticles as $tech => $articles) {
	//foreach ($articles as $article) {
	echo "</br></br></br>TECH : $tech</br></br></br>";
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
		
		echo "</br></br></br>PREVIOUS INDEX : $index </br></br></br>";
		$prevArticle = str_replace(array('\'', "\"", "&"), "", $prevArticle);
		echo "</br></br></br>ARTICLES SIZE : " . count($articles) . "</br></br></br>";
		
		echo "</br></br></br>TEMP : $temp    ARTICLETITLE : $articleTitle</br></br></br>";
		if (strcmp($temp, $articleTitle) == 0) {
			
			echo "TITLE : " . $articles[$i]['title'] . "</br>";   
			
			//echo "LINK : " . $article['link'] . "</br>";
			echo "IMAGE : " . $articles[$i]['image'] . "</br>";
			//echo "SITE_TITLE : " . $article['site_title'] . "</br>";
			$img = "<img src='";
			$img .= $articles[$i]['image'] . "'/>";
			echo $img;
			$iframe = "<iframe src='"; 
			$iframe .= $articles[$i]['link'] . "'></iframe>";
			echo $iframe;
			$link = "<a href='";
			$link .= $articles[$i]['link'] . "' target='_blank'>";
			$link .=  $articles[$i]['site_title'] . "</a></br>"; 
			echo $link;
			echo "STORY : " . $articles[$i]['story'] . "</br>";		
			$_SESSION['shareArticleTitle'] = $articles[$i]['title'];
			$_SESSION['shareArticleLink'] = $articles[$i]['link'];
			$found = true;
			//break;
		}
		$index = $i + 1;
		if ($index == count($articles)) {
			$nextArticle = $articles[0]['title'];
			echo "</br></br></br>NEXT INDEX : 0 </br></br></br>";			
		}else {
			$nextArticle = $articles[$index]['title'];
			echo "</br></br></br>NEXT INDEX : $index </br></br></br>";	
		}
		$nextArticle = str_replace(array('\'', "\"", "&"), "", $nextArticle);
		
		if ($found) break;
	}	
	if ($found) break;
}

//$query = http_build_query($tags);
//$url = urlencode(serialize($tags));

echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&l=y" . "\">Like</a></br>";
echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&d=y" . "\">DisLike</a></br>";
echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $_REQUEST['title'] . "&r=y" . "\">Read Later</a></br>";

echo "<a href=\"peopleAlsoLiked.php?key=$tech&type=" . $_REQUEST['type'] . "\">People Who Read This Also Read</a></br>";
echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $prevArticle . "\">Previous Article</a></br>";
echo "<a href=\"headline.php?type=" . $_REQUEST['type'] . "&title=" . $nextArticle . "\">Next Article</a></br>";

echo "<a href=\"mailtofriends.html\">Share</a></br>";


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
ob_end_flush();
?>

</body>
</html>
