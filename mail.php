<?php

	$to = "someone@example.com";
	$subject = "Good News Article Suggested For You";
	$message = "Hey! Check out this article I think you'll like.";
	$from = "someonelse@example.com";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
	echo "Mail Sent.";

?>