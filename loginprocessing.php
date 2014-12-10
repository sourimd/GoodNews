<?php session_start();
ob_start();
 //include 'userFilesParser.php';
 
 $uid = $_POST['userid'];
 $pwd = $_POST['password'];

 $fp = fopen("loginInfo.txt", "r");
 $flag=0;
 
 while(!feof($fp)) {
  	$loginusercredentials=explode("\t",fgets($fp));
 	$loginusercredentials[0] = trim($loginusercredentials[0]);
 	$uid = trim($uid);
 	$pwd = trim($pwd);
 	$loginusercredentials[1] = trim($loginusercredentials[1]);
 	
  if((strcmp($loginusercredentials[0], $uid) == 0) && (strcmp($loginusercredentials[1], $pwd) == 0)){
    // echo "Welcome ".$loginusercredentials[2];
     $_SESSION['sessionVarUserID'] = trim($uid);
     $_SESSION['userName'] = trim($loginusercredentials[2]);
     $flag=1;
     parseFile($_SESSION['sessionVarUserID'] . ".txt");
     /***$_SESSION['likedArticles'] = getLikedArticles();
     echo "</br></br>";
     print_r($_SESSION['likedArticles']);
     
     
     $_SESSION['dislikedArticles'] = $dislikedArticles;
     echo "</br></br>";
     print_r($_SESSION['dislikedArticles']);
     
     
     //$_SESSION['dislikedTags'] = getDislikedTags();
     $_SESSION['demographics'] = getDemographics();
     echo "</br></br>";
     print_r($_SESSION['demographics']);
     
     $_SESSION['readLater'] = getReadLater();
     echo "</br></br>";
     print_r($_SESSION['readLater']);
     //$_SESSION['likedTags'] = getLikedTags();***/
     break;
     }

  }
fclose($fp);

  if($flag==0) echo "Username or Password Incorrect";
  else {
  	/**echo "DEMOGRAPHICS</br></br>";
  	print_r($_SESSION['demographics']);
  	echo "</br></br>Liked Articles</br></br>";
  	print_r($_SESSION['likedArticles']);
  	echo "</br></br>DisLiked Articles</br></br>";
  	print_r($_SESSION['dislikedArticles']);
  	echo "</br></br>Read Later</br></br>";
  	print_r($_SESSION['readLater']);**/
  	header('Location: index2.php');
    die();
  }


 function parseFile($string) {
		//global $contents, $demographics, $likedArticles, $dislikedAricles, $dislikedTags;
		
		$file = file_get_contents($string);
		
		$contents = explode("\n\n\n", $file);
		
		$_SESSION['demographics'] = explode("\n", trim($contents[0]));
		$_SESSION['likedArticles'] = explode("\n", trim($contents[1]));
		$_SESSION['dislikedArticles'] = explode("\n", trim($contents[2]));
		
		
		$_SESSION['readLater'] = explode("\n", trim($contents[3]));	

	}



?>