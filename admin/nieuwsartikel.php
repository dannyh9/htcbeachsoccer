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

if(isset($_GET["nieuwsartikelid"])) {
    $id = $_GET["nieuwsartikelid"];
    $idquery = "SELECT * FROM nieuwsartikel WHERE ArtikelID = '$id'";
    $result = $conn->query($idquery);
    $row = mysqli_fetch_array($result);
    $titel=$row['Titel'];
    $inhoud=$row["Inhoud"];
} else {
  $titel="";
  $inhoud="";
  $id="";
}

?>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
<form id="nieuwsartikel-form" method="POST" action="nieuwsartikel.php" role="form" enctype="multipart/form-data"> 
     <div class="form-group ">
       <form id="nieuwsartikel-form" method="post" action="index.php?nieuwsartikelid=<?php echo $id; ?>" role="form"> 
      <label class="control-label " for="titel">
       Titel
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="titel" name="titel" type="text" placeholder="Vul hier de titel in *" value="<?php echo $titel; ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label " for="inhoud">
       Inhoud
         <span class="asteriskField">
        *
      </label>
      <textarea class="form-control tinymce" cols="40" id="inhoud" name="inhoud" rows="10""/> <?php echo $inhoud; ?> </textarea>
     </div>
     <div class="form-group">
          <div class="form-group">
        <label>
        Upload foto
      </label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Zoeken… <input type="file" id="imgInp" name="file">
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
    $username="Admin";

    $nieuwsartikelquery = "INSERT INTO `nieuwsartikel`(`Titel`, `Inhoud`, `Username`) VALUES ('$titel', '$inhoud', '$username')";
  
    //$conn->query($nieuwsartikelquery);

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
          $nieuwsartikelquery = "INSERT INTO `nieuwsartikel`(`Titel`, `Inhoud`, `Username`,`Afbeelding`) VALUES ('$titel', '$inhoud', '$username','$fileNameNew')";
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
}

?>
