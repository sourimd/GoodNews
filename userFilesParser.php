<? session_start();

	//$file = file_get_contents("sourimd@clemson.edu.txt");
	
	//print_r($file);
	
	$contents = array();
	$demographics = array();
	$likedArticles = array();
	$dislikedArticles = array();
	$dislikedTags = array();
	$readLater = array();
//	print_r($contents);
	
	
	//print_r($demographics);
	
	//$likedTags = explode("\n", trim($contents[4]));

	//print_r($dislikedTags);


	function parseFile($string) {
		global $contents, $demographics, $likedArticles, $dislikedAricles, $dislikedTags;
		
		$file = file_get_contents($string);
		
		$contents = explode("\n\n\n", $file);
		
		$demographics = explode("\n", trim($contents[0]));
		$likedArticles = explode("\n", trim($contents[1]));
		$dislikedArticles = explode("\n", trim($contents[2]));
		
		
		$readLater = explode("\n", trim($contents[3]));	
		echo "CONTENTS 3 : </br>";
		print_r($readLater);
		echo "</br></br></br>";	
	}


	//when saving the tags that are liked or disliked make them lower cased and get rid of spaces, quotes, all that jazz
	/*** getter methods ***/
	function getDemographics() {
		global $demographics;
		return $demographics;	
	}
	
	function getLikedArticles() {
		global $likedArticles;
		return $likedArticles;
	}
	
	function getDislikedArticles() {
		global $dislikedArticles;
		return $dislikedArticles;
	}
	
	function getDislikedTags() {
		global $dislikedTags;
		return $dislikedTags;
	}
	
	function getLikedTags() {	
		global $likedTags;
		return $likedTags;
	}
	
	function getReadLater() {
		global $readLater;
		return $readLater;
	}
	
	/*** setter methods ***/
	function setDemographics($changeTo) {
		global $demographics;
		$demographics = $changeTo;	
	}
	
	function setLikedArticles($changeTo) {
		global $likedArticles;
		$likedArticles = $changeTo;
	}
	
	function setDislikedArticles($changeTo) {
		global $dislikedArticles;
		$dislikedArticles = $changeTo;
	}
	
	function setDislikedTags($changeTo) {
		global $dislikedTags;
		 $dislikedTags = $changeTo;
	}
	
	function setLikedTags($changeTo) {	
		global $likedTags;
		$likedTags = $changeTo;
	}



	
	


?>