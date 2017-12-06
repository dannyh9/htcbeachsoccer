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

              // Modify the date it contains
              $date->modify('next saturday');
              $date = $date->format('j F');
              echo("Zaterdag " . $date . "");
              $teamthuis=mysqli_query($conn, "SELECT `Thuisteam` FROM `wedstrijd` WHERE `Datum` IS $date");
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