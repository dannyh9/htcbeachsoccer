<?php
include '../databaseconnection.php';
?> 
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
 <style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<link rel="stylesheet" type="text/css" href="../css/formulier.css">
<script src="../js/uploadknopscript.js"></script>
<?php 
if(isset($_GET["teamid"])) {
    $id = $_GET["teamid"];
    $idquery = "SELECT * FROM team WHERE TeamID = '$id'";
    $result = $conn->query($idquery);
    $row = mysqli_fetch_array($result);
    $teamnaam=$row['Teamnaam'];
    $klasse=$row["Klasse"];
} else {
  $teamnaam="";
  $klasse="";
  $id="";
}
?>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form method="post">
     <div class="form-group ">
      <label class="control-label " for="teamnaam">
       Team naam
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="teamnaam" name="teamnaam" type="text" placeholder="Vul hier de teamnaam in *"/>
     </div>
     <div class="form-group ">
      <label class="control-label " for="klasse">
       Speelt Klasse
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="klasse" name="klasse" type="text" placeholder="Vul hier de klasse waarin het team speelt in *"/>
     </div>
          <div class="form-group">
          <div class="form-group">
        <label>
        Upload team foto
      </label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Zoeken… <input type="file" id="teamimgInp">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
        <img id='img-upload'/>
          <div>
            <br>
       <button class="btn btn-primary " name="submit" type="submit">
        Submit
       </button>
      </div>
    </form>
   </div>
  </div>
 </div>
</div>
<?php 
if (isset($_POST['submit'])){
$teamnaam=$_POST['teamnaam'];
$klasse=$_POST['klasse'];
$username="Kevin";
$teamquery = "INSERT INTO `team`(`teamnaam`, `klasse`) VALUES ('$teamnaam', '$klasse')";
$conn->query($teamquery);}

 if ($id == ""){
    $persoonquery = "INSERT INTO `team`(`teamnaam`, `klasse`) VALUES ('$teamnaam', '$klasse')";
    $conn->query($teamquery);


  } else if ($id != ""){

  $updatequery = "UPDATE team SET Teamnaam = '$teamnaam', Klasse = '$klasse' WHERE TeamID = '$id'";
  $conn->query($updatequery);

  } else {

  }
}
