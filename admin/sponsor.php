<?php
include '../databaseconnection.php';
?>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  </script>
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<link rel="stylesheet" type="text/css" href="../css/formulier.css">
<script src="../js/uploadknopscript.js"></script>
<?php 

function redirectoverview(){
  ?><script>window.location.replace("../admin/index.php?page=sponsorenoverzicht");</script><?php
}



?>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
<?php 
if(isset($_GET["sponsor"])) {
    $id = $_GET["sponsor"];
    $idquery = "SELECT * FROM sponsor WHERE SponsorID = '$id'";
    $result = $conn->query($idquery);
    $row = mysqli_fetch_array($result);
    $sponsornaam=$row['SponsorNaam'];
    $afbeelding=$row["SponsorAfbeelding"];
    $link=$row["SponsorLink"];
} else {
  $sponsornaam="";
  $link="";
  $afbeelding ="";
  $id="";
}

 
if($id == ""){
?>
  <form id="persoon-form" method="post" action="index.php?page=newsponsor" role="form"> 
    <?php
} else {
  ?>
  <form id="persoon-form" method="post" action="index.php?sponsorid=<?php echo $id; ?>" role="form"> 
    <?php
}
?>
     <div class="form-group ">
      <label class="control-label " for="sponsornaam">
       Sponsornaam
      </label>
      <input class="form-control" id="sponsornaam" placeholder="Vul hier de sponsor naam in *" name="sponsornaam" type="text" value="<?php echo $sponsornaam; ?>"/>
     </div>
    <div class="form-group">
      <label class="control-label " for="sponsorlink">
           Sponsor-Link
      </label>
       <input class="form-control" id="link" placeholder="Vul hier de sponsor link in *" name="link" type="text" value="<?php echo $link; ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label " for="pasfoto">
        Upload sponsorafbeelding
      </label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Zoeken… <input type="file" id="persoonimgInp">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
        <img id='img-upload'/>
          <div>
            <br>
       <button class="btn btn-primary " name="submit" type="submit">
        Opslaan
       </button>
       <?php
       if($id != ""){
        ?>
         <button class="btn btn-danger " onclick="return confirm('Are you sure you want to delete?');" name="delete" type="submit">
        Verwijder
       </button>
        <?php
        }
        ?>
      </div>
    </form>
   </div>
  </div>
 </div>
</div>

<?php
if (isset($_POST['submit'])) {
  $naam=$_POST['sponsornaam'];
  $link=$_POST['link'];;
  $afbeelding="aap.jpg";

  if ($id == ""){
    $query = "INSERT INTO `sponsor`(`SponsorAfbeelding`, `SponsorLink`, `SponsorNaam`) VALUES ('$afbeelding', '$naam', '$link')";
    $conn->query($query);
    redirectoverview();
  } else if ($id != ""){
  $updatequery = "UPDATE persoon SET SponsorAfbeelding = '$afbeelding',  SponsorLink = '$link' , SponsorNaam = '$naam' WHERE SponsorID = '$id'";
  $conn->query($updatequery);
  redirectoverview();

   $file = $_FILES['file'];
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
         $fileDestination = '../uploads/'.$fileNameNew;
         move_uploaded_file($fileTmpName, $fileDestination);
         $nieuwsartikelquery = "INSERT INTO `nieuwsartikel`(`Titel`, `Inhoud`, `Username`,`Afbeelding`) VALUES ('$titel', $inhoud', '$username','$fileNameNew')";
         //var_dump($fileNameNew);
         //header("Location: index.php?uploadsuccess");
       } else {
         //echo "Your file is too big!";
       }
     } else {
       //echo "There was an error uploading your file!";
     }
   } else {
     //echo "You cannot upload files of this type!";
   }
   $conn->query($nieuwsartikelquery);

}}

if(isset($_POST['delete'])){
  //$deleteaccountquery = "DELETE FROM authenticatie WHERE PersoonID = '$id'";
  //$deletepersoonquery = "DELETE FROM persoon WHERE PersoonID = '$id'";
  //$conn->query($deleteaccountquery);
  //$conn->query($deletepersoonquery);
  //redirectoverview();
}
?>