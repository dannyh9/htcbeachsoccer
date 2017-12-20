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
}
?>
<style>
img {
    width: 50%;
    height: auto;
}
</style>
<div class="container">

      <div class="row content row-offcanvas row-offcanvas-right">
        <div class="col-12 col-md-9">
            <h1>Sponsoren</h1>
          
          <?php
          if($result->num_rows > 0){ 
            while($row = mysqli_fetch_array($result)){ 
            	?>
            	<h2><?php echo $row['SponsorNaam']; ?></h2>
            	<br>
            	<p> 
            		<a href="<?php echo $row['SponsorLink']; ?>"><img class="img-fluid" alt="Fout bij het laden van de afbeelding" src="uploads/<?php echo $row['SponsorAfbeelding']; ?>"></a>
            	</p>
            	
            	<?php 
            }
          }
          ?>
          </div><!--/row-->


<?php
include 'right-menu.php';
include 'footer.php';
?>