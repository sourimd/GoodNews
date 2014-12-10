<?php session_start();  ?>
<!DOCTYPE html>
<html>
  <head>
   <link rel="stylesheet" type="text/css" href="style.css">
    <title>HCC SARA</title>
    <h3>News reading preference</h3>
  </head>

  <body>
    <?php

         

       $userid = $_POST['UserID'];
       $pwd = $_POST['password'];
       $cnfPwd = $_POST['confirmPassword'];
       $prefName = $_POST['Name'];

       $_SESSION['sessionVarUserID'] = trim($userid);   


       $fp = fopen("loginInfo.txt", "a");

       $fpone = fopen($userid.".txt", "a");

       $stringToWrite= $userid."\t".$pwd."\t".$prefName . "\n";

       fwrite($fp, $stringToWrite);

       fclose($fpone);

       fclose($fp);

    ?>


        <h4>Which of these headlines would you like to read?</h4>

        <form action="NewsReadingPref.php" method=post>
            <input type="checkbox" name="headlines[]" value="firstHD">Global PlayStation 4 sales reach 2.1 million...</input><br>
            <input type="checkbox" name="headlines[]" value="secondHD">Ellsbury to sign with Yankees for $153 million</input><br>           
            <input type="checkbox" name="headlines[]" value="thirdHD">Mobile Chrome Apps closer than you think</input><br>

            <input type="submit" value="Next"/>         
        </form> 



  </body>
</html>