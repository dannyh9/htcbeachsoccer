<?php 
include 'header.php';
include 'databaseconnection.php';

$nieuwsoverzichtquery = "SELECT * FROM nieuwsartikel ORDER BY ArtikelID DESC LIMIT 6";

if ($conn->connect_errno) {
    echo "Sorry, this website is experiencing problems.";
    exit;
}

if (!$result = $conn->query($nieuwsoverzichtquery)) {
    echo "Geen resultaat";
    exit;
}
?>
  <div class="container">

      <div class="row content row-offcanvas row-offcanvas-right">
        <div class="col-12 col-md-9">
          <p class="float-right hidden-md-up">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>HTC Beachsoccer</h1>
            <p>Wij zijn HTC beachsoccer en wij spelen beachsoccer op het hoogst haalbare niveau. Onze doelstelling hierin is om leidend te zijn in beachsoccer rondom regio zwolle.</p>
          </div>
          <div class="row">
          <?php
          if ($result->num_rows === 0) {
              echo "Geen nieuwsartikelen gevonden";
          }
          if($result->num_rows > 0){ 
            while($row = mysqli_fetch_array($result)){ 
                        //var_dump($row);
                ?>
            <div class="col-6 col-lg-4">
              <h2><?php echo $row['Titel'];?></h2>

             <?php $small = substr($row['Inhoud'], 0, 150); $small .=".."; ?>
               <p><?php echo $small;?></p>              

               <p><a class="btn btn-secondary" href="nieuwsartikelen.php?id=<?php echo $row['ArtikelID'];?>" role="button">Lees verder.. &raquo;</a></p>
            </div>
           <?php          
            }
          }
          ?>
          </div><!--/row-->
        </div><!--/span-->

<?php 
include 'right-menu.php';
include 'footer.php';
?>
 