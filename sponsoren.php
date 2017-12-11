<?php
include 'databaseconnection.php';
include 'header.php';
$query = "SELECT * FROM sponsor";

if ($conn->connect_errno) {
    $content = "Sorry,er kan geen database connectie worden aangemaakt";
}

if (!$result = $conn->query($query)) {
   $content = "Geen resultaat";
}

if ($result->num_rows === 0) {
    $content = "Geen Resultaten gevonden";
} if($result->num_rows > 0){ 
  $content="";
    while($row = mysqli_fetch_array($result)){ 
      $content .="<div class='mySlides'><a href='".$row['SponsorLink']."'>";
      $content .="<img src='./uploads/".$row['SponsorAfbeelding']."' style='height:200px;''>";
      $content .="</a></div>";
    }
}
?>
<div class="container">

      <div class="row content row-offcanvas row-offcanvas-right">
        <div class="col-12 col-md-9">
          <div class="jumbotron">
            <h1>Sponsoren</h1>
          </div>
          <div class="row">
          <?php
          if($result->num_rows > 0){ 
            while($row = mysqli_fetch_array($result)){ 
                        //var_dump($row);
                ?>
            <div class="col-6 col-lg-4">
              <h2><?php echo $row['Titel'];?></h2>

             <?php $small = substr($row['Inhoud'], 0, 150); $small .=".."; ?>
               <p><?php echo $small;?></p>              

               <p><a class="btn btn-secondary" href="nieuwsartikelen.php?id=<?php echo $row['ArtikelID'];?>" role="button">Lees verder.. &raquo</a></p>
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