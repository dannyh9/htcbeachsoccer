<?php 
if(!isset($_SESSION['rollid'],$_SESSION['user']) && empty($_SESSION['rollid']) && empty($_SESSION['user'])) {
	exit;
}
?>
<?php
include '../databaseconnection.php';
?>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
</script>
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<link rel="stylesheet" type="text/css" href="../css/formulier.css">
<script src="../js/uploadknopscript.js"></script>

<?php
$status = "";
function redirectoverview($status){
	$reloc = "../admin/index.php?page=personen";
	?><script>window.location.replace("../admin/index.php?page=accounts<?php echo $status; ?>");</script><?php
}


if(isset($_GET["accid"])){
	$id = $_GET["accid"];
	$accountcheckquery = "SELECT * FROM authenticatie A JOIN authorisatie U ON A.RolID = U.RolID WHERE A.Username = '$id'";
	$persooncheckquery = "SELECT * FROM persoon WHERE PersoonID = '$id'";
	$accountresult = $conn->query($accountcheckquery);
	$persoonresult = $conn->query($persooncheckquery);
	$accrow = mysqli_fetch_array($accountresult);
	var_dump($accrow);
	$persrow = mysqli_fetch_array($persoonresult);
	$gotacc = isset($accrow);
	$gotpers = isset($persrow);
	if(!$gotacc){
		redirectoverview("&redcode=error1");
		exit;
	}
	// if(!$gotpers){
	// 	redirectoverview("&redcode=error2");
	// 	exit;
	// }
} else {
	// redirectoverview("&redcode=error3");
}

$authorisatiequery = "SELECT * FROM authorisatie";
$authorresult = $conn->query($authorisatiequery);



if(isset($_GET["redcode"])){
	$code = $_GET["redcode"];
} else {
	$code = "";
}


if($code == "error1"){ ?>

<br>
<div class="alert alert-danger">
	Gebruikersnaam en/of wachtwoord niet ingevuld!
</div>

<?php 
} elseif($code == "error2"){
	?>
	<br>
	<div class="alert alert-danger">
		Gebruikersnaam bestaat al!
	</div>
	<?php
}
?>


<div class="bootstrap-iso">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php 
				if(isset($_GET['newaccid'])){
					?>
					<form id="registratieform" method="post" action="index.php?newaccid=<?php echo $_GET['newaccid'];?>" role="form"> 
						<?php
					} else {
						?>
						<form id="registratieform" method="post" action="index.php?page=newacc" role="form"> 
							<?php
						}

						?>

						<div class="form-group ">
							<label class="control-label " for="username">
								Gebruikersnaam
								<span class="asteriskField">
									*
								</label>
								<input class="form-control" id="username" placeholder="Vul hier uw gebruikersnaam in *" name="username" type="text" value="" />
							</div>

							<div class="form-group ">
								<label class="control-label " for="password">
									Wachtwoord
									<span class="asteriskField">
										*
									</label>
									<input class="form-control" id="password" placeholder="Vul hier uw wachtwoord in *" name="password" type="password" />
								</div>
								<label for="PersoonID">Selecteer rol</label>
								<select class="form-control" id="persoonid" name="rollid">
									<?php while($authorrow = mysqli_fetch_array($authorresult)){?>
									<option value=<?php echo $authorrow["RolID"] ?>><?php echo $authorrow["Rolnaam"] ?></option>
									<?php } ?>
								</select>
								<br>
								<?php print_r($authorrow); ?>
								<button class="btn btn-primary " name="registreren" type="submit">
									Registreer
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="./bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="../bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="./js/script.js"></script> 
	</body>
	</html>

	<?php


	$check = TRUE;


	if (isset($_POST["registreren"])) {

		$username = mysqli_real_escape_string($conn, $_POST['username']);

		$accountcheckquery = "SELECT * FROM authenticatie WHERE username = '$username'";
		$accountresult = $conn->query($accountcheckquery);
		$accountrow = mysqli_num_rows($accountresult);
		if($accountrow > 0) {
        	// account gevonden.
        	$check = false;
        	// error maken.
        }


		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['rollid'])) { ?>
		<script>window.location.replace("../admin/index.php?newaccid=<?php echo $id; ?>&redcode=error1");</script>
		<?php } elseif(!$check){
			?><script>window.location.replace("../admin/index.php?newaccid=<?php echo $id; ?>&redcode=error2");</script><?php
		} else {
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$rollid = mysqli_real_escape_string($conn, $_POST['rollid']);
			$persoonID = mysqli_real_escape_string($conn, $_GET['newaccid']);
			// Hashing the password
			$hashedPwd = hash("sha256", $password);

			$newaccquery = "INSERT INTO `authenticatie` (`Username`, `Password`, `RolID`, `PersoonID`) VALUES ('$username', '$hashedPwd', '$rollid', '$persoonID')";

			$conn->query($newaccquery);

			redirectoverview("&redcode=succes1");	



		}

	} 

	?>