<html>
  <head></head>
<body>
<?php session_start();

   $uid=$_SESSION['sessionVarUserID'];
      
   $gender=$_POST['Gender'];
  

   $country=$_POST['Country'];
  

   $occupation=$_POST['occupation'];
  

  $demographicChoice=$gender."\t".$country."\t".$occupation;

  $fp_x = fopen($uid.".txt", "a");
  fwrite($fp_x, $demographicChoice);
  fclose($fp_x);
  
?>
</body>
</html>
