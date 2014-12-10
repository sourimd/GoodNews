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

  $frndid=$_POST['mailto'];
  $filetoretrieve=$frndid.".txt";

  $file = file_get_contents($filetoretrieve);
	
	//print_r($file);
	
	
	$contents = explode("\n\n\n", trim($file));
	
//	print_r($contents);
	
	$demographics = explode("\n", trim($contents[0]));
	$likedArticles = explode("\n", trim($contents[1]));
	$dislikedArticles = explode("\n", trim($contents[2]));
	$readLater = explode("\n", trim($contents[3]));
	//$dislikedTags = explode("\n", trim($contents[3]));
	//$likedTags = explode("\n", trim($contents[4]));

echo "<h3 style=\"text-decoration: none;font: 24px HelveticaNeue-Light;color:#3333CC;\">Liked Articles</h3>";
foreach ($likedArticles as $later) {
	$temp = explode("------------", $later);
	$title = str_replace(array('\'', "\"", "&"), "", $temp[0]);	
	$link = "<a href='";
	$link .= "headline2.php?type=" . trim($temp[1]) . "&title=" . $title . "'>";
	$link .=  trim($temp[0]) . "</a></br>"; 
	echo $link . "</br>";
}

echo "<h3 style=\"text-decoration: none;font: 24px HelveticaNeue-Light;color:#3333CC;\">Disliked Articles</h3>";
foreach ($dislikedArticles as $later) {
	$temp = explode("------------", $later);
	$title = str_replace(array('\'', "\"", "&"), "", $temp[0]);
	$link = "<a href='";
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