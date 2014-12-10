<?php
	include 'sentiment.class.php';
	
	$sentiment = new Sentiment();
	
	$examples = array(
        1 => 'Weather today is rubbish',
        2 => 'This cake looks amazing',
        3 => 'His skills are mediocre',
        4 => 'He is very talented',
        5 => 'She is seemingly very agressive',
        6 => 'Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.',
        7 => 'To be or not to be?',);



	foreach ($examples as $key => $example) {

    	//echo "KEY : $key\t\t EXAMPLE : $example\n";
    	
    	//echo '<div class="example">';
        //echo "<h2>Example $key</h2>";
        //echo "<blockquote>$example</blockquote>";


		//Score takes a string to analyze... that's good possibly
       // echo "Scores:\n";
        $scores = $sentiment->score($example);
        
        print_r($scores);
        foreach ($scores as $class => $score) {
        	echo "$class = $score\n";
        	//echo "\n\n\nClass : $class \t" . $sentiment->categorise($example) . "\n" ;
            if ($class == $sentiment->categorise($example)) {
            	$string = "<b class=\"$class\">$string</b>";
            }
                                echo "<ol>$string</ol>";      	
        }
                        echo "</ul>";
                        echo '</div>';
     	
     	//echo "Example : $example\n";
     	//echo "Class : $class \t" . $sentiment->categorise($example) . "\n" ;
     	
     	echo "\n\n";
     }


?>