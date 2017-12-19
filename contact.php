<?php 
session_start();
include 'header.php';
include 'databaseconnection.php';
?>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">

    <div class="row content">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Contactformulier</a></h1>
            <form id="contact-form" method="post" action="contact.php" role="form">	

                <div class="messages" style="font-size:30px"></div>

                <div class="controls">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Voornaam*</label>
                                <input id="form_name" type="text" name="voornaam" class="form-control" placeholder="Vul hier uw voornaam in *" value="<?php if(isset($_POST['voornaam'])) echo $_POST['voornaam']?>" required="required" data-error="Vul uw voornaam in.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_lastname">Achternaam*</label>
                                <input id="form_lastname" type="text" name="achternaam" class="form-control" value="<?php if(isset($_POST['achternaam'])) echo $_POST['achternaam']?>" placeholder="Vul hier uw achternaam in *" required="required" data-error="Vul uw achternaam in.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_email">E-mail*</label>
                                <input id="form_email" type="email" name="email" class="form-control" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>" placeholder="Vul hier uw emailadres in. *" required="required" data-error="Vul een geldig emailadres in.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_phone">Telefoonnummer</label>
                                <input id="form_phone" type="tel" name="telefoonnummer" class="form-control" value="<?php if(isset($_POST['telefoonnummer']))echo $_POST['telefoonnummer']?>" placeholder="Vul hier uw telefoonnummer in. ">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form_message">Bericht*</label>
                                <textarea id="form_message" name="bericht" class="form-control" value="<?php if(isset($_POST['bericht']))echo $_POST['bericht']?>" placeholder="Vul hier uw bericht in *" rows="4" required="required" data-error="Vul uw bericht in."></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                     <div class="g-recaptcha" data-sitekey="6LcxpDkUAAAAAB4tNZF46kkKJfK850_fu9fXCQt4" data-callback="recaptchaCallback"></div>
                     
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="msg">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" class="btn btn-success btn-send" value="Verzenden" disabled>
            </div>

            
            <script>
                $( document ).ready(function() {

                    $(".msg").text("Vul eerst de reCAPTCHA in.");

                    
                });
                function recaptchaCallback() {
                    $('#submit').removeAttr('disabled'); 
                    $(".msg").empty();
                };

            </script>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-muted"><strong>*</strong> Deze velden zijn verplicht.</p>
                </div>
            </div>
            
        </form>
        <?php
        if(isset ($_POST['submit'])){
            if (empty($_POST['email']) || empty($_POST['voornaam']) || empty($_POST['achternaam'])) {?>
            <script>
                $(".messages").text("Vul alle verplichte velden in.");
            </script>
            <?php
            exit();
        }    
        $from=mysqli_escape_string($conn,$_POST['email']);
        $voornaam=mysqli_escape_string($conn,$_POST['voornaam']);
        $achternaam=mysqli_escape_string($conn,$_POST['achternaam']);
        $name="". $voornaam ." " . $achternaam .""; 
        $phone=mysqli_real_escape_string($conn,$_POST['telefoonnummer']);
        $sendto="kevinhendriks69@gmail.com";
        $message=$_POST['bericht'];
        $message= str_replace("\n.", "\n..", $message);
        $message= wordwrap($message, 70, "\r\n");
        $subject="Nieuw ingevuld contactformulier.";
        $headers= "Antwoord naar: " . $from . "\r\n";
        $headers .= "From: " . $from ."\r\n";
        $headers .= "Telefoonnummer: " . $phone . "\r\n";
        $headersfrom="";    
        // anti-flood protection
        if (!empty($_SESSION['antiflood'])){
            $seconde = 30; // 30 seconds delay
            $tijd = time() - $_SESSION['antiflood'];
            if($tijd < $seconde){
              $antiflood = 1;
          }}
          $antiflood = 0;
          if ($antiflood == "") {
            $_SESSION['antiflood'] = time();
            @mail($from, "Uw bericht is verzonden.", $message, $headersfrom);
            @mail($sendto, $subject, $message, $headers);
            $contactquery = "INSERT INTO `contactformulier`(`Email`, `Naam`, `Telefoonnummer`, `Bericht`) VALUES ('$from','$name','$phone','$message')";
            $conn->query($contactquery);
            ?>
            <script>
                $(".messages").text("Uw formulier is verzonden.");
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
              $(".messages").text("U kunt eens per 30 seconden een bericht verzenden.");
          </script>
          <?php
          
      }}
      ?>
      <h1>Locatie sportpark</h1>
      <iframe width="600" height="450" frameborder="1" style="border:1px" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ97Cj2G3fx0cRMNe9e9fgA8c&key=AIzaSyAu2l6wZ8WZLlAMndmCn-J0XVU8NWPqfxM" allowfullscreen>
      </iframe>
      <p>Sportpark De Pelikaan<br>
        Haersterveerweg 2<br>
        8034 PK Zwolle<br>
    </p>

</div>
<?php 
include 'right-menu.php';
include 'footer.php';
?>