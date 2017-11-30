<?php
include '../databaseconnection.php';
?> 
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
 <script src="../tinymce/plugin/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '.tinymce',
    language: 'nl'
  });
  </script>
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<link rel="stylesheet" type="text/css" href="../css/formulier.css">
<script src="../js/uploadknopscript.js"></script>
<?php 
if(isset($_GET["id"])) {
$id = $_GET["id"];
var_dump($id);
$idquery = "SELECT * FROM nieuwsartikel WHERE NieuwsartikelID = '$id'";
$result = $conn->query($idquery);
var_dump($result);
$row = mysqli_fetch_array($result);
var_dump($row);
print_r($row);
$titel=$row['Titel'];
} else {
  $titel="";
}
?>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
<form id="nieuwsartikel-form" method="post" action="nieuwsartikel.php" role="form"> 
     <div class="form-group ">
      <label class="control-label " for="titel">
       Titel
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="titel" name="titel" type="text" placeholder="Vul hier de titel in *"/>
     </div>
     <div class="form-group ">
      <label class="control-label " for="inhoud">
       Inhoud
         <span class="asteriskField">
        *
      </label>
      <textarea class="form-control tinymce" cols="40" id="inhoud" name="inhoud" rows="10" ></textarea>
     </div>
     <div class="form-group">
          <div class="form-group">
        <label>
        Upload foto
      </label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Zoeken… <input type="file" id="imgInp">
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
$titel=$_POST['titel'];
$inhoud=$_POST['inhoud'];
$username="Kevin";
$nieuwsartikelquery = "INSERT INTO `nieuwsartikel`(`Titel`, `Inhoud`, `Username`) VALUES ('$titel', '$inhoud', '$username')";
$conn->query($nieuwsartikelquery);}
?>
