<html>
  <head>
    <title>HCC SARA</title>
    <h3>News reading preference</h3>
  </head>

  <body>
    <?php

       session_start();   

       $userid = $_POST['UserID'];
       $pwd = $_POST['password'];
       $cnfPwd = $_POST['confirmPassword'];
       $prefName = $_POST['Name'];

       $_SESSION['sessionVarUserID'] = $userid;   


       $fp = fopen("loginInfo.txt", "a");

       $fpone = fopen($userid.".txt", "a");

       $stringToWrite="\t".$userid."\t".$pwd."\t".$prefName;

       fwrite($fp, $stringToWrite);

       fclose($fpone);

       fclose($fp);

    ?>


        <h4>Which of these headlines would you like to read?</h4>

        <form action="NewsReadingPref.php" method=post>
            <input type="checkbox" name="headlines[]" value="firstHD">First Headlines</input><br>
            <input type="checkbox" name="headlines[]" value="secondHD">Second Headlines</input><br>           
            <input type="checkbox" name="headlines[]" value="thirdHD">Third Headlines</input><br>
            <input type="checkbox" name="headlines[]" value="fourthHD">Fourth Headlines</input> <br>

            <input type="submit" value="Next"/>         
        </form> 



  </body>
</html>