<?php session_start(); ?>

<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 
 <div id="header_container">
    <div id="header">
       <?php
       			//echo "Good news App ";
       			echo "<a style=\"position:absolute; TOP:30px; LEFT:185px;\" href=\"index2.php\"><img src=\"logo.png\" height=\"42\" width=\"242\"/></a>";       			//echo "<input type=\"button\" value=\"friends\" onclick=\"window.location='login.html'\"/>";
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:735px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"findFriends.php\">Friends</a>"; 
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:635px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"userHomePage.php\">Your Page</a>"; 
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:815px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"logout.php\">Log Out</a>"; 
       			
       			//echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";
       			//echo "<input type=\"button\" value=\"your page\" onclick=\"window.location='logout.php'\"/>";

       			
       		
       ?>

    </div>
</div>

<div id="container">
<div id="content">
 <div style="position:absolute;TOP:100px;LEFT:285px;">
 
 <?php 


echo "<h3 style=\"text-decoration: none;font: 24px HelveticaNeue-Light;color:#3333CC;\">Saved for Later</h3>";
//echo $_SESSION['sessionVarUserID'] . "</br></br>";
//print_r($_SESSION['demographics']);
foreach ($_SESSION['readLater'] as $later) {
	$temp = explode("------------", $later);
	$title = str_replace(array('\'', "\"", "&"), "", $temp[0]);	
	$link = "<a style=\"text-decoration: none;font:16px HelveticaNeue-Light;color:#B0B0B0;\" href='";
	$link .= "headline2.php?type=" . trim($temp[1]) . "&title=" . $title . "'>";
	$link .=  trim($temp[0]) . "</a></br>"; 
	echo $link . "</br>";
}

echo "<h3 style=\"text-decoration: none;font: 24px HelveticaNeue-Light;color:#3333CC;\">Liked Articles</h3>";
foreach ($_SESSION['likedArticles'] as $later) {
	$temp = explode("------------", $later);
	$title = str_replace(array('\'', "\"", "&"), "", $temp[0]);	
	$link = "<a style=\"text-decoration: none;font:16px HelveticaNeue-Light;color:#B0B0B0;\" href='";
	$link .= "headline2.php?type=" . trim($temp[1]) . "&title=" . $title . "'>";
	$link .=  trim($temp[0]) . "</a></br>"; 
	echo $link . "</br>";
}

echo "<h3 style=\"text-decoration: none;font: 24px HelveticaNeue-Light;color:#3333CC;\">Disliked Articles</h3>";
foreach ($_SESSION['dislikedArticles'] as $later) {
	$temp = explode("------------", $later);
	$title = str_replace(array('\'', "\"", "&"), "", $temp[0]);	
	$link = "<a style=\"text-decoration: none;font:16px HelveticaNeue-Light;color:#B0B0B0;\" href='";
	$link .= "headline2.php?type=" . trim($temp[1]) . "&title=" . $title . "'>";
	$link .=  trim($temp[0]) . "</a></br>"; 
	echo $link . "</br>";
}

?>
</div>
</div>
</div>
</body>
</html>