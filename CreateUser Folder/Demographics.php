<html>
  <head></head>

<body>
<?php session_start();

   $uid=$_SESSION['sessionVarUserID'];
      
   $worldRating=$_POST['World'];
  

   $USRating=$_POST['US'];
  

   $sportsRating=$_POST['Sport'];
  

  $personalizedChoice=$worldRating."\t".$USRating."\t".$sportsRating;

  $fp_two = fopen($uid.".txt", "a");
  fwrite($fp_two, $personalizedChoice);
  fclose($fp_two);
  
?>

   <form action="Submit.php" method="post">
      <table>
         <tr><td>Gender</td><td><select name="Gender">
               <option value="Male">Male</option>
               <option value="Female">Female</option>
               
            </select></td></tr>

          <tr><td>News Paper Editions</td><td><select name="Country">
               <option value="USA">USA</option>
               <option value="India">India</option>
               <option value="China">China</option>
            </select></td></tr>

          <tr><td>Occupation</td><td><select name="occupation">
               <option value="Professor">Professor</option>
               <option value="Student">Student</option>
               <option value="AdministrativeStaff">Administrative Staff</option>
            </select></td></tr>

      </table>
      <input type="submit" name="submit" value="Submit"/>
   </form>
 </body>
</html>