<?php session_start();
ob_start();
include 'userFilesParser.php';


$string = $_SESSION['sessionVarUserID'] . ".txt";
$file = fopen($string, "w");


$temp = $_SESSION['demographics'];
foreach ($temp as $line) {
	$line .= "\n";
	fwrite($file, $line);	
}
fwrite($file, "\n\n\n");


$temp = $_SESSION['likedArticles'];
foreach ($temp as $line) {
	$line .= "\n";
	fwrite($file, $line);	
}
fwrite($file, "\n\n\n");

$temp = $_SESSION['dislikedArticles'];
foreach ($temp as $line) {
	$line .= "\n";
	fwrite($file, $line);	
}
fwrite($file, "\n\n\n");

$temp = $_SESSION['readLater'];
foreach ($temp as $line) {
	$line .= "\n";
	fwrite($file, $line);	
}
//fwrite($file, "\n\n\n");

/***$temp = $_SESSION['dislikedTags'];
foreach ($temp as $line) {
	$line = str_replace(array(" ", '\'', '\"'), "", $line);
	$line .= "\n";
	fwrite($file, $line);	
}
fwrite($file, "\n\n\n");

$temp = $_SESSION['likedTags'];
foreach ($temp as $line) {
	$line = str_replace(array(" ", '\'', '\"'), "", $line);
	$line .= "\n";
	fwrite($file, $line);	
}**/
fclose($file);

unset($_SESSION['demographics']);
//unset($_SESSION['likedTags']);
unset($_SESSION['sessionVarUserID']);
unset($_SESSION['dislikedArticles']);
unset($_SESSION['likedArticles']);
unset($_SESSION['dislikedTags']);
unset($_SESSION['LikeArticles']);
unset($_SESSION['readLater']);



header('Location: login.html');
die();

?>