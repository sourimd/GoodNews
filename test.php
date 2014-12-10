<?php
/*** NOW WE NEED TO PERFORM THE SENTIMENT ANALYSIS ON THE HEADLINES AND THEN WE CAN HAVE A FILE SORTED BY TYPE, E.G. TECHNOLOGY, WORLD, OTHER STUFF, AND LUEGO WE WILL PUT ALL THE INFORMATION ABOUT THE FILES IN THERE AND THEN WE CAN MOVE FORWARD ***/

//include('news.php');
/**$news = new GoogleNews();
$news->setSearchQuery('technology');
$news->setNumberOfNews('10');
$news->getNews();**/

//var_dump($news);
//echo "</br></br></br>";
//print_r($news);

//include('news.php');
//echo "WHAT!!!";
//$news = new GoogleNews();
//$thing = $news->getNews();

//print_r($thing);
//var_dump($thing);
	/**$url = "http://news.google.com/news?hl=en&gl=us&q=austria&bav=on.2,or.r_gc.r_pw.,cf.osb&biw=1920&bih=973&um=1&ie=UTF-8&output=rss";
$feed = simplexml_load_file($url);

echo $feed->channel->title, "\n<", $feed->channel->link, ">\n\n";

foreach($feed->channel->item as $item)
{
    echo "* $item->title\n  <$item->link>\n";
}**/

$feedURL = 'https://news.google.com/news/feeds?q=technology&output=rss';
$ch = curl_init($feedURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$rss = curl_exec($ch);
curl_close($ch);
//echo $data.'<br>'; /* shows data!! */
$news = simplexml_load_string($rss); /*Also false*/

	//$news = simplexml_load_file('https://news.google.com/news/feeds?q=technology&output=rss');
//var_dump ($news);
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
	
	//echo strip_tags($parts[2]);
	//echo "</br>";
	//echo get_yahoo_terms(strip_tags($parts[2])) . "</br>";
	$feeds[$i]['tags'] = get_yahoo_terms($feeds[$i]['story']);//) {
	   /** echo "\nYahoo terms for the file $source";
	    foreach ($terms as $term) {
	       echo "\n$term";
    	}
    	echo "\n";
	}**/

	print_r($feeds);
	echo "</br></br>";
    $i++;
}

//echo '<pre>';
//print_r($feeds);
//echo '</pre>';

/*** GET KEYWORDS IF GOOD LORD'S WILL ***/



function get_yahoo_terms($content) {
	$content = str_replace("&quot;", "", $content);
	$content = str_replace("&#039;", "", $content);
	//$array = array();
	$content = str_replace(array("\n", "\r", "\"", "'", "&quot;", "&#039;"), "", $content);
	//echo "CONTENT: $content</br>";
	$yqlBaseURL = "http://query.yahooapis.com/v1/public/yql";
	$yqlQuery = 'select * from search.termextract where context="';
	$yqlQuery .= $content . '"';
	$yqlQueryURL = $yqlBaseURL . "?q=" . urlencode($yqlQuery) . "&format=json";
    
   // echo "</br>QUERY : " . $yqlQueryURL . "</br>";
   // echo "</br> $yqlQuery </br>";
    
    //echo "</br>CONTENT : $content</br>";
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
    	//echo $phpObj->query->results . "</br>";
    	//if (is_array($phpObj->query->results)) {
      //Parse results and extract data to display 
      //$array = (array) $phpObj->query->results;
      	//var_dump($phpObj->query->results);
    	//echo $phpObj->query->results["Result"];
    	foreach ($phpObj->query->results as $event) {  
      	//print_r((array)$phpObj->query->results);
      	//print_r($event);
      	if (is_array($event)) {
      		foreach ($event as $term) {
	      		$string .= $term . "\t";
	      	//	echo $term . "</br>";	
      		}
      	} else {
      		$string = $event;	
      	}
      	//foreach ($event as $term) {
      	//	$string .= $term . "\t";
      	//	echo $term . "</br>";	
      	//}
      	
      //	echo "</br></br>";
        /**$events .= "<div><h2>" . $event->xmlns . "</h2><p>";  
        $events .= html_entity_decode(wordwrap($event->description, 80, "<br/>"));  
        $events .="</p><br/>$event->venue_name<br/>$event->venue_address<br/>";  
        $events .="$event->venue_city, $event->venue_state_name";  
        $events .="<p><a href=$event->ticket_url>Buy Tickets</a></p></div>";  **/
      }  
    //} else {
    	//echo $phpObj->query->results . "</br>";
    	//$string = $phpObj->query->results;	
    //}
    }  
    
    return trim($string);
   // $SERVICE_URL = 'http://api.search.yahoo.com/ContentAnalysisService/V1/termExtraction';
   // $SERVICE_URL = $yqlBaseURL . "?q=" . urlencode($yqlQuery);
    /**$SERVICE_URL = "http://query.yahooapis.com/v1/public/yql";
    $app_id = 'F1_Testing';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $SERVICE_URL);
    curl_setopt($ch, CURLOPT_POST, 3);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, 'appid=' . $app_id . '&context=' . urlencode($content) . '&output=php');
    $raw = curl_exec($ch);
    curl_close($ch);

    if ($raw = unserialize($raw)) {
    	print_r($raw);
        if (isset($raw['ResultSet']['Result'])) {
			 return $raw['ResultSet']['Result'];
		}
	}
	**/
	
	
}
	//echo file_get_contents();//' http://api.feedzilla.com/v1/cultures.xml' 'http://api.feedzilla.com/v1/categories/13/articles.rss?title_only=1' 'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=n&output=rss');
	
	//echo "okay\n";
	/**
	$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://api.feedzilla.com/v1/categories/13/articles.rss?title_only=1',

    ));
    $resp = curl_exec($curl);
    curl_close($curl);
    echo $resp;

**/
?>