<?php session_start(); 
ob_start();?>

<?php
$to = $_POST['mailto'];
$subject = $_SESSION['sessionVarprefName'] . " thought you might like this article.";

$message = "Hey! Thought you might like this article. " . $_SESSION['shareArticleTitle'] ."\n " . $_SESSION['shareArticleLink'];
$headers="From: ".$_SESSION['sessionVarUserID']; // put this value from logged in user's mail id

if ($to){
  mail($to,$subject,$message,$headers);
 // echo "Mail Sent.";
 	$temp = $_SESSION['shareArticleTitle'];
 	$temp = str_replace(array('\'', "\"", "&"), "", $temp);
	$goTo = "headline2.php?type=" . $_SESSION['shareType'] . "&title=" . $temp . "&m=y";
 	header('Location: ' . $goTo);
	die();
  }

else{
  echo "Type target Mail Id properly";
  $back="window.location='mailtofriends.html';";
  echo "<input type='button' value='Go Back' onclick='$back'/>";
  }

?>



<? ob_end_flush(); ?>
