<?php
include '../databaseconnection.php';
?>

<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<div align="center" style="padding-top: 10%">
	<form name="acccreate" method="post" action="" >
		<button class="btn btn-primary" name="submit" type="submit">
			Admin account maken
		</button>
	</form>

	<?php

	$admincheckquery = "SELECT * FROM authenticatie WHERE PersoonID = 1";
	$adminresult = $conn->query($admincheckquery);
	$adminrow = mysqli_fetch_array($adminresult);
	$gotadmin = !isset($adminrow);


	if(isset($_POST['submit']) && $gotadmin){

		$createrolquery = "INSERT INTO `authorisatie` (`RolID`, `Rolnaam`, `Rechten`) VALUES (NULL, 'Admin', '')";
		$createpersoonquery = "INSERT INTO `persoon` (`PersoonID`, `Pasfoto`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Email`, `Functie`) VALUES (NULL, NULL, 'Admin', NULL, 'Admin', NULL, NULL)";
		$createaccountquery = "INSERT INTO `authenticatie` (`Username`, `Password`, `RolID`, `PersoonID`) VALUES ('Admin', 'c1c224b03cd9bc7b6a86d77f5dace40191766c485cd55dc48caf9ac873335d6f', '1', '1')";

		$conn->query($createrolquery);
		$conn->query($createpersoonquery);
		$conn->query($createaccountquery);
	?>

		Gebruikersnaam: Admin
		<br>
		Wachtwoord: Admin

	<?php } elseif(isset($_POST['submit']) && !$gotadmin){?>

		<h2>Account bestaat al</h2>

	<?php } ?>
</div>