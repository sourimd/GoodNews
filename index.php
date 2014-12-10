<?php session_start();
include_once ('userFilesParser.php');
?>

<!DOCTYPE html>
<html>
<head>

<style type="text/css"> 
.modalWindow {
        position: fixed;
        font-family: arial;
        font-size:80%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.2);
        z-index: 99999;
        opacity:0;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: none;
    }
    .modalHeader h2 { color: #189CDA; border-bottom: 2px groove #efefef; }
    .modalWindow:target {
        opacity:1;
        pointer-events: auto;
    }
    .modalWindow > div {
        width: 333px;
        position: relative;
        margin: 10% auto;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #fff;
    }
    .modalWindow .modalHeader  {    padding: 5px 20px 0px 20px; }
    .modalWindow .modalContent {    padding: 0px 20px 5px 20px; }
    .modalWindow .modalFooter  {    padding: 8px 20px 8px 20px; }
    .modalFooter {
        background: #F1F1F1;
        border-top: 1px solid #999;
        -moz-box-shadow: inset 0px 13px 12px -14px #888;
        -webkit-box-shadow: inset 0px 13px 12px -14px #888;
        box-shadow: inset 0px 13px 12px -14px #888;
    }
    .modalFooter p {
        color:#D4482D;
        text-align:right;
        margin:0;
        padding: 5px;
    }
    .close, .cancel {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        text-align: center;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }
    .close {
        position: absolute;
        right: 5px;
        top: 5px;
        width: 22px;
        height: 22px;
        font-size: 10px;
 
    }
    .cancel {
        width:80px;
        float:right;
        margin-left:20px;
    }
    .close:hover, .cancel:hover { background: #D4482D; }
    .clear { float:none; clear: both; }

</style>  

</head>

<body>

<a href="#openModal">Filter By</a>
<div id="openModal" class="modalWindow">
    <div>
         
        <div class="modalHeader">
            <h2>Filter By</h2>
            <a href="#close" title="Close" class="close">X</a>
        </div>
         
        <div class="modalContent">
            <a href="newsStories.php?type=technology">Technology</a></br>
            <a href="newsStories.php?type=top">Top Stories</a></br>
            <a href="newsStories.php?type=sports">Sports</a></br>
        </div>
         
        <div class="modalFooter">
            <a href="#cancel" title="Cancel" class="cancel">Cancel</a>
            <div class="clear"></div>
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

echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";

if (isset($_SESSION['sessionVarUserID'])) {
	echo "USER SET : " . $_SESSION['sessionVarUserID'] . "</br></br></br>";
	$useUserInfo = true;	
	$dislikedArticles = $_SESSION['dislikedArticles'];
}
//$dislikedTags = getDislikedTags();
//echo "DISLIKED TAGS ARRAY</br></br>";
//print_r($dislikedTags);
echo "</br></br>";

if (isset($_REQUEST['type'])) {
	if ($_REQUEST['type'] == 'technology') {
		technologyNews();	
	}
	else if ($_REQUEST['type'] == 'top') {
		topNews();
	}
	else {
		sportsNews();
	}	
} else {
	//technologyNews();
	//sportsNews();
	topNews();	
}

	
	
	//print_r ($dislikedTags);

function technologyNews() {
	global $technology;
	echo "</br></br></br>Technology</br>";
	foreach ($technology as $tech => $articles) {	
		//echo count($articles);
		foreach ($articles as $article) {
			$index = str_replace(" ", "", $article['title']);
				if (!isset($alreadyIn[$index])) {
					$temp = $article['title'] . " ------------ technology";
					//if (strcmp($temp, $articleTitle) != 0)  {
					if (!in_array($temp, $dislikedArticles)) {
						$alreadyIn[$index] = 1;
						//echo "TITLE : " . $article['title'] . "</br>"; 
						$temp = str_replace(array('\'', "\"", "&"), "", $article['title']);
						$link = "<a href='";
						$link .= "headline.php?type=technology&title=" . $temp . "'>";
						$link .=  $article['title'] . "</a></br>"; 
						echo $link;
						echo "LINK : " . $article['link'] . "</br>";
						echo "IMAGE : " . $article['image'] . "</br>";
						echo "SITE_TITLE : ". $article['site_title'] . "</br>";
						echo "STORY : " . $article['story'] . "</br>";		
						echo "TAGS : " . $article['tags'] . "</br></br>";
				}	
			}
		}	
	}
}


function sportsNews() {
	global $sports, $dislikedTags;
	
	//print_r ($sports);
	foreach ($sports as $tech => $articles) {
		//echo $tech;
		echo "</br></br>";
		if (!in_array($tech, $dislikedTags)) {
			foreach ($articles as $article) {
				$index = str_replace(" ", "", $article['title']);
				if (!isset($alreadyIn[$index])) {
					$temp = $article['title'] . " ------------ sports";
					//if (strcmp($temp, $articleTitle) != 0)  {
					if (!in_array($temp, $dislikedArticles)) {
						$alreadyIn[$index] = 1;
						//echo "TITLE : " . $article['title'] . "</br>"; 
						$temp = str_replace(array('\'', "\"", "&"), "", $article['title']);
						$link = "<a href='";
						$link .= "headline.php?type=sports&title=" . $temp . "'>";
						$link .=  $article['title'] . "</a></br>"; 
						echo $link;
						echo "LINK : " . $article['link'] . "</br>";
						echo "IMAGE : " . $article['image'] . "</br>";
						echo "SITE_TITLE : ". $article['site_title'] . "</br>";
						echo "STORY : " . $article['story'] . "</br>";		
						echo "TAGS : " . $article['tags'] . "</br></br>";
					}
				}
			} 
		}
	}
}

function topNews() {
	global $top;
	//print_r($top);
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
					$alreadyIn[$index] = 1;
					$temp = str_replace(array('\'', "\"", "&"), "", $article['title']);
					$link = "<a href='";
					$link .= "headline.php?type=top&title=" . $temp . "'>";
					$link .=  $article['title'] . "</a></br>"; 
					echo $link;
					echo "LINK : " . $article['link'] . "</br>";
					echo "IMAGE : " . $article['image'] . "</br>";
					echo "SITE_TITLE : ". $article['site_title'] . "</br>";
					echo "STORY : " . $article['story'] . "</br>";		
					echo "TAGS : " . $article['tags'] . "</br></br>";
				}
			}
		}	
	}
}

function open() {
	global $technology, $sports, $top;
	
	if (file_exists("newsArticles/techNews.txt")) {
		echo "File exists</br>";
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
</body>
</html>