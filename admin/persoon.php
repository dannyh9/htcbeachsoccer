<?php 
if(!isset($_SESSION['rollid'],$_SESSION['user']) && empty($_SESSION['rollid']) && empty($_SESSION['user'])) {
  exit;
}
?><?php
include '../databaseconnection.php';
?>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
</script>
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<link rel="stylesheet" type="text/css" href="../css/formulier.css">
<script src="../js/uploadknopscript.js"></script>
<style>
.form-group img {
    width: 50%;
    height: auto;
}
</style>
<?php 

function redirectoverview(){
  ?><script>window.location.replace("../admin/index.php?page=personen");</script><?php
}


if(isset($_GET["persoonid"])) {
  $id = mysqli_real_escape_string($conn,$_GET["persoonid"]);
  $idquery = "SELECT * FROM persoon WHERE PersoonID = '$id'";
  $result = $conn->query($idquery);
  $row = mysqli_fetch_array($result);
  $voornaam=$row['Voornaam'];
  $tussenvoegsel=$row["Tussenvoegsel"];
  $achternaam=$row["Achternaam"];
  $email=$row["Email"];
  $functie=$row["Functie"];
  $afbeelding=$row["Pasfoto"];
} else {
  $voornaam="";
  $tussenvoegsel="";
  $achternaam="";
  $email="";
  $functie="";
  $id="";
  $afbeelding="";
}

if (!$id == ""){
  $accountcheckquery = "SELECT * FROM authenticatie WHERE PersoonID = '$id'";
  $accountresult = $conn->query($accountcheckquery);
  $accrow = mysqli_fetch_array($accountresult);
  $gotacc = !isset($accrow);
}


?>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <?php 
    if($id == ""){
      ?>
      <form id="persoon-form" method="post" action="index.php?page=newpersoon" role="form" enctype="multipart/form-data"> 
        <?php
      } else {
        ?>
        <form id="persoon-form" method="post" action="index.php?persoonid=<?php echo $id; ?>" role="form" enctype="multipart/form-data"> 
          <?php
        }
        ?>
        <div class="form-group ">
          <label class="control-label " for="voornaam">
           Voornaam
           <span class="asteriskField">
            *
          </label>
          <input class="form-control" id="voornaam" placeholder="Vul hier uw Voornaam in *" name="voornaam" type="text" required value="<?php echo $voornaam; ?>"/>
        </div>
        <div class="form-group ">
          <label class="control-label " for="tussenvoegsel">
           Tussenvoegsel
           <span class="input-group-btn">
           </label>
           <input class="form-control" id="tussenvoegsel" placeholder="Vul hier een tussenvoegsel in " name="tussenvoegsel" type="text" value="<?php echo $tussenvoegsel; ?>"/>
         </div>
         <div class="form-group ">
          <label class="control-label " for="achternaam">
           Achternaam
           <span class="asteriskField">
            *
          </label>      
          <input class="form-control" id="achternaam" placeholder="Vul hier uw Achternaam in *" name="achternaam" type="text" required value="<?php echo $achternaam; ?>"/>
        </div>     
        <div class="form-group">     
          <div class="form-group">
            <label class="control-label " for="email">
             Email
             <span class="input-group-btn">
             </label>
             <input class="form-control" id="email" placeholder="Vul hier uw Email in" name="email" type="text" value="<?php echo $email; ?>"/>
           </div>
           <div class="form-group ">
            <label class="control-label " for="functie">
             Functie
             <span class="input-group-btn">
             </label>
             <input class="form-control" id="functie" name="functie" placeholder="Vul hier een functie in " type="text" value="<?php echo $functie; ?>"/>
           </div>
           <?php
      if($afbeelding != ""){
        ?>
          <div class="form-group ">
          <img src="../uploads/pasfoto/<?php echo $afbeelding; ?>">
          </div>
        <?php
      }
        ?>
           <div class="form-group ">

            <label class="control-label " for="pasfoto">
              Upload pasfoto
            </label>
            <div class="input-group">
              <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                  Zoeken… <input type="file" id="persoonimgInp" name="img">
                </span>
              </span>
              <input type="text" class="form-control" readonly>
            </div>
            <img id='img-upload'/>
            <div>
              <br>
              <div class="messages" style="font-size:30px" ></div>     
              <button class="btn btn-primary " name="submit" type="submit">
                Opslaan
              </button>
              <?php
              if(!empty($id)){?>
              <button class="btn btn-danger " onclick="return confirm('Weet u zeker dat u deze persoon en eventueel account wilt verwijderen?');" name="delete" type="submit">
                Verwijder
              </button>
              <?php
            }
            if(!$id == "" && $gotacc){
              ?>
              <a href="index.php?newaccid=<?php echo $id;?>" class="btn btn-warning " name="createaccount" type="submit">
                Maak account
              </a>
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

if (isset($_POST['submit'])){
  if (empty($_POST['voornaam']) || empty($_POST['achternaam'])){?>
  <script>
    $(".messages").text("Vul de verplichte velden in.");
  </script>
  <?php
}
else{
  $voornaam=mysqli_real_escape_string($conn,$_POST['voornaam']);
  $tussenvoegsel=mysqli_real_escape_string($conn,$_POST['tussenvoegsel']);
  $achternaam=mysqli_real_escape_string($conn,$_POST['achternaam']);
  $email=mysqli_real_escape_string($conn,$_POST['email']);
  $functie=mysqli_real_escape_string($conn,$_POST['functie']);

  if(!file_exists($_FILES['img']['tmp_name']) || !is_uploaded_file($_FILES['img']['tmp_name'])){

    if ($id == ""){
      $persoonquery = "INSERT INTO `persoon`(`voornaam`, `tussenvoegsel`, `achternaam`,  `email`, `functie`) VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$functie')";
      $conn->query($persoonquery);
      //redirectoverview();

    } else if ($id != ""){

      $updatequery = "UPDATE persoon SET Voornaam = '$voornaam', Tussenvoegsel = '$tussenvoegsel', Achternaam = '$achternaam', Email = '$email', Functie = '$functie' WHERE PersoonID = '$id'";
      $conn->query($updatequery);
      //redirectoverview();
    }
    //$nopasfotoquery="INSERT INTO `persoon`(`voornaam`, `tussenvoegsel`, `achternaam`,  `email`, `functie`) VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$functie')";
    //$conn->query($nopasfotoquery);

  } else { 
          //var_dump($id);
    $file = $_FILES['img'];
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
          $fileDestination = '../uploads/pasfoto/'.$fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);
          $pasfoto = $fileNameNew;
          if ($id == ""){
            $persoonquery = "INSERT INTO `persoon`(`Pasfoto`,`voornaam`, `tussenvoegsel`, `achternaam`,  `email`, `functie`) VALUES ('$pasfoto','$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$functie')";
            $conn->query($persoonquery);
            //redirectoverview();

          } else if ($id != ""){

            $updatequery = "UPDATE persoon SET Pasfoto = '$pasfoto', Voornaam = '$voornaam', Tussenvoegsel = '$tussenvoegsel', Achternaam = '$achternaam', Email = '$email', Functie = '$functie' WHERE PersoonID = '$id'";
            $conn->query($updatequery);
            //redirectoverview();
          }
        } else {
          echo "Your file is too big!";
        }
      } else {
        echo "There was an error uploading your file!";
      }
    } else {
      echo "You cannot upload files of this type!";
    }
  }

}
}
if(isset($_POST['delete'])){
  $deleteaccountquery = "DELETE FROM authenticatie WHERE PersoonID = '$id'";
  $deletepersoonquery = "DELETE FROM persoon WHERE PersoonID = '$id'";
  $conn->query($deleteaccountquery);
  $conn->query($deletepersoonquery);
  redirectoverview();
}
?> 