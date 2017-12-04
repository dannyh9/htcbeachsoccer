<?php 
include 'header.php';
include 'databaseconnection.php';

if(isset($_GET['id'])&& !empty($_GET['id'])) {
	//laat specifiek nieuwsartikel zien
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$queryartikel="SELECT * FROM nieuwsartikel WHERE ArtikelID = '$id'";

		if ($conn->connect_errno) {
		    echo "Sorry, this website is experiencing problems.";
		    exit;
		}
		
		if (!$result = $conn->query($queryartikel)) {
		    echo "geen resultaat";
		}
			?>
			 <div class="container">
		
		      <div class="row content row-offcanvas row-offcanvas-right">
		        <div class="col-12 col-md-9">
		        		<?php
		        		if ($result->num_rows === 0) {
		        		    echo "Geen Resultaat gevonden";
		        		} else {
		        			while($row = mysqli_fetch_array($result)){ 
		        				$user = $row['Username'];
		        				$querypersoonid = "SELECT PersoonID FROM authenticatie WHERE Username = '$user'";
		
		        				$result2 = $conn->query($querypersoonid);
		        				$row2 = mysqli_fetch_array($result2);
		        				$persoonid = $row2['PersoonID'];
		        				$persoonidquery = "SELECT Voornaam ,Achternaam FROM Persoon WHERE PersoonID = '$persoonid'";
		
		        				$result3 = $conn->query($persoonidquery);
		        				$row3 = mysqli_fetch_array($result3);
		        				$voornaam = $row3['Voornaam'];
		        				$achternaam = $row3['Achternaam'];
		        				?>
		        					<h1><?php echo $row["Titel"]?></h1>
		        					<?php echo $row["Inhoud"]?>
		        					<?php //afbeelding ?>
		
		
		        					<p>
		        						<?php echo "Geplaatst door: ".$voornaam." ".$achternaam."</br>"  ?>
		        						<?php echo "Om: ".$row['Datum']."</br>"  ?>
		        					</p>
		        					
		        				<?php
		        			}
		        		}
		        		?>
		        </div><!--/row-->
		
			<?php
		
		

} else {
//laat overzicht zien
	$nieuwsoverzichtquery = "SELECT * FROM nieuwsartikel ORDER BY ArtikelID DESC";

		if ($conn->connect_errno) {
		    echo "Sorry, this website is experiencing problems.";
		    exit;
		}
		
		if (!$result = $conn->query($nieuwsoverzichtquery)) {
		    echo "Geen resultaat";
		    exit;
		}
		if ($result->num_rows === 0) {
		    echo "Geen Resultaten gevonden";
		    exit;
		}
		?>
		  <div class="container">
		
		      <div class="row content row-offcanvas row-offcanvas-right">
		        <div class="col-12 col-md-9">
		          <p class="float-right hidden-md-up">
		            <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Toggle nav</button>
		          </p>
		          <div class="row">
		          <?php
		          if($result->num_rows > 0){ 
		            while($row = mysqli_fetch_array($result)){ 
		                        //var_dump($row);
		                ?>
		            <div class="col-6 col-lg-4">
		              <h2><?php echo $row['Titel'];?></h2>
		             <?php 
		            	$small = substr($row['Inhoud'], 0, 150); 
		             	$small .=".."; 
		             ?>
		               <p><?php echo $small;?></p>              
		
		               <p><a class="btn btn-secondary" href="nieuwsartikelen.php?id=<?php echo $row['ArtikelID'];?>" role="button">Lees verder..</a></p>
		            </div>
		           <?php          
		            }
		          }
		          ?>
		          </div><!--/row-->
		        </div><!--/span-->
<?php 
}
include 'right-menu.php';
include 'footer.php';
?>