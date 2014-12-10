<?php
include ('userFilesParser.php');

$demographics = getDemographics();

echo "Demographics</br>";
print_r($demographics);
$demographics[0] = 'Amber is the best';

setDemographics ($demographics);

$demograhpics = getDemographics();

echo "</br</br>After changing Demograhpics </br>";
print_r($demographics);

$demographics = getDislikedTags();
print_r($demographics);
?>