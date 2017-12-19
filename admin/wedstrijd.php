<?php
include '../databaseconnection.php';
?> 
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<link rel="stylesheet" type="text/css" href="../css/formulier.css">

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<link rel="stylesheet" type="text/css" href="../css/formulier.css">
<script src="../js/uploadknopscript.js"></script>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-6">
    <form id="wedstrijd-form" method="POST" action="?page=wedstrijd" role="form" enctype="multipart/form-data"> 
     <div class="form-group"> 
      <label class="control-label " for="thuisteam">
       Thuisteam
       <span class="asteriskField">
        *
      </span>
      </label>
      <input class="form-control" id="thuisteam" name="thuisteam" type="text" value=""/>
    </div>
    <div class="form-group"> 
      <label class="control-label " for="thuisteam">Teamlogo thuisteam</label>
      <div class="input-group">
        <span class="input-group-btn">
          <span class="btn btn-default btn-file">
            Zoeken… <input type="file" id="imgInp" name="logothuis">
          </span>
        </span>
        <input type="text" class="form-control" readonly>
      </div>
    </div>
      <div class="form-group">
        <label class="control-label " for="uitteam">
         Uitteam
         <span class="asteriskField">
          *
          </span>
        </label>
        <input class="form-control" id="uitteam" name="uitteam" type="text" placeholder="Vul hier de titel in *"/>
      </div>
      <div class="form-group"> 
      <label class="control-label " for="thuisteam">Teamlogo uitteam</label>
      <div class="input-group">
        <span class="input-group-btn">
          <span class="btn btn-default btn-file">
            Zoeken… <input type="file" id="imgInp" name="logouit">
          </span>
        </span>
        <input type="text" class="form-control" readonly>
      </div>
    </div>
        
        <div class="form-group ">
          <label class="control-label" for="datum">
            Datum wedstrijd (Datum en tijd):
          </label>
          <span class="asteriskField">
            *
            <input type="datetime-local" id="datum" name="datum">
          </div>
          <div class="messages" style="font-size:20px"></div>
          <button class="btn btn-primary " name="submit" type="submit">
            Opslaan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<?php

if(isset($_POST['submit'])){
    //var_dump($_POST);
     if(empty($_POST['thuisteam']) || empty($_POST['uitteam'])){
        ?>
               <script>
              $(".messages").text("U heeft een verplicht veld niet ingevuld.");
            </script>
    <?php
    } else {
      $id = "";
      $thuisteam=mysqli_escape_string($conn, $_POST['thuisteam']);
      $uitteam=mysqli_escape_string($conn, $_POST['uitteam']);
      $datum=mysqli_escape_string($conn, $_POST['datum']);
      $datum=str_replace("T", " ", $datum);
      $datum=str_replace('/', '-', $datum);
      $datum=strtotime($datum);
      $datumquery=date('Y-m-d H:i', $datum);
      $datumhuidig = new DateTime();
      $datumhuidig = $datumhuidig->format('Y-m-d H:i');
      var_dump($datumhuidig , $datumquery);
      if($datumquery > $datumhuidig){
          //$wedstrijdquery="INSERT INTO `wedstrijd`(`Datum`, `Thuisteam`, `Uitteam`) VALUES ('$datumquery', '$thuisteam', '$uitteam')";
          //$conn->query($wedstrijdquery);

       if(!file_exists($_FILES['logothuis']['tmp_name']) || !is_uploaded_file($_FILES['logothuis']['tmp_name']) && !file_exists($_FILES['logouit']['tmp_name']) || !is_uploaded_file($_FILES['logouit']['tmp_name'] )) {

            $wedstrijdquery="INSERT INTO `wedstrijd`(`Datum`, `Thuisteam`, `Uitteam`) VALUES ('$datumquery', '$thuisteam', '$uitteam')";
            //var_dump($_FILES);
            //$conn->query($wedstrijdquery);
          ?>
          <script>$(".messages").text("De ingevulde wedstrijd is toegevoegd.");</script>
          <?php
        } else { 
          //var_dump($id);
            $file = $_FILES['logothuis'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
       
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
       
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
             
            if (in_array($fileActualExt, $allowed)) {
              if ($fileError === 0) {
                if ($fileSize < 1000000) {
                  $fileNameNew = uniqid('', true).".".$fileActualExt;
                  $fileDestination = '../uploads/teamlogo/'.$fileNameNew;
                  move_uploaded_file($fileTmpName, $fileDestination);
                  $thuislogonaam = $fileNameNew;
                } else {
                  echo "Your file is too big!";
                }
              } else {
                echo "There was an error uploading your file!";
              }
            } else {
              echo "You cannot upload files of this type!";
            }

            $file = $_FILES['logouit'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
       
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
             
            if (in_array($fileActualExt, $allowed)) {
              if ($fileError === 0) {
                if ($fileSize < 1000000) {
                  $fileNameNew = uniqid('', true).".".$fileActualExt;
                  $fileDestination = '../uploads/teamlogo/'.$fileNameNew;
                  move_uploaded_file($fileTmpName, $fileDestination);
                  $uitlogonaam = $fileNameNew;
                } else {
                  echo "Your file is too big!";
                }
              } else {
                echo "There was an error uploading your file!";
              }
            } else {
              echo "You cannot upload files of this type!";
            }
            if(!empty($thuislogonaam) && !empty($uitlogonaam)){
              $wedstrijdquery = "INSERT INTO `wedstrijd`(`Datum`, `Thuisteam`, `Uitteam`,`Thuisteamlogo`, `Uitteamlogo`) VALUES ('$datumquery', '$thuisteam', '$uitteam' , '$thuislogonaam' , '$uitlogonaam')";
              $conn->query($wedstrijdquery);
              ?><script>$(".messages").text("De ingevulde wedstrijd is toegevoegd.");</script><?php
            } else {
              ?><script>$(".messages").text("Er is iets fout gegaan probeer het opnieuw!");</script><?php
            }
          }
          }else{
          ?>
        <script>
          $(".messages").text("De ingevoerde is voor de huidige datum , voer een geldige datum in.");
      </script>
      <?php }
    }
}
?>