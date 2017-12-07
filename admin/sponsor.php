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
  ?><script>window.location.replace("../admin/index.php?page=sponsor");</script><?php
}



?>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
<?php 
  $sponsornaam="";

  $link="";
  $functie="";
  $id="";
if($id == ""){
?>
  <form id="persoon-form" method="post" action="index.php?page=newpersoon" role="form"> 
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
