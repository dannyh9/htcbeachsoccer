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
              $date = new DateTime('yesterday');
              $datePrint = $date->format('Y-m-d H:i:s');
              print($datePrint);
              //$date=strtotime($date);
        //        list($day,$month,$year) = explode("/",date('d/m/Y/'));
          //      echo $month.'/'.$day.'/'.$year.'';
            //    $dateString= $month. '-' .$day.'';
              // Check if current day is not saturday
               // if($date("l")!="saturday"){
                //$date->modify('next saturday');
              //}
  //            echo("Zaterdag " . $datePrint . "");
    //          //$date=strtolower($date);
      //        var_dump($dateString);
              $thuisteamquery="SELECT * FROM wedstrijd WHERE Datum >= '$datePrint' LIMIT 2";
              $result=mysqli_query($conn, $thuisteamquery);
              ?>
              <br>
              12:00 uur
              <br>
              <?php
                if($row['Thuisteamlogo'] != NULL){
              ?>
              <a> <img src="./uploads/<?php echo $row['Thuisteamlogo'];?>" style="max-width:60px"></a>
              <?php
                }
              ?>
               - 
              <a> <img src="./img/svhtc.png" style="max-width:60px"></a>
              <br><?php
              $row=mysqli_fetch_array($result);
              var_dump($row);
              exit;
              echo($result); echo(" - uitteam")?>
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