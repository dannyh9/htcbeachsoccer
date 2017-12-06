<?php
include('databaseconnection.php');
?>

<div class="col12 col-md-3" id="sidebar">
  <style>
  .boldtext{
    font-weight:bold;
  }
</style>
          <div class="container">
            <div class="text-center boldtext" style="border:1px #164394 solid" >
              <?php
              // Create a new DateTime object
              $date = new DateTime();
              //$date=strtotime($date);
                list($day,$month,$year) = explode("/",date('d/m/Y/'));
                echo $month.'/'.$day.'/'.$year.'';
                $dateString= $month. '/' .$day.'';
              // Check if current day is not saturday
               // if($date("l")!="saturday"){
                //$date->modify('next saturday');
              //}
              $datePrint = $date->format('j F');
              echo("Zaterdag " . $datePrint . "");
              //$date=strtolower($date);
              var_dump($dateString);
              $thuisteamquery=("SELECT `Thuisteam` FROM `wedstrijd` WHERE `Datum` LIKE %'$dateString'%");
              $result=mysqli_query($conn, $thuisteamquery);
              while($row = mysql_fetch_array($result)) {
                echo $row['fieldname'];
              }
              var_dump($teamthuis);
              var_dump($result);
              exit;
              ?>
              <br>
              12:00 uur
              <br>
              <a> <img src="./img/svhtc.png" style="max-width:60px"></a>
               - 
              <a> <img src="./img/svhtc.png" style="max-width:60px"></a>
              <br><?php
              echo($teamthuis); echo(" - uitteam")?>
            </div>
            <br><br>
            <div class="text-center boldtext" style="border:1px #164394 solid">
              Zaterdag 9 december
              <br>
              12:00 uur
              <br>
              <a> <img src="./img/svhtc.png" style="max-width:60px"></a>
               - 
              <a> <img src="./img/svhtc.png" style="max-width:60px"></a>
              <br>
              SV HTC 1 - SV HTC 2
            </div>
            <hr>
           <a class="twitter-timeline" data-lang="nl" data-width="320" data-height="420" data-theme="light" href="https://twitter.com/PBSZ?ref_src=twsrc%5Etfw">
            Tweets by PBSZ
          </a>
          <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div><!--/span-->
      </div><!--/row-->
  <hr>