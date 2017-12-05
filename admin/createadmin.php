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

	if(isset($_POST['submit'])){

		$createrolquery = "INSERT INTO `authorisatie` (`RolID`, `Rolnaam`, `Rechten`) VALUES (NULL, 'Admin', '')";
		$createpersoonquery = "INSERT INTO `persoon` (`PersoonID`, `Pasfoto`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Email`, `Functie`) VALUES (NULL, NULL, 'Admin', NULL, 'Admin', NULL, NULL)";
		$createaccountquery = "INSERT INTO `authenticatie` (`Username`, `Password`, `RolID`, `PersoonID`) VALUES ('Admin', 'e3afed0047b08059d0fada10f400c1e5', '1', '1')";

		$conn->query($createrolquery);
		$conn->query($createpersoonquery);
		$conn->query($createaccountquery);
	?>

		Gebruikersnaam: Admin
		<br>
		Wachtwoord: Admin

	<?php } ?>
</div>