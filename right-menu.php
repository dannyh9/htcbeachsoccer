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
<?php
$date = new DateTime('yesterday');
$dateQuery = $date->format('Y-m-d H:i:s');

$thuisteamquery="SELECT * FROM wedstrijd WHERE Datum >= '$dateQuery' LIMIT 2";
$result=mysqli_query($conn, $thuisteamquery);
if ($result->num_rows === 0) {
}else{
 while($row = mysqli_fetch_array($result)) {
  ?>

  <div class="text-center boldtext" style="border:1px #164394 solid" >
    <?php
    $datum=$row['Datum'];
    $datum=strtotime($datum);
    $datum=date('d-m-Y H:i', $datum);
    $tijd=substr($datum, -5);
    $datumprint=substr($datum, 0, 10);
    print($datumprint);
    ?>
    <br>
    <?php
    print($tijd);
    ?>
    <br>
    <a> <img src="uploads/teamlogo/<?php if($row['Thuisteamlogo'] != NULL){echo($row['Thuisteamlogo']);} else{echo 'placeholder.png';}?>" style="max-width:60px"></a>
    - 
    <a> <img src="uploads/teamlogo/<?php if($row['Uitteamlogo'] != NULL){echo($row['Uitteamlogo']);} else{echo 'placeholder.png';}?>" style="max-width:60px"></a>
    <br><?php
    echo($row['Thuisteam']); echo(" - " . $row['Uitteam'] . "")?>
  </div>
  <br><br>
  <hr>
  <?php
  }
}
?>
<a class="twitter-timeline" data-lang="nl" data-width="320" data-height="420" data-theme="light" href="https://twitter.com/PBSZ?ref_src=twsrc%5Etfw">
  Tweets by PBSZ
</a>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div><!--/span-->
</div><!--/row-->
<hr>