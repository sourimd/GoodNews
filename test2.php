<?php
include 'phpInsight-master/sentiment.class.php';
include("classa.inc");

/*** NOW WE NEED TO PERFORM THE SENTIMENT ANALYSIS ON THE HEADLINES AND THEN WE CAN HAVE A FILE SORTED BY TYPE, E.G. TECHNOLOGY, WORLD, OTHER STUFF, AND LUEGO WE WILL PUT ALL THE INFORMATION ABOUT THE FILES IN THERE AND THEN WE CAN MOVE FORWARD ***/


/**$ch = curl_init($feedURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$rss = curl_exec($ch);
curl_close($ch);
$news = simplexml_load_string($rss);
$feeds = array();

$i = 0;

foreach ($news->channel->item as $item) {
	
    preg_match('@src="([^"]+)"@', $item->description, $match);
    $parts = explode('<font size="-1">', $item->description);

    $feeds[$i]['title'] = (string) $item->title;
    $feeds[$i]['link'] = (string) $item->link;
    $feeds[$i]['image'] = $match[1];
    $feeds[$i]['site_title'] = strip_tags($parts[1]);
    $feeds[$i]['story'] = strip_tags($parts[2]);

	$feeds[$i]['tags'] = get_yahoo_terms($feeds[$i]['story']);
    $i++;
}
print_r($feeds);
//echo '<pre>';
//print_r($feeds);
//echo '</pre>';**/


//echo "Starting";
//$keyWordsTechnology = array();
//$keyWordsWorld = array();
$keyWordsSports = array();
//$keyWordsTop = array();
//$keyWordsEntertainment = array();
//$keyWordsUS = array();
//open();


/*** Technology News ***/
//$feedURL = 'https://news.google.com/news/feeds?q=technology&output=rss';
//getRssNews($feedURL, 'newsArticles/technologyNews.txt', $keyWordsTechnology);


/*** World News ***/
//$feedURL = 'https://news.google.com/news/feeds?q=world&output=rss';
//getRssNews($feedURL, 'newsArticles/worldNews.txt', $keyWordsWorld);


/*** Sports News ***/
$feedURL = 'https://news.google.com/news/feeds?q=sports&output=rss';
getRssNews($feedURL, 'newsArticles/sportsNews.txt', $keyWordsSports);

/*** Top News ***/
//$feedURL = 'https://news.google.com/news/feeds?q=top+news&output=rss';
//getRssNews($feedURL, 'newsArticles/topNews.txt', $keyWordsTop);

/*** Entertainment News ***/
//$feedURL = 'https://news.google.com/news/feeds?q=entertainment&output=rss';
//getRssNews($feedURL, 'newsArticles/entertainmentNews.txt', $keyWordsEntertainment);

/*** Health News ***/
//$feedURL = 'https://news.google.com/news/feeds?q=health&output=rss';
//getRssNews($feedURL, 'healthNews.txt', $keyWordsHealth);

/*** US News ***/
//$feedURL = 'https://news.google.com/news/feeds?q=U.S.&output=rss';
//getRssNews($feedURL, 'newsArticles/usNews.txt', $keyWordsUS);


//save();


function save($keyWord, $file) {
	if($f = @fopen($file, "w")) { 
    	if(@fwrite($f,serialize($keyWord))) { 
        	@fclose($f); 
        } 
        else die("Could not write to file " . $file . " at Persistant::save"); 
    } 
    else die("Could not open file " . $file . " for writing, at Persistant::save"); 
}

function open() {
	global $keyWordsTechnology, $keyWordsSports, $keyWordsTop;
	
	if (file_exists("newsArticles/technologyNews.txt")) {
		$keyWordsTechnology = unserialize(file_get_contents("newsArticles/technologyNews.txt")); 
		//$keyWordsWorld = unserialize(file_get_contents("newsArticles/worldNews.txt"));
		$keyWordsSports = unserialize(file_get_contents("newsArticles/sportsNews.txt"));
		$keyWordsTop = unserialize(file_get_contents("newsArticles/topNews.txt"));
		//$keyWordsEntertainment = unserialize(file_get_contents("newsArticles/entertainmentNews.txt"));
		//$keyWordsUS = unserialize(file_get_contents("newsArticles/usNews.txt"));
	}
 	//$handle = fopen("technologyNews.txt", "r");
 	//$datain = fread($handle, filesize("technologyNews.txt"));
 	//fclose($handle);
 	
 	//print_r($vars);
 
 
}


function getRssNews ($feedURL, $file, $keyWords) {
	$ch = curl_init($feedURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$rss = curl_exec($ch);
	curl_close($ch);
	$news = simplexml_load_string($rss);
	$feeds = array();
	$sentiment = new Sentiment();
	$i = 0;
	//$current = file_get_contents($file);
	//$string = "";
	
	foreach ($news->channel->item as $item) {
		
	    preg_match('@src="([^"]+)"@', $item->description, $match);
	    $parts = explode('<font size="-1">', $item->description);
		
		if ($sentiment->categorise((string) $item->title) == 'pos') {
			$feeds[$i]['title'] = (string) $item->title;
		 	$feeds[$i]['link'] = (string) $item->link;
		    $feeds[$i]['image'] = $match[1];
		    $feeds[$i]['site_title'] = strip_tags($parts[1]);
		    $feeds[$i]['story'] = strip_tags($parts[2]);		
			
			//print_r ();
			$feeds[$i]['tags'] = get_yahoo_terms($feeds[$i]['story']);
		
			$i++;
		}
	    
	}	
	//print_r($feeds);
	//echo count($feeds);
	classifyNews($feeds, $file, $keyWords);
	//return feeds;
	//echo "Done 2";
}

function classifyNews($feeds, $file, $keyWords) {
	$i = 0;
	
	$j = 0;
	
	//echo sizeof($feeds);
	for ($i = 0; $i < count($feeds); $i++) {
		$tags = explode("\t", $feeds[$i]['tags']);
		
		//echo $feeds[$i]['tags'] . "</br>";
		foreach ($tags as $tag) {
			
			$tag = str_replace(" ", "", $tag);
			$tag = strtolower($tag);
			echo "$tag</br></br>";
			//echo "</br></br></br>$tag </br>";
			if (array_key_exists($tag, $keyWords)) {
				$j = count($keyWords[$tag]);	
			}
			$keyWords[$tag][$j] = $feeds[$i];
			$j++;
		}
		//if (!isset(keyWords[$term])) {
		//	keyWords[$term] = "";
		//}
	}
	//print_r($keyWords);
	
	//var_dump($keyWords);
	//count($keyWords);
	//for ($i = 0; $i < count($keyWords); $i++) {
	//	print_r($keyWords[$i]);
	//	echo "</br></br>";	
	//}
	
	/**foreach ($keyWords as $thing => $t) {
		//var_dump($keyWords[$thing]);
		//echo "</br></br>";	
		echo "$thing </br>";
		print_r($t);
		echo "</br></br>";
	}**/
	
	//save($keyWords, $file);
}

function get_yahoo_terms($content) {
	$content = str_replace("&quot;", "", $content);
	$content = str_replace("&#039;", "", $content);

	$content = str_replace(array("\n", "\r", "\"", "'", "&quot;", "&#039;"), "", $content);

	$yqlBaseURL = "http://query.yahooapis.com/v1/public/yql";
	$yqlQuery = 'select * from search.termextract where context="';
	$yqlQuery .= $content . '"';
	$yqlQueryURL = $yqlBaseURL . "?q=" . urlencode($yqlQuery) . "&format=json";

	//echo $yqlQuery;
    $session = curl_init($yqlQueryURL);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($session);
    if ($json === FALSE) {
    	die ("Curl failed with error: " . curl_error($session));	
    }
    
    $phpObj = json_decode($json);
    if (is_null($phpObj)) {
    	die("json_decode failed with error: " . json_last_error());	
    }
    
    
    if (!is_null($phpObj->query->results)) {  
       	foreach ($phpObj->query->results as $event) {  
	      	if (is_array($event)) {
	      		foreach ($event as $term) {
		      		$string .= trim($term) . "\t";
	      		}
	      	} else {
	      		$string = $event;	
	      	}
		}  
    }  
    
    return trim($string);
}

?>