<?php
include 'databaseconnection.php';
include 'header.php';
?>
<div class="container">

      <div class="row content row-offcanvas row-offcanvas-right">
        <div class="col-12 col-md-9">
            <h1>Wedstrijduitslagen</h1>
            <h2>Eredivsie Mannen</h2>
            <p>
            	<div class="embed-responsive embed-responsive-16by9">
  					<iframe class="embed-responsive-item" src="http://beachsoccerbond.nl/eredivisie-mannen/" allowfullscreen></iframe>
				</div>
            </p>
            <h2>Eredivisie Vrouwen</h2>
            <div class="embed-responsive embed-responsive-16by9">
  					<iframe class="embed-responsive-item" src="http://beachsoccerbond.nl/eredivisie-vrouwen/" allowfullscreen></iframe>
			</div>
         </div><!--/row-->


<?php
include 'right-menu.php';
include 'footer.php';
?>