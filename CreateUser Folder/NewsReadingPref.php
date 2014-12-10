<html>
  <head>
    <title>HCC SARA</title>
    <h3></h3>
  </head>

  <body>
    <?php  session_start();
       
      $usid=$_SESSION['sessionVarUserID'];
      

      $news=$_POST['headlines'];

      $allnews="";

      for($i=0;$i<count($news);$i++)
         $allnews=$allnews.$news[$i]."\t";


      $fp_one = fopen($usid.".txt", "a");

       fwrite($fp_one, $allnews);
      fclose($fp_one);
      

    ?>

    <form action="Demographics.php" method=post>
        <table>
          <tr>
            <td>World</td>

            <td>0<input type="range" name="World" min="1" max="10">10</td>
            
          </tr>
          <br/>
          <tr>
 
           <td>US News</td>
            <td>0<input type="range" name="US" min="1" max="10">10</td>
           
          </tr>
            <br/>

          <tr>

           <td>Sports</td>
            <td>0<input type="range" name="Sport" min="1" max="10">10</td>


          </tr>

        </table>
            <br/>
            <input type="submit" name="submit" value="Next"/>         
    </form> 



  </body>
</html>