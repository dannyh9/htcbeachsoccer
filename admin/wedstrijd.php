<?php
include '../databaseconnection.php';
?> 
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<link rel="stylesheet" type="text/css" href="../css/formulier.css">
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-6">
<form id="wedstrijd-form" method="POST" action="wedstrijd.php" role="form" enctype="multipart/form-data"> 
     <div class="form-group "> 
      <label class="control-label " for="thuisteam">
       Thuisteam
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="thuisteam" name="thuisteam" type="text" placeholder="Vul hier de titel in *"/>
     </div>
          <div class="form-group ">
      <label class="control-label " for="thuisteam">
       Uitteam
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="uitteam" name="uitteam" type="text" placeholder="Vul hier de titel in *"/>
 <div class="form-group ">
    <label class="control-label" for="datum">
            Datum wedstrijd (Datum en tijd):
    </label>
        <span class="asteriskField">
            *
  <input type="datetime-local" id="datum" name="datum">
</div>
       <button class="btn btn-primary " name="submit" type="submit">
        Opslaan
       </button>
         <div class="messages" style="font-size:30px"></div>
      </div>
    </form>
   </div>
  </div>
 </div>
</div>
<?php 
if (isset($_POST['submit'])){
    if(empty($_POST['thuisteam']) || empty($_POST['uitteam'])){
        ?>
               <script>
              $(".messages").text("U heeft een verplicht veld niet ingevuld.");
            </script>
<?php
exit;
}
    $thuisteam=mysqli_escape_string($conn, $_POST['thuisteam']);
    $uitteam=mysqli_escape_string($conn, $_POST['uitteam']);
    $datum=mysqli_escape_string($conn, $_POST['datum']);
    $datum=str_replace("T", " ", $datum);
    $datum=str_replace('/', '-', $datum);
    $datum=strtotime($datum);
    $datumquery=date('Y-m-d H:i', $datum);
    var_dump($datumquery);
    $wedstrijdquery="INSERT INTO `wedstrijd`(`Datum`, `Thuisteam`, `Uitteam`) VALUES ('$datumquery', '$thuisteam', '$uitteam')";
    $conn->query($wedstrijdquery);
}

?>