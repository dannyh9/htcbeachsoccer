<?php 
include 'header.php';
include 'databaseconnection.php';

if(isset($_GET['id'])&& !empty($_GET['id'])) {
	//laat specifiek nieuwsartikel zien
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$queryartikel="SELECT * FROM nieuwsartikel WHERE ArtikelID = '$id'";


	?>
	 <div class="container">

      <div class="row content row-offcanvas row-offcanvas-right">
        <div class="col-12 col-md-9">

        	<?php ?>
          </div><!--/row-->
        </div><!--/span-->

	<?php



} else {
//laat overzicht zien
	$queryoverzicht="SELECT * FROM nieuwsartikel";
}

?>

<?php 
include 'right-menu.php';
include 'footer.php';
?>
 

