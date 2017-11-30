<!DOCTYPE html>
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
          
                          <li  data-toggle="collapse" data-target="#products">
                            <a class="wide" href="#"><i class="fa fa-gift fa-lg"></i> UI Elements <span class="arrow"></span></a>
                          </li>
                          <ul class="sub-menu collapse" id="products">
                              <li class="active"><a href="#">CSS3 Animation</a></li>
                              <li><a href="#">General</a></li>
                          </ul>
          
          
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
                            <li>Accounts Beheren</li>
                            <li>Accounts Aanmaken</li>
                          </ul>


                          <li data-toggle="collapse" data-target="#Team" class="collapsed">
                            <a class="wide" href="#"><i class="fa fa-users fa-lg"></i> Teams <span class="arrow"></span></a>
                          </li>
                          <ul class="sub-menu collapse" id="Team">
                            <li>Teams Beheren</li>
                            <li>Team Aanmaken</li>
                          </ul>


                          <li data-toggle="collapse" data-target="#Nieuws" class="collapsed">
                            <a class="wide" href="#"><i class="fa fa-newspaper-o  fa-lg"></i> Nieuwsartikelen <span class="arrow"></span></a>
                          </li>
                          <ul class="sub-menu collapse" id="Nieuws">
                            <li>Nieuwsartikelen Beheren</li>
                            <li>Nieuwsartikelen Aanmaken</li>
                          </ul>
                          

                          <li data-toggle="collapse" data-target="#Media" class="collapsed">
                            <a class="wide" href="#"><i class="fa fa-picture-o fa-lg"></i> Media <span class="arrow"></span></a>
                          </li>
                          <ul class="sub-menu collapse" id="Media">
                            <li>Media Beheren</li>
                            <li>Media Uploaden</li>
                          </ul>
          
          
                           <li>
                            <a class="wide" href="#">
                            <i class="fa fa-user fa-lg"></i> Profile
                            </a>
                            </li>
          
                           <li>
                            <a class="wide" href="?page=contact">
                            <i class="fa fa-envelope fa-lg"></i> Verstuurde contact formulieren
                            </a>
                          </li>

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
          }  else {
            echo "er is iets fout gegaan.";
          }
       } else if (isset($_GET['contactid'])) {
          include 'contactoverzicht.php';
       } else if (isset($_GET['persoonid'])) {
          include 'persoon.php';
       }
       else { 
          //laad home pagina in
        ?>
         <h1>Welcome To Dashboard Panel</h1>
            <p>
                this  is test text.this  is test text.this  is test text.this  is test text.
                this  is test text.this  is test text.this  is test text.this  is test text.
                this  is test text.this  is test text.this  is test text.this  is test text.
                this  is test text.this  is test text.this  is test text.this  is test text.
                this  is test text.this  is test text.
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