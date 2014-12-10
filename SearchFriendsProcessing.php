<html>
<head></head>
<body>
<?php
// Fill up array with names
$fp = fopen("loginInfo.txt", "r");
$i=0;
 while(!feof($fp))
  {
  $userids=explode("\t",fgets($fp));
  $a[$i]=$userids[0];
  $i++;
  }
fclose($fp);
//get the q parameter from URL
$q=$_GET["q"];

//lookup all hints from array if length of q>0
if (strlen($q) > 0)
  {
  $hint="";
  for($i=0; $i<count($a); $i++)
    {
    if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q))))
      {
      if ($hint=="")
        {
        $hint=$a[$i];
        }
      else
        {
        $hint=$hint."<br/>".$a[$i];
        }
      }
    }
  }

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "")
  {
  $response="no suggestion";
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;
?>
</body>
</html>


