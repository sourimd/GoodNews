<?php
 /**
 * Google-News feed parser and JSON provider Class
 *
 * @package None
 * @author Nuhil Mehdy <nuhil@nuhil.net>
 */
class GoogleNews {
 
    public $searchQuery = 'Good News';
 
    public function __construct ($searchQuery) {
            if(!empty($searchQuery)) {
                    $this->searchQuery = $searchQuery;
            }
 
            $this->numberOfNews = 5;
    }
 
    public function __toString() {
            return $this->getNews();
    }
 
    public function setSearchQuery($searchQuery) {
            if(!empty($searchQuery)) {
                    $this->searchQuery = $searchQuery;
            }
    }
 
    public function setNumberOfNews ($numberOfNews) {
            if(!empty($numberOfNews)) {
                    $this->numberOfNews = (int) $numberOfNews;
            }
    }
 
    public function getNews () {
    	
 //echo "$news[$i]['title']</br>";
            return $this->processNews();
    }
 
    public function processNews() {
    	
            $loadXml = simplexml_load_file(urlencode('http://news.google.com/news?q='.$this->searchQuery.'&num='.$this->numberOfNews.'&output=rss'));
 
 			//echo 'http://news.google.com/news?q='.$this->searchQuery.'&num='.$this->numberOfNews.'&output=rss';
            $news = array();
 
            $i = 0;
            var_dump($loadXml);
            foreach ($loadXml->channel->item as $item) {
            	//echo "$item";
                preg_match('@src="([^"]+)"@', $item->description, $match);
                $newsSections = explode('</pre>', $item->description);
 
				 $news[$i]['title'] = (string) $item->title;
				 $news[$i]['image'] = $match[1];
				 $news[$i]['link'] = (string) $item->link;
				 $news[$i]['news_source'] = strip_tags($newsSections[1]);
				 $news[$i]['short_story'] = strip_tags($newsSections[2]);
				 
				 $i++;
 			}
 
			 $result = array('news' => $news, 'status' => '200', 'message' => 'OK');
			//print_r($news);
			return $news;
//echo "WHAT IS GOING ON!!!!! 333"; 
 //return json_encode($result);

 }
 
}
?>