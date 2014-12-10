<?php
//include 'phpInsight-master/sentiment.class.php';
//include 'classa.inc';

$keyWordsSports = array();
$keyWordsTop = array();
$keyWordsTechnology = array();

open();

/*** Technology News ***/
$feedURL = 'https://news.google.com/news/feeds?q=technology&output=rss';
$keyWordsTechnology = getRssNews($feedURL, $keyWordsTechnology);
//print_r ($keyWordsTechnology);
echo "</br></br></br>";
echo "Tech Count Afterwards: " . count($keyWordsTechnology);

/*** Sports News ***/
$feedURL = 'https://news.google.com/news/feeds?q=sports&output=rss';
$keyWordsSports = getRssNews($feedURL, $keyWordsSports);
//print_r ($keyWordsSports);
echo "</br></br></br>";
echo "Sports Count Afterwards: " . count($keyWordsSports);

/*** Top News ***/
$feedURL = 'https://news.google.com/news/feeds?q=top+news&output=rss';
$keyWordsTop = getRssNews($feedURL, $keyWordsTop);
print_r ($keyWordsTop);
echo "</br></br></br>";
echo "Top Count Afterwards: " . count($keyWordsTop);

save();

function getRssNews ($feedURL, $feeds) {
	$ch = curl_init($feedURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$rss = curl_exec($ch);
	curl_close($ch);
	$news = simplexml_load_string($rss);
	//$feeds = array();
	//$sentiment = new Sentiment();
	$i = 0;
	
	
	if (isset($feeds)) $i = count($feeds);
	
	echo "COUNT BEFORE : " . count($feeds) . "</br></br></br>";
	foreach ($news->channel->item as $item) {
		
	    preg_match('@src="([^"]+)"@', $item->description, $match);
	    $parts = explode('<font size="-1">', $item->description);
		
	//	if (($sentiment->categorise((string) $item->title) == 'pos') || ($sentiment->categorise((string) $item->title) == 'neu')) {
			$feeds[$i]['title'] = (string) $item->title;
		 	$feeds[$i]['link'] = (string) $item->link;
		    $feeds[$i]['image'] = $match[1];
		    $feeds[$i]['site_title'] = strip_tags($parts[1]);
		    $feeds[$i]['story'] = strip_tags($parts[2]);		
		
			$i++;
	//	}	    
	}	
	
	//classifyNews ($feeds);
	//return $feeds;
	$array = classifyNews($feeds);
	return $array;
}

function classifyNews ($feeds) {

	$array = array();
	$count = 0;
	//$feeds = getRssNews($url);
	
	for ($i = 0; $i < count($feeds); $i++) {
		for ($j = $i+1; $j < count($feeds); $j++) {
			$temp = strtolower($feeds[$i]['story']);
			$temp = str_replace(array('.', ',', ')', '(', ';' , ':', '!', '@', '#', '$', '%', '^', '&', '*', '+', '=', '}', '{', '[', ']', '\\', '?', '/', '<', '>', '~', '`', '_', '|' ), "", $temp);
			$array1 = explode(" ", $temp);

			$temp = strtolower($feeds[$j]['story']);
			$temp = str_replace(array('.', ',', ')', '(', ';' , ':', '!', '@', '#', '$', '%', '^', '&', '*', '+', '=', '}', '{', '[', ']', '\\', '?', '/', '<', '>', '~', '`', '_', '|' ), "", $temp);
			$array2 = explode(" ", $temp);

			$cos = cosineSimilarity($array1, $array2);
			
			if ($cos > 0.12) {
				$title = str_replace(array(" ", '\'', "\""), "", $feeds[$i]['story']);
				$title = trim($title);
				if (isset($array[$title])) $count = count($array[$title]);
					
				$array[$title][$count] = $feeds;
				$count++;	
			}
		
		}			
		$count = 0;
	}
	
	return $array;

}


function cosineSimilarity($tokensA, $tokensB) {
    $a = $b = $c = 0;
    $uniqueTokensA = $uniqueTokensB = array();

    $uniqueMergedTokens = array_unique(array_merge($tokensA, $tokensB));

    foreach ($tokensA as $token) $uniqueTokensA[$token] = 0;
    foreach ($tokensB as $token) $uniqueTokensB[$token] = 0;

    foreach ($uniqueMergedTokens as $token) {
        $x = isset($uniqueTokensA[$token]) ? 1 : 0;
        $y = isset($uniqueTokensB[$token]) ? 1 : 0;
        $a += $x * $y;
        $b += pow($x,2);
        $c += pow($y,2);
    }
    return $b * $c != 0 ? $a / sqrt($b * $c) : 0;
}


function save() {
	global $keyWordsTechnology, $keyWordsSports, $keyWordsTop;
	
	if($f = @fopen("newsArticles/techNews.txt", "w")) { 
    	if(@fwrite($f,serialize($keyWordsTechnology))) { 
        	@fclose($f); 
        } 
        else die("Could not write to file newsArticles/techNews.txt at Persistant::save"); 
    } 
    else die("Could not open file newsArticles/techNews.txt for writing, at Persistant::save"); 
    
    if($f = @fopen("newsArticles/sportsNews.txt", "w")) { 
    	if(@fwrite($f,serialize($keyWordsSports))) { 
        	@fclose($f); 
        } 
        else die("Could not write to file newsArticles/sportsNews.txt at Persistant::save"); 
    } 
    else die("Could not open file newsArticles/sportsNews.txt for writing, at Persistant::save"); 
    
    if($f = @fopen("newsArticles/topNews.txt", "w")) { 
    	if(@fwrite($f,serialize($keyWordsTop))) { 
        	@fclose($f); 
        } 
        else die("Could not write to file newsArticles/topNews.txt at Persistant::save"); 
    } 
    else die("Could not open file newsArticles/topNews.txt for writing, at Persistant::save"); 
}

function open() {
	global $keyWordsTechnology, $keyWordsSports, $keyWordsTop;
	
	if (file_exists("newsArticles/techNews.txt")) {
		$keyWordsTechnology = unserialize(file_get_contents("newsArticles/techNews.txt")); 
		//$keyWordsWorld = unserialize(file_get_contents("newsArticles/worldNews.txt"));
		$keyWordsSports = unserialize(file_get_contents("newsArticles/sportsNews.txt"));
		$keyWordsTop = unserialize(file_get_contents("newsArticles/topNews.txt"));
		//$keyWordsEntertainment = unserialize(file_get_contents("newsArticles/entertainmentNews.txt"));
		//$keyWordsUS = unserialize(file_get_contents("newsArticles/usNews.txt"));
	} 
 
}



?>