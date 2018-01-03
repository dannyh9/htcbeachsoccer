<?php 
    if(!isset($_SESSION['rollid'],$_SESSION['user']) && empty($_SESSION['rollid']) && empty($_SESSION['user'])) {
        exit;
    }
?><!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/admin.css" rel="stylesheet">
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 menu ">
          <div class="nav-side-menu">
              <div class="brand">Welkom <?php echo $_SESSION['user'];?></div>
              <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            
                  <div class="menu-list">
                      <ul id="menu-content" class="menu-content collapse out">
                          <li>
                            <a class="wide" href="index.php">
                            <i class="fa fa-home fa-lg"></i> Home
                            </a>
                          </li>
                          <?php if($_SESSION['rollid'] == 1){ 

                          ?>
                          <li data-toggle="collapse" data-target="#Personen" class="collapsed">
                            <a class="wide" href="#"><i class="fa fa-address-book fa-lg"></i> Personen <span class="arrow"></span></a>
                          </li>  
                          <ul class="sub-menu collapse" id="Personen">
                            <li> 
                              <a href="?page=personen">Personen Beheren</a>
                            </li>
                            <li>
                              <a href="index.php?page=newpersoon">
                                Personen Aanmaken
                              </a>
                            </li>
                          </ul>
          
          
                          <li data-toggle="collapse" data-target="#Account" class="collapsed">
                            <a class="wide" href="#"><i class="fa fa-user-circle-o fa-lg"></i> Accounts <span class="arrow"></span></a>
                          </li>
                          <ul class="sub-menu collapse" id="Account">
                            <li> <a href="?page=accounts">Accounts Beheren </a></li>
                          </ul>

                          <?php  
                            }
                          ?>
                          <li data-toggle="collapse" data-target="#Nieuws" class="collapsed">
                            <a class="wide" href="#"><i class="fa fa-newspaper-o  fa-lg"></i> Nieuwsartikelen <span class="arrow"></span></a>
                          </li>
                          <ul class="sub-menu collapse" id="Nieuws">
                            <li> <a href="index.php?page=nieuwsoverzicht">Nieuwsartikelen Beheren</a></li>
                            <li> <a href="index.php?page=nieuwsartikelaanmaken">Nieuwsartikelen Aanmaken</a></li>
                          </ul>

                          <li data-toggle="collapse" data-target="#Media" class="collapsed">
                            <a class="wide" href="#"><i class="fa fa-picture-o fa-lg"></i> Sponsoren <span class="arrow"></span></a>
                          </li>
                          <ul class="sub-menu collapse" id="Media">
                            <li><a href="index.php?page=sponsorenoverzicht">Sponsoren overzicht</a></li>
                            <li><a href="index.php?page=newsponsor">Sponsor Aanmaken</a></li>
                          </ul>
          
                           <li>
                            <a class="wide" href="?page=contact">
                            <i class="fa fa-envelope fa-lg"></i> Verstuurde contact formulieren
                            </a>
                          </li>
                          <li data-toggle="collapse" data-target="#Wedstrijden" class="collapsed">
                             <a class="wide" href="#"><i class="fa fa-futbol-o fa-lg"></i> Wedstrijden <span class="arrow"></span></a>
                          </li>
                            <ul class="sub-menu collapse" id="Wedstrijden">
                            <li><a href="index.php?page=wedstrijd">Wedstrijden aanmaken</a></li>
                            <li><a href="index.php?page=wedstrijdoverzicht">Wedstrijdoverzicht</a></li>
                          </ul>

                          <li>
                            <a class="wide" href="loguitscript.php">
                            <i class="fa fa-sign-out fa-lg"></i> Uitloggen
                            </a>
                          </li>
                      </ul>
               </div>
          </div>
      </div>
      <div class="col-sm-9 content">
      <?php 
       if (isset($_GET['page'])) {
          $page = $_GET['page'];
          if ($page == "contact") {
              include 'contactoverzicht.php';
          }else if ($page == "personen") {
              include 'persoonoverzicht.php';
          }else if ($page == "newpersoon") {
              include 'persoon.php';
          }else if($page == "nieuwsoverzicht"){
              include 'nieuwsartikeloverzicht.php';
          }else if($page == "nieuwsartikelaanmaken"){
              include 'nieuwsartikel.php';
          }else if($page == "sponsorenoverzicht"){
              include 'sponsorenoverzicht.php';
          }else if($page == "newsponsor"){
              include 'sponsor.php';
          }else if($page == "wedstrijd"){
              include 'wedstrijd.php';
          }else if($page == "wedstrijdoverzicht"){
              include 'wedstrijdoverzicht.php';
          }else if($page == "accounts"){
              include 'accountoverzicht.php';
          }    else {
            echo "er is iets fout gegaan.";
          }
       } else if (isset($_GET['contactid'])) {
          include 'contactoverzicht.php';
       } else if (isset($_GET['persoonid'])) {
          include 'persoon.php';
       } else if (isset($_GET['nieuwsartikelid'])) {
          include 'nieuwsartikel.php';
       } else if (isset($_GET['sponsorid'])) {
          include 'sponsor.php';
       } else if(isset($_GET['newaccid'])) {
          include 'registratieform.php';
       }
       else { 
          //laad home pagina in
        ?>
         <h1>Welkom in het adminpaneel</h1>
            <p>
                Hier kunnen onderdelen worden aangemaakt voor de website.
            </p>
       <?php

       }
      ?>
                         
        </div>
      </div>
  </div>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="./bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="../bootstrap/dist/js/bootstrap.min.js"></script>
</body>    
</html>