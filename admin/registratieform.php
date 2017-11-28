<?php
include '../databaseconnection.php';

?>

<!DOCTYPE html>
<html>
<head>    
	<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/style.css" rel="stylesheet">
	<title>  Registreren </title>
</head>
<body>

	<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->

<div class="container">
    <div class="row vertical-offset-100">
    	<div class ="row horizontal-offset-100"></div>
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Registreren</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="POST" action="registratieform.php" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Username" name="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
			    		<div class="form-group">
			    		    <input class="form-control" placeholder="RollID" name="rollid" type="number">
			    		
			    	    	
			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" name="registreren" type="submit" value="Registreer">
			    	</fieldset>
			      	</form>
			    </div>
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

if (isset($_POST['registreren'])) {

	include '../databaseconnection.php';

	$username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $rollid = mysqli_real_escape_string($conn, $_POST['rollid']);

	//Error handlers
	//Check for empty fields
	if (empty($username) || empty($password) || empty($rollid)) {
		header("Location: registratieform.php?signup=empty");
		exit();
	}
	else {
						//Hashing the password
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
						//Insert the user into the database
						$sql = "INSERT INTO authenticatie VALUES (authenticatie_Username, authenticatie_Password, authenticatie_RollID)
						VALUES ('?', '?', '?');";
						//Create second prepared statement
						$stmt2 = mysqli_stmt_init($conn);

						//Check if prepared statement fails
						if(!mysqli_stmt_prepare($stmt2, $sql)) {
						    header("Location: registratieform.php?login=error");
						    exit();
						} else {
							//Bind parameters to the placeholder
							mysqli_stmt_bind_param($stmt2, "sss", $username, $hashedPwd, $rollid);

							//Run query in database
							mysqli_stmt_execute($stmt2);
							header("Location: registratieform.php?signup=success");
							exit();
						}
					}
				}
			

	//Close first statement
	mysqli_stmt_close($stmt);
	//Close second statement
	mysqli_stmt_close($stmt2);



?>