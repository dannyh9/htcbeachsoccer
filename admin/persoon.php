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
if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $idquery = "SELECT * FROM persoon WHERE PersoonID = '$id'";
    $result = $conn->query($idquery);
    $row = mysqli_fetch_array($result);
    $voornaam=$row['Voornaam'];
    $tussenvoegsel=$row["Tussenvoegsel"];
    $achternaam=$row["Achternaam"];
    $email=$row["Email"];
    $functie=$row["Functie"];
} else {
  $voornaam="";
  $tussenvoegsel="";
  $achternaam="";
  $email="";
  $functie="";
  $id="";
}
?>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
<?php 
if($id == ""){
?>
  <form id="persoon-form" method="post" action="persoon.php" role="form"> 
    <?php
} else {
  ?>
  <form id="persoon-form" method="post" action="persoon.php?id=<?php echo $id; ?>" role="form"> 
    <?php
}
?>
<form id="persoon-form" method="post" action="persoon.php" role="form"> 
     <div class="form-group ">
      <label class="control-label " for="voornaam">
       Voornaam
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="voornaam" placeholder="Vul hier uw Voornaam in *" name="voornaam" type="text" value="<?php echo $voornaam; ?>"/>
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
      <input class="form-control" id="achternaam" placeholder="Vul hier uw Achternaam in *" name="achternaam" type="text" value="<?php echo $achternaam; ?>"/>
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
     <div class="form-group ">
      <label class="control-label " for="pasfoto">
        Upload pasfoto
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
      </div>
    </form>
   </div>
  </div>
 </div>
</div>

<?php 

if (isset($_POST['submit'])) {
  $voornaam=$_POST['voornaam'];
  $tussenvoegsel=$_POST['tussenvoegsel'];
  $achternaam=$_POST['achternaam'];
  $email=$_POST['email'];
  $functie=$_POST['functie'];

  if ($id == ""){
    $persoonquery = "INSERT INTO `persoon`(`voornaam`, `tussenvoegsel`, `achternaam`,  `email`, `functie`) VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$functie')";
    $conn->query($persoonquery);


  } else if ($id != ""){

  $updatequery = "UPDATE persoon SET Voornaam = '$voornaam', Tussenvoegsel = '$tussenvoegsel', Achternaam = '$achternaam', Email = '$email', Functie = '$functie' WHERE PersoonID = '$id'";
  $conn->query($updatequery);

  } else {

  }
}

?>