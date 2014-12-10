<!DOCTYPE html>
<html>
  <head></head>
<body>
<?php session_start();

   $uid=$_SESSION['sessionVarUserID'];
   $prefName=$_SESSION['sessionVarprefName']; 
      
   $gender=$_POST['Gender'];
  
   $country=$_POST['Country'];
  
   $occupation=$_POST['occupation'];
  
  $demographicChoice=$gender."\t".$country."\t".$occupation."\n";

  $fp_x = fopen($uid.".txt", "a");
  fwrite($fp_x, $demographicChoice);
  fclose($fp_x);

  echo "<h5>Hi $prefName</h5>";
  
?>

  <input type="button" value="log out" onclick="window.location='login.html'"/>

  
 </body>
</html>
