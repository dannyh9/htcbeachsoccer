<?php
include '../databaseconnection.php';
?>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  </script>
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<link rel="stylesheet" type="text/css" href="../css/formulier.css">
<script src="../js/uploadknopscript.js"></script>

<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
<form id="registratieform" method="post" action="registratieform.php" role="form"> 
     <div class="form-group ">
      <label class="control-label " for="username">
       Gebruikersnaam
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="username" placeholder="Vul hier uw gebruikersnaam in *" name="username" type="text" value=""/>
     </div>
    
     <div class="form-group ">
      <label class="control-label " for="password">
       Wachtwoord
         <span class="asteriskField">
        *
      </label>
      <input class="form-control" id="password" placeholder="Vul hier uw wachtwoord in *" name="password" type="password"/>
     </div>
     <div class="radio">
      <label class="radio " for="rollid">
         <p> <strong>Rol</strong></p>
         <span class="input-group-btn">
      </label>
      <input class="radio" id="rollid" name="rollid" placeholder="Vul hier een rol in " value="admin" type="radio"/>
     </div>

     <div class="radio">
  <label> <p> <strong>Rol</strong></p> <br><input type="radio" name="optradio">Option 1</label>
</div>
<div class="radio">
  <label><input type="radio" name="optradio">Option 2</label>
</div>
<div class="radio disabled">
  <label><input type="radio" name="optradio" disabled>Option 3</label>
</div>
            <br>
       <button class="btn btn-primary " name="submit" type="submit">
        Submit
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

if (isset($_POST["registreren"])) {

	

	

	//Error handlers
	//Check for empty fields
	if (empty($username) || empty($password) || empty($rollid)) {
		header("Location: registratieform.php?signup=empty");
		exit();
	}
	else {
				$username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $rollid = mysqli_real_escape_string($conn, $_POST['rollid']);
//Check if username exists USING PREPARED STATEMENTS
				$sql = "SELECT * FROM authenticatie WHERE authenticatie_username=?";
				//Create a prepared statement
				$stmt = mysqli_stmt_init($conn);
				//Check if prepared statement fails
				if(!mysqli_stmt_prepare($stmt, $sql)) {
				    header("Location: registratieform.php?login=error");
				    exit();
				} else {
					//Bind parameters to the placeholder
					//The "s" means we are defining the placeholder as a string
					mysqli_stmt_bind_param($stmt, "s", $username);

					//Run query in database
					mysqli_stmt_execute($stmt);

					//Check if user exists
					mysqli_stmt_store_result($stmt);
					$resultCheck = mysqli_stmt_num_rows($stmt);
					if ($resultCheck > 0) {
						header("Location: registratieform.php?signup=usertaken");
						exit();
					} else {
						//Hashing the password
						$hashedPwd = md5($password);
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
			}

	//Close first statement
	mysqli_stmt_close($stmt);
	//Close second statement
	mysqli_stmt_close($stmt2);

} 

?>