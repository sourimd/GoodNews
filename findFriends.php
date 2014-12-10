<?php session_start(); ?>
<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" type="text/css" href="style.css">
   <script>
      function showHint(str)
      {
      if (str.length==0)
      { 
      document.getElementById("txtHint").innerHTML="";
       return;
      }
      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
         xmlhttp=new XMLHttpRequest();
      }
      else
       {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
       }
      xmlhttp.onreadystatechange=function()
       {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
       {
       document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
       }
       }
      xmlhttp.open("GET","SearchFriendsProcessing.php?q="+str,true);
      xmlhttp.send();
    }
</script>
 </head>
 <body>
  <div id="header_container">
    <div id="header">
       <?php
       		
       			//echo "Good news App ";
       			echo "<a style=\"position:absolute; TOP:30px; LEFT:185px;\" href=\"index2.php\"><img src=\"logo.png\" height=\"42\" width=\"242\"/></a>";       			//echo "<input type=\"button\" value=\"friends\" onclick=\"window.location='login.html'\"/>";
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:735px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"findFriends.php\">Friends</a>"; 
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:635px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"userHomePage.php\">Your Page</a>"; 
       			echo "<a style=\"position:absolute; TOP:20px; LEFT:815px;font: 18px HelveticaNeue-Light;text-decoration: none;\" href=\"logout.php\">Log Out</a>"; 
       			
       			//echo "<input type=\"button\" value=\"log out\" onclick=\"window.location='logout.php'\"/>";
       			//echo "<input type=\"button\" value=\"your page\" onclick=\"window.location='logout.php'\"/>";

       			
       		
       ?>

    </div>
</div>

<div id="container">
<div id="content">
<div style="position:absolute;TOP:100px;LEFT:285px;">
   <form action="Friend.php" method="post">
     <table>
        <tr><td>Search</td><td><input style="width: 500px;" type="text" name="mailto" onkeyup="showHint(this.value)"></td></tr>
        
        <tr><td><input type="submit" value="Go"/></td></tr>
     </table>
   </form>
   <p><b>Results:</b><br/> <span id="txtHint"></span></p>
 </div>
 </div>
 </div>
 
 
 
 </body>
</html>