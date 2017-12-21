<?php
include('databaseconnection.php');
$query = "SELECT * FROM sponsor";

if ($conn->connect_errno) {
    $content = "Sorry,er kan geen database connectie worden aangemaakt";
}

if (!$result = $conn->query($query)) {
   $content = "Geen resultaat";
}

if ($result->num_rows === 0) {
    $content = "Geen sponsoren toegevoegd";
} if($result->num_rows > 0){ 
  $content="";
    while($row = mysqli_fetch_array($result)){ 
      $content .="<div class='mySlides'><a href='".$row['SponsorLink']."'>";
      $content .="<img src='./uploads/".$row['SponsorAfbeelding']."' style='height:200px;''>";
      $content .="</a></div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>HTC Beachsoccer</title>

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this project -->
    <link href="./css/style.css" rel="stylesheet">
  </head>
  <body>
    <style>
.mySlides {
  display:none;
}
.mySlides img {
    max-width: 100%;
    max-height: 200px;
}
</style>
    <div id="fb-root"></div>
<script>
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=556845947780553';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
  <div class="col-12">
    <div class="top-nav row"> 
      <div id="logo" class="col-md-3"> 
        <a class="navbar-brand" href="#">
          <img src="./img/svhtc.png">
        </a>
      </div>
      <div id="sponsors" class="col-md-4">
        <div class="w3-content" style="max-width:400px">
          <?php echo $content; ?>
        </div>
          
      </div>
      <div id="img" class="col-md-5">
        <img height="200" src="./img/beachsoccer.jpg">
      </div>

    </div>
  </div>

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="media.php">Media</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="wedstrijduitslagen.php">Wedstrijduitslagen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="nieuwsartikelen.php">Nieuwsartikelen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sponsoren.php">Sponsoren</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </nav>
<script type="text/javascript">
  
  var slideIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
    x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel, 3000); 
}
</script>
    
